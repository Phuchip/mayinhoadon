<?php
include '../home/config.php';
$query_array_product = new db_query("SELECT id,name,alias,price_old,discount,image FROM `tbl_product` WHERE `delete` = 0 AND `status` = 1");
while ($value = mysql_fetch_array($query_array_product->result)) {
    $data[$value['id']] = array(
    	'id'	=> $value['id'],
    	'name'	=> 'Máy in hóa đơn '.$value['name'],
    	'link'	=> rewrite_alias($value['id'],$value['alias']),
    	'image'	=> $value['image'],
    	'price_new'	=> price_new_2($value['price_old'],$value['discount']),
    	'price_old'	=> $value['price_old'],
    	'discount'	=> $value['discount'],
    );
}
echo json_encode($data);

?>