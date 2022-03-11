<?php

require_once dirname(__file__) . '/myad_charge_money_exception.php';

class MyAdChargeMoney
{

	public $user;
	public $use_id;
	public $email;

	public $payment_sender;

	const TABLE_USER_MONEY = 'ads_user_money';
	const TABLE_LOG = 'ads_user_money_add';

	public function __construct($user)
	{
		$this->user = $user;
		if($user instanceof user)
		{
			$this->use_id = $user->u_id;
			$this->email = $user->login_name;
		}
	}

	/**
	 * Cộng tiền vào tài khoản người dùng khi nạp tiền thành công
	 */
	public function addMoney($money, $type, $message = '', $data = array())
	{
		$user_id = (int)(isset($data['user_id'])?$data['user_id']:$this->use_id);
		//Thêm tiền vào tk user
		$sql_add_money = 'INSERT INTO ' . self::TABLE_USER_MONEY . ' (um_user_id,um_money)
VALUES (' . $user_id . ',' . (int)$money . ')
ON DUPLICATE KEY UPDATE um_money=um_money+' . (int)$money . '';
		$db_add_money = new db_execute($sql_add_money, __file__ . __line__);

		if ($db_add_money->total > 0)
		{
			//Thêm vào history
			$form = new generate_form();
			$form->addTable(self::TABLE_LOG);

			//User nạp
			$uma_user_id = $user_id;
			$form->add('uma_user_id', 'uma_user_id', 1, 1, $uma_user_id, 1, 'User chưa đăng nhập');

			//Số tiền nạp
			$uma_money = $money;
			$form->add('uma_money', 'uma_money', 1, 1, $uma_money, 1, 'Số tiền nạp không hợp lệ');

			//Thời gian nạp
			$uma_date = time();
			$form->add('uma_date', 'uma_date', 1, 1, time());

			//Kiểu nạp tiền: 2 - Nạp từ VG
			// 3: Nạp từ Bảo Kim
			// 1: Nạp bằng tay
			$uma_type = $type;
			$form->add('uma_type', 'uma_type', 1, 1, $uma_type);

			//IP client nạp tiền
			$uma_ip = @$_SERVER['REMOTE_ADDR'];
			$uma_ip = ip2long($uma_ip);
			$form->add('uma_ip', 'uma_ip', 1, 1, $uma_ip);

			//Comment khi nạp tiền
			$uma_comment = $message;
			$form->add('uma_comment', 'uma_comment', 0, 1, $uma_comment);

			//Mã giao dịch bảo kim
			if(isset($data['transaction_id']))
			{
				$uma_transaction_id = $data['transaction_id'];
				$form->add('uma_transaction_id', 'uma_transaction_id', 0, 1, $uma_transaction_id);
			}

			//Lấy số tiền hiện tại
			$sql_select_current_money = 'SELECT um_money FROM ' . self::TABLE_USER_MONEY . ' WHERE um_user_id = ' . (int)$user_id;
			$db_current_money = new db_query($sql_select_current_money, __file__ . __line__);
			$current_money = $db_current_money->result_array();
			unset($db_current_money);
			$uma_current_balance = isset($current_money[0]['um_money']) ? $current_money[0]['um_money'] : 0;
			$form->add('uma_current_balance', 'uma_current_balance', 1, 1, $uma_current_balance);

			$db_insert_log = new db_execute($form->generate_insert_SQL());
			if ($db_insert_log->total == 0)
			{
				throw new MyadChargeMoneyException('Quá trình ghi log ở bảng ' . self::TABLE_LOG . ' lỗi :' . $form->generate_insert_SQL());
			}
			unset($db_insert_log);
			return true;
		} else
		{
			throw new MyadChargeMoneyException('Quá trình cộng tiền trên Myad không thành công : ' . $sql_add_money);
		}
		unset($db_add_money);
		return true;
	}

	public function addMoneyFromVatgia($money)
	{
		$respone = array();
		$money = (int)$money;
		try
		{
			require_once dirname(__file__) . '/charge_money_from_vatgia.php';
			$this->payment_sender = new ChargeMoneyFromVatgia();
			$respone_message = $this->payment_sender->send($this->use_id, $this->email, $money);
			$respone = array('code' => 1, 'message' => $respone_message);
		}
		catch (ChargeMoneyFromVatgiaException $e)
		{
			//Xảy ra lỗi khi trừ tiền bên Vatgia.com. Dừng ngay và trả về lỗi
			return $respone = array('code' => 0, 'message' => $e->stringError());
		}

		//Nếu không có lỗi lầm gì thi tăng tiền
		try
		{
			$success = $this->addMoney($money, 2, 'Nạp tiền từ Vatgia.com');
		}
		catch (MyadChargeMoneyException $e)
		{
			/**
			 * Đây là trường hợp trừ tiền từ Vatgia.com OK nhưng mà cộng tiền trên myad.vn thất bại
			 * Có log mợ nó rồi Tính sau
			 */
			$respone = array('code' => 0, 'message' => 'Có lỗi xảy ra. Nếu tài khoản của bạn chưa được cộng tiền hay liên hệ với Myad.vn để được hỗ trợ');
		}
		return $respone;
	}


	/**
	 * MyAdChargeMoney::saveOrderBeforeRequestBaokim()
	 *
	 * @todo Lưu thông tin nạp tiền của user vào bảng
	 * @param mixed $data
	 * @return void
	 */
	public function saveOrderBeforeRequestBaokim($data)
	{
		try
		{
			//Khởi tạo
			require_once dirname(__file__) . '/charge_money_from_baokim.php';
			$this->payment_sender = new ChargeMoneyFromBaoKim();

			//Chuẩn hóa dữ liệu
			$data_order = array(
				'mbk_user_id' => $this->user->u_id,
				'mbk_money' => (int)(isset($data['total_amount']) ? $data['total_amount'] : 0),
				'mbk_mail' => $this->user->login_name,
				'mbk_phone' => $this->user->use_phone);

			//Save
			return $this->payment_sender->saveOrderBeforeRequestBaokim($data_order);
		}
		catch (ChargeMoneyFromBaoKimException $e)
		{
			return false;
		}
	}

	/**
	 * ChargeMoneyFromBaoKim::updateOrderStatus()
	 *
	 * @todo Cập nhật trạng thái đơn hàng nạp tiền của user khi nhận BPN
	 * @return Thành công trả về user_id nạp tiền
	 */
	public function updateBaoKimOrderStatus($data, $message = '')
	{
		try
		{
			if (!class_exists('ChargeMoneyFromBaoKim'))
			{
				require_once dirname(__file__) . '/charge_money_from_baokim.php';
			}
			$this->payment_sender = new ChargeMoneyFromBaoKim();
			return $this->payment_sender->updateBaoKimOrderStatus($data, $message);
		}
		catch (ChargeMoneyFromBaoKimException $e)
		{
			return false;
		}
	}
}
