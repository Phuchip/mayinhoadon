<?
$key_checksum = "421aa90e079fa326b6494f812ad13e79"; 
function adm_template(){ return "";} 
function adm_generate_form(){ return "";} 
function checklogged($denypath = ""){ if($denypath == "") $denypath="../../login.php"; $password = getValue("password", "str", "SESSION", ""); $username = getValue("userlogin", "str", "SESSION", ""); $user_id = getValue("user_id", "str", "SESSION", ""); $checsum = getValue("checsum", "str", "SESSION", ""); 
global $key_checksum; 
//echo md5($user_id . "|" . $username . "|" . $password . "|" . md5($_SERVER["SERVER_NAME"]) . "<br>" . $checsum; 
 if (!isset($_SESSION["logged"])){ redirect($denypath); exit("Error: " . __LINE__); } else{ if ($_SESSION["logged"] != 1){ redirect($denypath); exit("Error: " . __LINE__); } } } 
?>