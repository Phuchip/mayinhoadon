<?
require_once("security1.php");
require_once("functions1.php");
require_once("functions2.php");
require_once('functions4.php');
require_once('rewrite_functions.php');
function checkRowUser($table,$field_id,$record_id,$returnurl){
	$strreturn ='';
	$db_useradmin = new db_query("SELECT adm_id,adm_isadmin,adm_edit_all FROM admin_user WHERE adm_id=" . $_SESSION["user_id"]);
	if($adm = mysql_fetch_array($db_useradmin->result)){
		if($adm["adm_isadmin"]==1){
			$strreturn ='';
		}else{
			$db_record = new db_query("SELECT admin_id FROM " . $table . " WHERE " . $field_id . " = " . $record_id);
			$row=mysql_fetch_array($db_record->result);
			if($row["admin_id"] == $_SESSION["user_id"] || $row["admin_id"] == 0 || $adm["adm_edit_all"]==1){
				$strreturn = '';
				unset($db_record);
			}else{
				$db_user = new db_query("SELECT adm_loginname FROM admin_user WHERE adm_id= " . intval($row["admin_id"]));
				if($use=mysql_fetch_array($db_user->result)){
					$strreturn = '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><script language="javascript">alert("Bản ghi này thuộc quyền sửa xóa của user: ' . $use["adm_loginname"] . '")</script>';
				}else{
					$strreturn = '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><script language="javascript">alert("Bản ghi không thuộc quyền sửa xóa của bạn !")</script>';
				}
				unset($db_user);
			}
		}
	}else{
		$denypath="../../login.php";
		redirect($denypath);
	}
	if($strreturn!=''){
		echo $strreturn;
		redirect($returnurl);
		exit();
	}else{
		echo $strreturn;
	}
}
function checkAccessCategory(){
	
	$userlogin	= getValue("userlogin", "str", "SESSION", "", 1);
	$password	= getValue("password", "str", "SESSION", "", 1);
	$lang_id		= getValue("lang_id", "int", "SESSION", 1);
	
	// Danh sách category đc phép truy cập
	$list_id		= "";
	$db_category= new db_query("SELECT adm_id, adm_isadmin, adm_access_category
										 FROM admin_user
										 WHERE adm_loginname = '" . $userlogin . "' AND adm_password='" . $password . "' AND adm_active = 1");
	
	//Check xem user co ton tai hay khong
	if($row = mysql_fetch_array($db_category->result)){
		
		//Neu column adm_isadmin = 1 thi get all category
		if($row["adm_isadmin"] == 1) {
			$db_getall = new db_query("SELECT cat_id FROM categories_multi");
			while($getall = mysql_fetch_array($db_getall->result)){
				$list_id .= $getall["cat_id"] . ",";
			}
			unset($db_getall);
		}
		else{
			preg_match_all('/\[(.*?)\]/is', $row["adm_access_category"], $matches);
			for($i=0; $i<count($matches[1]); $i++){
				$list_id	.= intval($matches[1][$i]) . ",";
			}
		}
		
	}
	
	$db_category->close();
	unset($db_category);
		
	$list_id .= 0;
		
	return $list_id;
	
}
?>
<?
function checkDeleteCategory($record_id){
	$return = 1;
	$array_module	= array ("download"	=> array("downloads_multi", "dow_category_id"),
									"gallery"	=> array("galleries_multi", "gal_category_id"),
									"news"		=> array("news_multi", "new_category_id"),
									"product"	=> array("products_multi", "pro_category_id"),
									"static"		=> array("statics_multi", "sta_category_id"),
									);
	$db_module = new db_query("SELECT cat_type FROM categories_multi WHERE cat_id = " . $record_id);
	if($module = mysql_fetch_array($db_module->result)){
		if(isset($array_module[$module["cat_type"]])){
			$arrTemp	= $array_module[$module["cat_type"]];
			$db_check= new db_query("SELECT COUNT(*) AS count FROM " . $arrTemp[0] . " WHERE " . $arrTemp[1] . " = " . $record_id);
			$check	= mysql_fetch_array($db_check->result);
			if($check["count"] > 0) $return = 0;
			unset($db_check);
		}
	}
	unset($db_module);
	return $return;
}
function save_log($filename, $log_content){
	$path = $_SERVER['DOCUMENT_ROOT'] . "/log/";
	 
	$handle = @fopen($path . $filename, "a");
	//N?u handle chua có m? thêm ../
	if (!$handle) $handle = @fopen($path . $filename, "a");
	//N?u ko m? dc l?n 2 thì exit luôn
	if (!$handle) exit();
	
	//fwrite($handle, date("d/m/Y h:i:s A") . "\n");
	@fwrite($handle, date("d/m/Y h:i:s A") . " ");
	@fwrite($handle, $log_content . "\n -----***---- \n");
	@fclose($handle);		
}
?>