<?php

if (!class_exists('ChargeMoneyFromBaoKimException'))
{
	require_once dirname(__file__) . '/charge_money_from_baokim_exception.php';
}

/**
 * ChargeMoneyFromBaoKim
 *
 * @package
 * @author myad.vn
 * @copyright ntdinh1987
 * @version 2015
 * @access public
 */
class ChargeMoneyFromBaoKim
{

	private $user = null;

	const TABLE_LOG = 'money_baokim';
	/**
	 * ChargeMoneyFromBaoKim::__construct()
	 * @param $user : Thông tin user nạp tiền với email gửi từ baokim
	 * @return this
	 */
	public function __construct()
	{
	}

	/**
	 * ChargeMoneyFromBaoKim::saveOrder()
	 *
	 * @todo: Lưu tạm thông tin nạp tiền trước khi bắn sang baokim
	 * @return int order_id
	 */
	public function saveOrderBeforeRequestBaokim($data)
	{
		if ($data && is_array($data) && !empty($data))
		{
			extract($data);
			if (isset($mbk_user_id) && isset($mbk_money) && isset($mbk_mail) && isset($mbk_phone))
			{
				$sql = "INSERT INTO `money_baokim` (`mbk_user_id`, `mbk_money`, `mbk_mail`, `mbk_phone`)
				VALUES ('{$mbk_user_id}', '{$mbk_money}', '{$mbk_mail}', '{$mbk_phone}')";

				$db_insert = new db_execute_return();
				$order_id = $db_insert->db_execute($sql, __file__ . __line__);
				unset($db_insert);
				return (int)($order_id ? $order_id : false);
			} else
			{
				throw new ChargeMoneyFromBaoKimException('Không đủ thông tin truyền vào', $data);
				return false;
			}
		} else
		{
			return false;
		}
	}

	/**
	 * ChargeMoneyFromBaoKim::updateOrderStatus()
	 *
	 * @todo Cập nhật trạng thái đơn hàng nạp tiền của user khi nhận BPN
	 * 	- Cập nhật trạng thái order khi quá trình bắn sang baokim gặp lỗi
	 * 	- Nếu bắn sang Baokim Ok thì cập nhật transaction_id và cộng tiền cho user
	 * 	- Chỉ xử lý các order có mbk_status = 0
	 * @return bool
	 */
	public function updateBaoKimOrderStatus($data, $message = '')
	{
		extract($data);
		//kiem tra trang thai giao dich
		//$transaction_status = isset($transaction_status) ? (int)$transaction_status : -1;
		//http://localhost:9008/home/up_cash.php?
		//success=1&
		//		created_on=1428120474&
		//		customer_address=Tr%C6%B0%C6%A1ng+%C4%90%E1%BB%8Bnh%2C+Ho%C3%A0ng+Mai
		//		&customer_email=thinhthanh64%40gmail.com
		//		&customer_location=
		//		&customer_name=Nguy%E1%BB%85n+Ng%E1%BB%8Dc+Tu%E1%BA%A5n
		//		&customer_phone=841663032789
		//		&fee_amount=0
		//		&merchant_email=dev.baokim%40bk.vn
		//		&merchant_id=647
		//		&merchant_location=
		//		&merchant_name=Dev+Hieu+Nguyen
		//		&merchant_phone=01127850169
		//		&net_amount=500000
		//		&order_id=1428120400
		//		&payment_type=1
		//		&total_amount=500000.00
		//		&transaction_id=70090AF7B4BC1
		//		&transaction_status=4
		//		&checksum=5B36BEBC0AD172768788AF25FE6A38361451AD9A

		if (!isset($order_id))
		{
			throw new ChargeMoneyFromBaoKimException('Không tồn tại order_id', $data);
			return false;
		}
		//Nếu không tồn tại transaction_id tức là không phải request từ baokim về
		if (!isset($transaction_id))
		{
			//Có lỗi với đơn hàng
			$sql_update = 'UPDATE ' . self::TABLE_LOG . '
SET
	mbk_error = \'' . $message . '\',
	mbk_status = -1
WHERE
	mbk_id = ' . (int)$order_id . '
	AND mbk_status = 0';

			$db_update = new db_execute($sql_update, __file__ . __line__);
			unset($db_update);
			return false;
		} else
		{
			$sql_update = 'UPDATE ' . self::TABLE_LOG . '
SET
	mbk_status = ' . (int)$transaction_status . ',
	mbk_transaction_id = \'' . $transaction_id . '\'
WHERE
	mbk_id = ' . (int)$order_id . '
	AND mbk_status = 0';
			$db_update = new db_execute($sql_update, __file__ . __line__);
			$total_update = $db_update->total;
			unset($db_update);

			if (($transaction_status == 4 || $transaction_status == 13) && $total_update > 0)
			{
				//Trả về user_id nạp tiền
				$sql_select = 'SELECT mbk_user_id FROM ' . self::TABLE_LOG . ' WHERE mbk_id = ' . (int)$order_id . ' AND mbk_status <> 0';
				$db_select = new db_query($sql_select, __file__ . __line__);
				$user = $db_select->result_array();
				unset($db_select);
				return (isset($user[0]['mbk_user_id'])) ? (int)$user[0]['mbk_user_id'] : 0;
			} else
			{
				return 0;
			}

		}
	}

}
