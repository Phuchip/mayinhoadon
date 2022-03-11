<?php
session_start();
require_once("../../functions/translate.php");
require_once("../../functions/functions.php");
require_once("../../classes/config.php");
require_once("../../classes/database.php");
require_once("../modules/security/functions.php");

$password_old = getValue('password_old','str','POST','');
$password = getValue('password','str','POST','');

$password_old = md5($password_old);
$password = md5($password);

$qr_check = new db_query("SELECT `password` FROM `tbl_admin` WHERE `password` = '".$password_old."' AND `id` =".$_SESSION['user_id']);
if(mysql_num_rows($qr_check->result) > 0){
    $data = array('password' => $password);
    $condition = array('id' => $_SESSION['user_id']);
    update('tbl_admin',$data,$condition);
    $result = array('result' => true,'mes'=>'Đổi mật khẩu thành công');
    echo json_encode($result);
    exit();
    
}else{
    $result = array('result' => false,'mes'=>'Sai mật khẩu cũ, Xin vui lòng nhập lại');
    echo json_encode($result);
    exit();
}

?>