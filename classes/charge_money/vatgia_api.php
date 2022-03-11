<?php

class VatgiaApi{

	const VATGIA_API_SERVICE_OUT = 'http://api.vatgia.vn/vg_sevices_out/estore/';
	public static function getMoneyInfo($user_id)
	{
		$data = array('getUserMoney' => array('iUse' => $user_id));
		$dataString = self::makePostDataVGServiceOut($data);
		$respone = self::curl(self::VATGIA_API_SERVICE_OUT, $dataString);
		return isset($respone['getUserMoney'])?$respone['getUserMoney']:false;
	}

	private static function makePostDataVGServiceOut($data)
	{
		return 'data=' . json_encode($data);
	}

	private static function curl($link, $data = array(), $time_out = 30)
	{
  		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $link);
		curl_setopt($ch, CURLOPT_TIMEOUT, 30); //timeout after 30 seconds
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

		$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE); //get status code
		$result = curl_exec($ch);
		if(false !== $result)
		{
			curl_close($ch);
			return $respone = json_decode($result, true);
		}
		return false;
	}
}