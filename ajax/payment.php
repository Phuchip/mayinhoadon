<?php 
session_start();
include '../home/config.php';

$name = getValue('name','str','POST','');
$phone = getValue('phone','str','POST','');
$email = getValue('email','str','POST','');
$address = getValue('address','str','POST','');
$ship_name = getValue('ship_name','str','POST','');
$ship_phone = getValue('ship_phone','str','POST','');
$ship_address = getValue('ship_address','str','POST','');
$ship_note = getValue('ship_note','str','POST','');
if($num > 0){
    foreach($_SESSION['cart'] as $key => $value){
        $qr_check = new db_query("SELECT `id`,`name`,`quantity` FROM `tbl_product` WHERE id =".$value['id']);
        $data_check = mysql_fetch_assoc($qr_check->result);
        if($data_check['quantity'] < $value['quantity']){
            set_error("Sản phẩm ".$data_check['name']." có số lượng không đủ xin vui lòng thử lại!");
        }
    }
    $data = array(
        'name' => $name, 
        'phone' => $phone, 
        'email' => $email, 
        'address' => $address, 
        'ship_name' => $ship_name,
        'ship_phone' => $ship_phone,
        'ship_address' => $ship_address,
        'note' => $ship_note,
        'quantity'  => $num,
        'total'     => $total,
        'created_time'=> time(),
        'modify_time'   => time(),
    );
    if(add('tbl_order',$data)){
        set_error("Có lỗi xảy ra xin vui lòng thử lại");
    }
    $id = mysql_insert_id();
    $array = '';
    foreach($_SESSION['cart'] as $key => $value){
        $array .= "('".$id."','".$value['id']."','".$value['quantity']."','".$value['price']."','".time()."','".time()."'),";
        $update = new db_query("UPDATE `tbl_product` SET `quantity` = quantity - ".$value['quantity']." WHERE `id` = ".$value['id']);
    }
    $array = rtrim($array,',');
    $sql = "INSERT INTO `tbl_detail_order` (`id_order`, `id_product`, `quantity`, `price`, `created_time`, `modify_time`) VALUES ".$array;
    $db_insert = new db_query($sql);
    unset($_SESSION['cart']);
    success('Đặt hàng thành công !!');
}else{
    set_error('Vui lòng thêm sản phẩm vào giỏ hàng để tiến hành thanh toán');
}
