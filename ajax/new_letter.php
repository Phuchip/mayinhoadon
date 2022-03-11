<?php
include '../home/config.php';
$value = getValue('value', 'str', 'POST', '');
$id = getValue('id', 'int', 'POST', 0);
$ip = client_ip();
$query_check = new db_query("SELECT * FROM `tbl_new_letter` WHERE `id_product` = '" . $id . "' AND `ip_address` = '" . $ip . "' ");
if (mysql_num_rows($query_check->result) > 0) {
    set_error('Bạn đã đăng ký nhận tin cho sản phẩm này!');
} else {
    $data = array(
        'id_product' => $id,
        'info' => $value,
        'ip_address' => $ip, 
        'created_time' => time(),
        'modify_time' => time()
    );
    add('tbl_new_letter',$data);
    success('Bạn đã đăng ký nhận tin cho sản phẩm này thành công');
}
