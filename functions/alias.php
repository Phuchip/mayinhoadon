<?
	include('../home/config.php');

	$db_qr = new db_query("SELECT usc_id,usc_company FROM user_company WHERE usc_md5 = '' ORDER BY usc_id DESC");
	
	while($row = mysql_fetch_array($db_qr->result))
	{
		$alias = replaceTitle($row['usc_company']);
		$alias = substr($alias,0,55);

		if($alias == '') $alias = 'tuyen-dung-viec-lam-quoc-te';
		else $alias = replaceTitle($row['usc_company']);

		$db_ud = new db_query("UPDATE user_company SET usc_alias = '".$alias."' WHERE usc_id = ".$row['usc_id']);
	}
	echo 'Cập nhật thành công !!!';
?>