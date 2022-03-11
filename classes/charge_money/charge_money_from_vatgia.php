<?php

if (!class_exists('Request_Security'))
{
	require_once dirname(__file__) . '/rest_request.php';
}

require_once dirname(__file__) . '/charge_money_from_vatgia_exception.php';

class ChargeMoneyFromVatgia
{

	/**
	 * Đối tượng dùng để gửi request
	 */
	private $request_security;

	/**
	 * Link API vatgia.com
	 */
	const VATGIA_API_URL = 'http://slave.vatgia.com/authorize/api/api.php';
	//const VATGIA_API_URL = 'http://vatgia.vnpgroup.net/authorize/api/api.php';

	/**
	 * Thông tin Authen Rest Request
	 */

	const REST_USERNAME_PUB = "myad.vn";
	const REST_PASSWORD_PUB = 'fds20432lsfhsdoerw';
	const REST_ACCESS_KEY_ID_PUB = "myad.vn";
	const REST_SHARE_KEY_PUB = "fdsjfldsaj;l2wrjlewjrlfldsfds";
	const CLIENT_SECRET = "fdls2043242l32f0ds432432";
	const CLIENT_ID = 3;

	public function __construct()
	{
		//Khởi tạo đối tượng gửi Request
		$this->request_security = new Request_Security(self::REST_ACCESS_KEY_ID_PUB, self::REST_SHARE_KEY_PUB, self::VATGIA_API_URL);
		$this->request_security->Set_Digest_Authentication(self::REST_USERNAME_PUB, self::REST_PASSWORD_PUB);
		//$this->request_security->debug = true;
		$this->request_security->domain = 'myad.vn';
	}

	/**
	 * Chuẩn hóa dữ liệu bắn theo API
	 * Tạo checksum
	 * Dữ liệu có dạng
	 * array(
	 * 	"client_id" => $client_id,
	 * 	"email" => $email,
	 * 	"use_id" => $use_id,
	 * 	"hash" => md5($client_secret . "|" . $client_id . "|" . $dataString),
	 * 	"money" => $money
	 * )
	 */
	private static function generate_data(&$data)
	{
		if (!is_array($data) || empty($data))
		{
			return false;
		}

		extract($data);
		if (!isset($email) || !isset($use_id) || !isset($money))
		{
			return false;
		}
		$dataString = $use_id . "|" . $email . "|" . $money . "|" . self::CLIENT_ID;
		$data['client_id'] = self::CLIENT_ID;
		$data['hash'] = md5(self::CLIENT_SECRET . '|' . self::CLIENT_ID . '|' . $dataString);
		return true;
	}

	/**
	 * Gửi yêu cầu trừ tiền lên vatgia
	 * Thành công
	 * array(1) {
	 * 	["spentMoneyMyad"]=> array(1) {
	 * 		["msg"]=> string(43) "Bạn đã bị trừ 50đ trên VatGia.com"
	 * 	}
	 * }

	 * Thất bại:
	 * array(1) {
	 * 	["spentMoneyMyad"]=> array(1) {
	 * 		["error"] => string(11) "Hash error "
	 * 	}
	 * }

	 */
	public function send($use_id, $email, $money)
	{
		$data = array(
			'use_id' => $use_id,
			'email' => $email,
			'money' => $money);
		if (self::generate_data($data))
		{
			$this->request_security->call('spentMoneyMyad', $data);
			$respone = $this->request_security->Post_Data("json", 1, 1);

			//Ghi log
			$this->log(get_defined_vars());

			if (isset($respone['spentMoneyMyad']['error']))
			{
				throw new ChargeMoneyFromVatgiaException($respone['spentMoneyMyad']['error']);
				return false;
			} else
			{
				return isset($respone['spentMoneyMyad']['msg']) ? $respone['spentMoneyMyad']['msg'] : 'Bạn vừa nạp thành công ' . number_format($money, 0, ',', '.');
			}

		} else
		{
			throw new ChargeMoneyFromVatgiaException('Không đủ thông tin User (Email / User_id)');
		}
		return false;
	}

	private function log($arr_vars = array())
	{
		$log_file = $_SERVER['DOCUMENT_ROOT'] . '/ipstore/add_money/vatgia_charge_success.cfn';
		if (!is_dir(dirname($log_file)))
		{
			mkdir(dirname($log_file), 0777, true);
		}

		//Ghi log tất cả quá trình bắn sang vatgia thành công hoặc thất bại
		$handle = fopen($log_file, 'a+');
		if ($handle)
		{
			$string_log = '///////////////////////////////' . date('H:i:s d/m/Y') . '///////////////////////////////
' . var_export($arr_vars, 1) . '
Request:
' . var_export($_REQUEST, 1) . '
////////////////////////////////////////////////////////////////////////
';

			fwrite($handle, $string_log);
			fclose($handle);
		}
	}
}

?>