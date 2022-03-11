<?php

if (!class_exists('ChargeMoneyFromBaoKim'))
{
	require_once dirname(__file__) . '/../charge_money_from_baokim.php';
}

class BaokimBPNProcess
{
	public $data;
	public function __construct()
	{
		$this->data = $_POST;
	}

	private static function verifyBPNRequest($data)
	{
		if (empty($data))
		{
			return false;
		}
		$req = '';
		foreach ($data as $key => $value)
		{
			$value = urlencode(stripslashes($value));
			$req .= "&$key=$value";
		}
		$ch = curl_init();

		//Dia chi chay BPN test
		//curl_setopt($ch, CURLOPT_URL,'http://sandbox.baokim.vn/bpn/verify');
		//Dia chi chay BPN that
		curl_setopt($ch, CURLOPT_URL, 'https://www.baokim.vn/bpn/verify');
		curl_setopt($ch, CURLOPT_VERBOSE, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
		$result = curl_exec($ch);
		$status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		$error = curl_error($ch);
		if ($result != '' && strstr($result, 'VERIFIED') && $status == 200)
		{
			return true;
		} else
		{
			return false;
		}
	}

	public function process()
	{
		//Lấy user tương ứng với đơn hàng đã lưu
		if (self::verifyBPNRequest($this->data))
		{
			//Xác thực thành công thì gọi MyadChargeMoney để update đơn hàng và cộng tiền
			if (!class_exists('MyadChargeMoney'))
			{
				require_once dirname(__file__) . '/../myad_charge_money.php';
			}
			$MyadChargeMoney = new MyAdChargeMoney(array());
			$user_id = $MyadChargeMoney->updateBaoKimOrderStatus($this->data);
			if ($user_id > 0)
			{
				$this->data['user_id'] = $user_id;
				$add_success = $MyadChargeMoney->addMoney((int)$this->data['net_amount'], 3, '', $this->data);
				if ($add_success)
				{
					//Nạp tiền thành công
					throw new ChargeMoneyFromBaoKimException('Charge Money Success', $this->data);
				}
			} else
			{
				//Đơn hàng ứng với order_id không tồn tại hoặc là order_id này đã được xử lý
				throw new ChargeMoneyFromBaoKimException('Order_id Not exists OR Order đã xử lý', $this->data);
			}
		} else
		{
			//Thông tin BPN không chính xác
			throw new ChargeMoneyFromBaoKimException('Verify BPN Post Data Invalid', $this->data);
		}
	}
}
