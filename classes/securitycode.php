<?php
	session_start();
	$code= rand(10000,99999);
	$_SESSION["code"]=$code;
	$im = imagecreatetruecolor(66, 27);
	$bg = imagecolorallocate($im, 255, 255, 255); //background color blue
	$fg = imagecolorallocate($im, 0, 0, 0);//text color white
	imagefill($im, 0, 0, $bg);
	imagestring($im, 5, 8, 4,  $code, $fg);
	header("Cache-Control: no-cache, must-reva0idate");
	header('Content-type: image/png');
	imagepng($im);
	imagedestroy($im);
?>