<?
require_once("../functions/functions.php");
ob_start();
require_once("../functions/function_rewrite.php");
require_once("../functions/array_front_end.php");
require_once("../classes/database.php");
require_once("../cache_file/top-cache.php");
require_once("../functions/pagebreak.php");
require_once("../classes/class.phpmailer.php");
require_once("../classes/class.pop3.php");
require_once("../classes/class.smtp.php");
require_once("../classes/PHPMailerAutoload.php");

date_default_timezone_set('Asia/Ho_Chi_Minh');
if ($_SERVER['SERVER_NAME'] == 'localhost') {
    $domain = "http://" . $_SERVER['SERVER_NAME'] . ":" . $_SERVER['SERVER_PORT'];
} else if ($_SERVER['SERVER_NAME'] == 'timviec365.com') {
    $domain = "https://" . $_SERVER['SERVER_NAME'];
} else {
    $domain = "http://" . $_SERVER['SERVER_NAME'];
}
//---Trường 01/07/2021--------
// include("sync_login.php");
// if (!isset($_COOKIE['general_login'])) {
//     if (isset($_COOKIE['UT']) || isset($_COOKIE['UID']) || isset($_COOKIE['PHPSESPASS'])) {
//         unset($_COOKIE['UID']);
//         unset($_COOKIE['PHPSESPASS']);
//         if (isset($_COOKIE['UT']) && $_COOKIE['UT'] != 3) {
//             unset($_COOKIE['UT']);
//             setcookie("UT", null, -1, '/');
//         }

//         setcookie("UID", null, -1, '/');
//         setcookie("PHPSESPASS", null, -1, '/');

//     }
// }
//-----------

$version = 259;
$url = $_SERVER['REQUEST_URI'];
$sub_url = explode('/', $url);

?>