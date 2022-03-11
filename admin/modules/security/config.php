<?
session_start();
//error_reporting(0);
date_default_timezone_set('Asia/Ho_Chi_Minh');
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

require_once("/functions.php");
checklogged("login.php");

// Check role

function check_role($id_modules)
{
    $sql = new db_query("SELECT * FROM `tbl_role` JOIN `tbl_modules` ON tbl_role.id_modules = tbl_modules.id AND tbl_role.id_modules = " . $id_modules . " AND tbl_role.view = 1 AND tbl_role.id_user = " . $_SESSION['user_id']);
    if (mysql_num_rows($sql->result) < 1) {
        $link = array('view' => 0);
        return $link;
    } else {
        $check_role = mysql_fetch_assoc($sql->result);
        return $check_role;
    }
}
function role($role, $action = '', $id = 0)
{
    if ($action == 'add' and $id == 0) {
        if ($role['add'] == 0) {
            echo '
            <script language="javascript">
                window.alert("Bạn không có quyền truy cập");
                window.history.back()
            </script>
            ';
            exit();
        }
    } elseif ($action == 'add' and $id != 0) {
        if ($role['edit'] == 0) {
            echo '
            <script language="javascript">
                window.alert("Bạn không có quyền truy cập");
                window.history.back()
            </script>
            ';
            exit();
        }
    } elseif ($action == 'edit') {
        if ($role['edit'] == 0) {
            echo '
            <script language="javascript">
                window.alert("Bạn không có quyền truy cập");
                window.history.back()
            </script>
            ';
            exit();
        }
    } elseif ($action == 'delete') {
        if ($role['delete'] == 0) {
            echo '
            <script language="javascript">
                window.alert("Bạn không có quyền xóa");
                window.history.back()
            </script>
            ';
            exit();
        }
    }
}

$url = $_SERVER['REQUEST_URI'];
$sub_url = explode('/', $url);
$active = $sub_url[2];
if ($active != '') {
    $sub_url = explode('?', $sub_url[2]);
    $active = $sub_url[0];
}
