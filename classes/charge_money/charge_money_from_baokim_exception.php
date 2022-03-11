<?php

class ChargeMoneyFromBaoKimException extends Exception
{
	var $string_message;

	const LOG_FILE_BAOKIM_ADD_MONEY = '/ipstore/add_money/baokim_add_money.cfn';
	public function __construct($message, $data = array())
	{
		$this->string_message = $message;

		$root_dir = $_SERVER['DOCUMENT_ROOT'];
		$log_file = $root_dir . self::LOG_FILE_BAOKIM_ADD_MONEY;
		// some code
		if (!is_dir(dirname($log_file)))
		{
			mkdir(dirname($log_file), 0777, true);
		}

		$handle = fopen($log_file, 'a+');
		if ($handle)
		{
			fwrite($handle, '
------------------------------------------' . date('H:i:s d/m/Y') . '----------------------------------------------
/////////////////////////////////////////////////////////////////////////////////////////////////////////
' . $message . '
' . $this . '
Post Data From Baokim:
'.var_export($data, 1).'
/////////////////////////////////////////////////////////////////////////////////////////////////////////');
			fclose($handle);
		}

		// make sure everything is assigned properly
		parent::__construct($message);
	}

	public function stringError()
	{
		return $this->string_message;
	}
}
