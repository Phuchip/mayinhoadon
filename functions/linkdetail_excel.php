<?
	include('../home/config.php');
    include('../ssl/assets/array/array_front_end.php');
	include('../functions/array_index_tv.php');

	$array = [];
	
	$sql_tags = "SELECT * FROM `new` JOIN user_company ON usc_id = new_user_id WHERE jobposting = 1 AND new_thuc = 1 AND new_index = 1 AND usc_company != '' AND new_han_nop > ".time();

	$db_qr = new db_query($sql_tags);
    While($row = mysql_fetch_assoc($db_qr->result)){
        $link = $domain.rewriteNews($row['new_id'],$row['new_title'],$row['new_alias']);
        $array[] = [
			'title' => $row['new_title'],
			'url'  => $link
		];
    }
	// // die("Không có yêu cầu");
	header("Content-type: application/octet-stream");
	header("Content-Disposition: attachment; filename=Tin cài jobposting timviec365com.xls");
	header("Pragma: no-cache");
	header("Expires: 0");

	echo '<table border="1px solid black">';
	echo '<tr>';
	echo '<td><strong> STT </strong></td>';
	echo '<td><strong> Tiêu đề </strong></td>';
	// echo '<td><strong> Từ khóa </strong></td>';
	echo '<td><strong> URL </strong></td>';
	foreach($array as $key => $value){
		echo'<table border="1px solid black">';
		echo'<tr>';
		echo'<td>'.++$key.'</td>';
		echo'<td>'.$value['title'].'</td>';
		// echo'<td>'.$value['new_keyword'].'</td>';
		echo'<td>'.$value['url'].'</td>';
	}
	echo '</tr>';
	echo '</table>';
?>