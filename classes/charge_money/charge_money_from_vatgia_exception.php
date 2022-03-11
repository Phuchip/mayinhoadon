<?php

class ChargeMoneyFromVatgiaException extends Exception
{
	public $string_message = '';
	//const LOG_FILE_VATGIA_ADD_MONEY = '../../ipstore/add_money/vatgia_add_money.cfn';
	const LOG_FILE_VATGIA_ADD_MONEY = '/ipstore/add_money/vatgia_add_money.cfn';
	// Redefine the exception so message isn't optional
	public function __construct($message, $code = 0)
	{
		$this->string_message = $message;

		$root_dir = $_SERVER['DOCUMENT_ROOT'];
		$log_file = $root_dir . self::LOG_FILE_VATGIA_ADD_MONEY;
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
/////////////////////////////////////////////////////////////////////////////////////////////////////////');
			fclose($handle);
		}

		// make sure everything is assigned properly
		parent::__construct($message, $code);
	}

	public function stringError()
	{
		return $this->string_message;
	}
}
