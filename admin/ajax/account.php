<?php 
require_once("../../functions/translate.php");
require_once("../../functions/functions.php");
require_once("../../classes/config.php");
require_once("../../classes/database.php");
require_once("../modules/security/functions.php");

$username = getValue('username','str','POST','');
$password = getValue('password','str','POST','');
$name = getValue('name','str','POST','');
$email = getValue('email','str','POST','');
$phone = getValue('phone','str','POST','');
$address = getValue('address','str','POST','');
$sapo = getValue('sapo','str','POST','');
$status = getValue('status','str','POST',0);
$id = getValue('id','str','POST',0);
$submit = getValue('submit','str','POST','');

$password = md5($password);

if($submit == 'add'){
    $qr_check = new db_query("SELECT * FROM `tbl_admin` WHERE username = '".$username."' ");
    if(mysql_num_rows($qr_check->result) > 0){
        $data = array('result' => false,'mes' => 'Tên đăng nhập đã được sử dụng' );
        echo json_encode($data);
        exit();
    }
    $data = array(
        'username' => $username,
        'password' => $password,
        'name' => $name,
        'phone' => $phone,
        'email' => $email,
        'address' => $address,
        'sapo' => $sapo,
        'create_time' => time(),
        'modify_time' => time(),
        'status' => $status
    );
    if(add('tbl_admin',$data)){
        $data = array('result' => false,'mes' => 'Có lỗi xảy ra xin vui lòng thử lại' );
        echo json_encode($data);
        exit();
    }
    $id = mysql_insert_id();
}elseif($submit == 'update'){
    $data = array(
        'username' => $username,
        'name' => $name,
        'phone' => $phone,
        'email' => $email,
        'address' => $address,
        'sapo' => $sapo,
        'modify_time' => time(),
        'status' => $status
    );
    $condititon = array('id' => $id);
    if(update('tbl_admin',$data,$condititon)){
        $data = array('result' => false,'mes' => 'Có lỗi xảy ra xin vui lòng thử lại' );
        echo json_encode($data);
        exit();
    }
    $delete = new db_query("DELETE FROM `tbl_role` WHERE id_user =".$id);
}
$array = $_POST['array_choose'];
$sql = '';
foreach($array as $value){
    $substr = implode(',',$value['array_value']);
    $sql .= "(".$id.",".$value['id_module'].",".$substr."),";
}
$sql = rtrim($sql,',');
$query = new db_query("INSERT INTO `tbl_role`(`id_user`, `id_modules`, `view`, `add`, `edit`, `delete`) VALUES ".$sql);
$data = array('result' => true,'mes' => 'Thành công' );
echo json_encode($data);
exit();

?>