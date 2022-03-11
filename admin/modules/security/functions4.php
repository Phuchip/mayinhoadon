<?php
function checkStatus($status){
    $text = '';
    if($status >= 1){
        $text = 'Ellipse30.png';
    }else{
        $text = 'Ellipse_88.png';
    }
    echo $text;
}
function price_new($price_old,$discount=0){
    if ($discount == 0) {
        $price_new = $price_old;
    } else {
        $price_old = (float)$price_old;
        $price = $price_old*(100 - $discount)/100;
        $price_new = number_format((float)$price,3,'.','').'.000';
    }
    echo $price_new;
}
function formatMoney($price){
    $price = number_format((float)$price,3,'.','').'.000';
    return $price;
}
$query_hang_sx = new db_query("SELECT id,name FROM `tbl_manufacturer` ORDER BY id DESC");
$array_hang_sx = $query_hang_sx->result_array('id');

$query_loai_may = new db_query("SELECT id,name FROM `tbl_category` ORDER BY id DESC");
$array_loai_may = $query_loai_may->result_array('id');

$query_ket_noi = new db_query("SELECT id,name FROM `tbl_connector` ORDER BY id DESC");
$array_ket_noi = $query_ket_noi->result_array('id');

$query_kho_giay = new db_query("SELECT id,name FROM `tbl_paper_size` ORDER BY id DESC");
$array_kho_giay = $query_kho_giay->result_array('id');

$query_modules = new db_query("SELECT * FROM `tbl_modules` ORDER BY id ASC");
$array_modules = $query_modules->result_array('id');

$query_tag = new db_query("SELECT * FROM `tbl_tags` ORDER BY id ASC");
$array_tag = $query_tag->result_array('id');

$trang_thai = array(
    '1'=> array(
        'id'=> '1',
        'name'=>'Bật',
    ),
    '0'=> array(
        'id'=> '0',
        'name'=>'Tắt',
    ),
);
$lien_he = array(
    '0'=> array(
        'id'=> '0',
        'name'=>'Tắt',
    ),
    '1'=> array(
        'id'=> '1',
        'name'=>'Bật',
    ),
    
);
$status_order = array('1' => 'Chờ xác nhận','2'=>'Tư vấn','3'=>'Hoàn thành' );

$arraytong = array(
               'array_hang_sx' => $array_hang_sx,
               'array_loai_may' => $array_loai_may,
               'array_ket_noi' => $array_ket_noi,
               'array_kho_giay'=> $array_kho_giay,
               'array_modules' => $array_modules,
               'array_tag' => $array_tag,
           );
$OUTPUT = json_encode($arraytong); 

?>