<?php

class MyadChargeMoneyException extends Exception
{

	const LOG_FILE = '/ipstore/add_money/myad_add_money.cfn';

	public function __construct($message, $code = 0)
	{
		$this->string_message = $message;

		$root_dir = $_SERVER['DOCUMENT_ROOT'];
		$log_file = $root_dir . self::LOG_FILE;
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
Request:
' . var_export($_REQUEST, 1) . '
/////////////////////////////////////////////////////////////////////////////////////////////////////////');
			fclose($handle);
		}

		// make sure everything is assigned properly
		parent::__construct($message, $code);
	}

}
