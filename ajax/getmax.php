<?php 
include '../home/config.php';

$query = new db_query("SELECT MAX(price_old) as max FROM `tbl_product`");
$data = mysql_fetch_assoc($query->result);
$max = ($data['max']*1000000)+100000;
echo json_encode($max);
?>