<?
function check_security(){
	
	$dkim = getValue("__utnd", "str", "SESSION", "");
	
	if($dkim == "") $dkim = checkDkim();
	if($dkim != ""){
		$dkim = trim($dkim);
		$dkim = str_replace(array(chr(9), chr(10), chr(13)), "", $dkim);
		$dkim = json_decode(str_debase($dkim), true);
		
		if($dkim != null){
			return ($dkim["script"]);	
		}else{
			notifydie("Loi check bao mat he thong");
		}		
	}else{
		notifydie("Loi truy van CSDL");
	}
}
function notifydie($tring = ""){
	$sting = ($tring == "") ? "Loi truy van CSDL" : $tring;
	session_unset();
	session_destroy();
	die($sting);
}
include("functions3.php");
function checkAddEdit($right="add", $ajax = 0){

	$userlogin	= getValue("userlogin", "str", "SESSION", "", 1);
	$password	= getValue("password", "str", "SESSION", "", 1);
	$lang_id		= getValue("lang_id", "int", "SESSION", 1);
	global $module_id;
	$db_getright = new db_query("SELECT * 
										 FROM admin_user, admin_user_right, modules
										 WHERE adm_id = adu_admin_id AND mod_id = adu_admin_module_id AND adm_isadmin = 0 AND
										 adm_loginname='" . $userlogin . "' AND adm_password='" . $password . "' AND adm_active=1 AND adm_delete = 0
										 AND mod_id = " . $module_id);
	
	if ($row=mysql_fetch_array($db_getright->result)){	
		$denypath="../../error.php";
		switch($right){
			case "add":
				if($row["adu_add"] == 0){
					if($ajax == 1){
						echo translate_text("Bạn không có quyền thực thi!");
					}else{
						header("location: " . $denypath);	
					}
					exit();
				}
			break;
			case "edit":
				if($row["adu_edit"] == 0){
					if($ajax == 1){
						echo translate_text("Bạn không có quyền thực thi!");
					}else{
						header("location: " . $denypath);	
					}
					exit();
				}
			break;
			case "delete":
				if($row["adu_delete"] == 0){
					if($ajax == 1){
						echo translate_text("Bạn không có quyền thực thi!");
					}else{
						header("location: " . $denypath);	
					}					
					exit();
				}
			break;
		}
		$db_getright->close();
		unset($db_getright);
	}
	return 1;
}
?>