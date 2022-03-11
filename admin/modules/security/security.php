<?
session_start();
//error_reporting(0);

//class
require_once("../../../classes/database.php");
require_once("../../../classes/form.php");
require_once("../../../classes/generate_form.php");
require_once("../../../classes/upload.php");
require_once("../../../classes/menu.php");
require_once("../../../classes/html_cleanup.php");

//function
require_once("../../../functions/functions.php");
require_once("../../../functions/file_functions.php");
require_once("../../../functions/date_functions.php");
require_once("../../../functions/resize_image.php");
require_once("../../../functions/translate.php");
require_once("../../../functions/pagebreak.php");

//admin core
require_once("functions.php");
require_once("template.php");
require_once("grid.php");

//khai bao bien sever
$admin_id 				= getValue("user_id","int","SESSION");
$lang_id	 				= getValue("lang_id","int","SESSION");

//phan khai bao bien dung trong admin
$fs_border 				= "#DDD";
$fs_bgtitle 			= "#5C9CCC";
$fs_category			= checkAccessCategory();
$wys_cssadd				= array();
$sqlcategory 			= "";
$fs_is_in_adm			= 1;
$show_error          = 0;
$load_header			= '';
$fs_stype_css			= "../css/css.css";
$wys_cssadd				= "/css/all.css";
$fs_template_css		= "../css/template.css";
$fs_imagepath 			= "../../resource/images/";
$fs_scriptpath 		= "../../resource/js/";
$wys_path				= "../../resource/wysiwyg_editor/";
$fs_denypath			= "../../error.php";
$fs_change_bg			= 'onMouseOver="this.style.background=\'#D9EDF7\'" onMouseOut="this.style.background=\'#FEFEFE\'"';

//phan include file css
$load_header	.= '<link href="../../resource/css/css.css" rel="stylesheet" type="text/css">';

//phan include file script
$load_header 	.= '<script src="../../resource/js/jquery.js" type="text/javascript"></script>';
$load_header 	.= '<script src="../../resource/js/jquery.jeditable.js" type="text/javascript"></script>';
$load_header 	.= '<script src="../../resource/js/library.js" type="text/javascript"></script>';

//phan ngon ngu admin
$db_language			= new db_query("SELECT tra_text,tra_keyword FROM admin_translate");
$langAdmin 				= array();
while($row=mysql_fetch_assoc($db_language->result)){
	$langAdmin[$row["tra_keyword"]] = $row["tra_text"];
}

//cau hinh
$db_con = new db_query("SELECT con_currency,con_exchange from configuration WHERE con_lang_id=" . $lang_id);
if ($row=mysql_fetch_array($db_con->result)){
	while (list($data_field, $data_value) = each($row)) {
		if (!is_int($data_field)){
			//tao ra cac bien config
			$$data_field = $data_value;
			//echo $data_field . "= $data_value <br>";
		}
	}
}
$db_con->close();
unset($db_con);

//cau hinh category
$array_value =	array(
	"static" => translate_text("Trang tĩnh"),
	"huong-dan" => translate_text("Hướng dẫn"),
	"tap-chi" => translate_text("Tạp chí"),
	"tuyen-dung" => translate_text("Tuyển dụng")
	);
?>