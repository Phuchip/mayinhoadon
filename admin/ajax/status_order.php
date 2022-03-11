<?php 
require_once("../../functions/translate.php");
require_once("../../functions/functions.php");
require_once("../../classes/config.php");
require_once("../../classes/database.php");
require_once("../modules/security/functions.php");
session_start();

$id_modules = 6;
$sql = new db_query("SELECT * FROM `tbl_role` JOIN `tbl_modules` ON tbl_role.id_modules = tbl_modules.id AND tbl_role.id_modules = " . $id_modules . " AND tbl_role.view = 1 AND tbl_role.id_user = " . $_SESSION['user_id']);
if(mysql_num_rows($sql->result) > 0){
    $role = mysql_fetch_assoc($sql->result);
    $status = getValue('status','int','POST',0);
    $id = getValue('id','int','POST',0);
    if($role['edit'] == 0){
        $data = array('result' =>false ,'mes'=>'Bạn không có quyền chỉnh sửa' );
    }else{
        $update = array('status' => $status,'modify_time'=>time() );
        $condition = array('id' => $id );
        update('tbl_order',$update,$condition);
        $data = array('result' => true,'mes'=>'' );
    }
}else{
    $data = array('result' =>false ,'mes'=>'Bạn không có quyền chỉnh sửa' );
}
echo json_encode($data);
?>