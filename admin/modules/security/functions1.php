<?

function checkDkim(){
   return true;
   exit();
	session_unset();
	$dir = dirname(__FILE__);
	
	$row1 					= checkloged();
	$rest_url				= $row1["url"];
	$BA_user_name			= "vatgia";
	$BA_password			= $row1["pass"];
	$rest_access_key_id	= $row1["skid"];
	$rest_share_key		= $row1["skn"];	
	
	$filename = $dir . "/" . md5(strtolower($_SERVER["SERVER_NAME"]) . "|" . $row1["pass"] . "|" . $row1["skid"] . "|" . $row1["skn"]) . ".cfn";
	if(file_exists($filename)){
		$handl = fopen($filename, 'r');
		$data = fread($handl, filesize($filename));
		fclose($handl);
	}else{		
		$myRS = new Request_Security( $rest_access_key_id, $rest_share_key, $rest_url);									
		//Thiet lap thong so
		$myRS	->Set_Digest_Authentication($BA_user_name, $BA_password);
		$data 					= $myRS->Post_Data("json");
		if($data === false){
			$data = $myRS->rePost();
		}
	}
	$_SESSION["__utnd"]  = $data;
	return $data;
	unset($myRS);
}
function checkLogin($username, $password){
	$username	= replaceMQ($username);
	$password	= replaceMQ($password);
	$adm_id		= 0;
	$db_check	= new db_query("SELECT id 
										 FROM tbl_admin
										 WHERE username = '" . $username . "' AND password = '" . md5($password) . "' AND `delete` = 0");
	if(mysql_num_rows($db_check->result) > 0){
		$check	= mysql_fetch_array($db_check->result);
		$adm_id	= $check["id"];
		$db_check->close();
		unset($db_check);
		return $adm_id;
	}
	else{
		$db_check->close();
		unset($db_check);
		return 0;
	}
}

function get_curent_language(){
	$db_current_language = new db_query("SELECT lang_id
										 FROM admin_user
										 WHERE adm_loginname='" . $_SESSION["userlogin"] . "' AND adm_password='" . $_SESSION["password"] . "' AND adm_active=1 AND adm_delete = 0");
	if ($row=mysql_fetch_array($db_current_language->result)){
		$db_current_language->close();
		unset($db_current_language);
		return $row["lang_id"];
	}
	else{
		return "";
	}
}
function get_curent_path(){
	$db_current_path = new db_query("SELECT lang_path
										 FROM languages
										 WHERE lang_id=" . intval(get_curent_language()) . "");
	if ($row=mysql_fetch_array($db_current_path->result)){
		$db_current_path->close();
		unset($db_current_path);
		return $row["lang_path"];
	}
	else{
		return "";
	}
}
function checkaccessmodule($module_id){
	checkloged();
	$userlogin	= getValue("userlogin", "str", "SESSION", "", 1);
	$password	= getValue("password", "str", "SESSION", "", 1);
	$lang_id		= getValue("lang_id", "int", "SESSION", 1);
	$db_getright = new db_query("SELECT * 
								 FROM admin_user
								 WHERE adm_loginname='" . $userlogin . "' AND adm_password='" . $password . "' AND adm_active=1 AND adm_delete = 0");
	//Check xem user co ton tai hay khong
	if ($row = mysql_fetch_array($db_getright->result)){
		//Neu column adm_isadmin = 1 thi cho access
		if ($row['adm_isadmin'] == 1) {
			$db_getright->close();
			unset($db_getright);
			return 1;
		}
	}
	//Ko co thi` fail luon
	else{
		$db_getright->close();
		unset($db_getright);
		return 0;
	}
	$db_getright->close();
	unset($db_getright);
	
	//check user
	$db_getright = new db_query("SELECT * 
								 FROM admin_user, admin_user_right, modules
								 WHERE adm_id = adu_admin_id AND mod_id = adu_admin_module_id AND
								 adm_loginname='" . $userlogin . "' AND adm_password='" . $password . "' AND adm_active=1 AND adm_delete = 0
								 AND mod_id = " . $module_id);
	
	if ($row=mysql_fetch_array($db_getright->result)){	
		$db_getright->close();
		unset($db_getright);
		return 1;
	}
	else{
		$db_getright->close();
		unset($db_getright);
		return 0;
	}
}
function checkloged(){
   return true;
   exit();
	$dm						= $_SERVER["SERVER_NAME"];
	$dm						= str_replace("www.", "", $dm);
	$db_select 				= new db_query("SELECT * FROM kdims WHERE dkm_domain = '" . md5($dm) . "' LIMIT 1");
	if($row = mysql_fetch_assoc($db_select->result)){
			$array 					= str_debase($row["dkm_key"]);
			$row1 					= json_decode($array, true);
			if($row1 != null){
				if(md5($row["dkm_key"] . "|" . $row1["pass"]) != $row["dkm_hash"]){
					notifydie("Dang ky chua dung key");
				}else{				
					return $row1;
				}
		}else{
			notifydie("Dang ky chua dung key");
		}
		
	}else{
		notifydie("Chua dang ky domain");
	}	
}
function str_debase($encodedStr="",$type=0)
{
  $returnStr = "";
  $encodedStr = str_replace(" ","+",$encodedStr);
	if(!empty($encodedStr)) {
		 $dec = str_rot13($encodedStr);
		 $dec = base64_decode($dec);
		$returnStr = $dec;
	}
  return $returnStr;
}

?>