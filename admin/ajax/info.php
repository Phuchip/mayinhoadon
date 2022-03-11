<?php 
session_start();
require_once("../../functions/translate.php");
require_once("../../functions/functions.php");
require_once("../../classes/config.php");
require_once("../../classes/database.php");
require_once("../modules/security/functions.php");

$name = getValue('name','str','POST','');
$email = getValue('email','str','POST','');
$phone = getValue('phone','str','POST','');
$address = getValue('address','str','POST','');
$sapo = getValue('sapo','str','POST','');
$status = getValue('status','str','POST',0);
$id = $_SESSION["user_id"];
$submit = getValue('submit','str','POST','');

$data = array(
    'name' => $name,
    'phone' => $phone,
    'email' => $email,
    'address' => $address,
    'sapo' => $sapo,
    'modify_time' => time(),
);
$condititon = array('id' => $id);
if(update('tbl_admin',$data,$condititon)){
    $data = array('result' => false,'mes' => 'Có lỗi xảy ra xin vui lòng thử lại' );
    echo json_encode($data);
    exit();
}
$data = array('result' => true,'mes' => 'Cập nhật thông tin thành công' );
echo json_encode($data);
exit();

?>