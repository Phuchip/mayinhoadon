<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<?php
include('../home/config.php');
include('../includes/inc_tukhoann.php');
		$db_qr = new db_query("SELECT new_title,new_id,new_cat_id FROM new WHERE (new_real_cate = '' OR new_real_cate IS NULL) ORDER BY new_id DESC LiMIT 100");
		$i = 0;

		while($row = mysql_fetch_array($db_qr->result)){
			$new_real_cate = array();
			foreach ($array_tukhoann as $key => $value) {
				foreach ($value['arr'] as $key => $val) {
					if((string)strpos(mb_strtolower($row['new_title'],'UTF-8'),mb_strtolower($val,'UTF-8')) != '' || (replaceTitle(mb_strtolower($row['new_title'],'UTF-8')) == replaceTitle(mb_strtolower($val,'UTF-8')))) {
						$arr_cate = explode(',', $row['new_cat_id']);
						if(!in_array($value['id'], $arr_cate)){
							$new_real_cate[] = $value['id'];
						}
					}
				}

			}
			if(count($new_real_cate) == 0){
				$new_real_cate[] = $row['new_cat_id'];
			}
			$new_real_cate = array_unique($new_real_cate);
			$new_real_cate = implode(',', $new_real_cate);

			$update = new db_query("UPDATE new SET new_real_cate = '".$new_real_cate."' WHERE new_id = ".$row['new_id']." ");
			$i++;
		}
		echo "Cập nhật $i tin"."<br>";
		$db_qrs = new db_query("SELECT new_title,new_id,new_cat_id FROM new WHERE (new_real_cate = '' OR new_real_cate IS NULL)");
		echo "Còn lại ".mysql_num_rows($db_qrs->result)." tin";
		echo '<meta http-equiv="refresh" content="1"/>';
   ?>
<!DOCTYPE html>
<html lang="en">
<head>
	
	<title>Document</title>
	 
</head>
<body>
	
</body>
</html>
