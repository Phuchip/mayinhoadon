<?php 
session_start();
include '../home/config.php';

$hang_sx = getValue('hang_sx','str','POST','');
$loai_may = getValue('loai_may','str','POST','');
$ket_noi = getValue('ket_noi','str','POST','');
$kho_giay = getValue('kho_giay','str','POST','');

$list_filter = getValue('list_filter','str','POST','');
$filter_product = getValue('filter_product','arr','POST','');
$stock_filter = getValue('stock_filter','arr','POST','');
$price_first = getValue('price_first','str','POST','');
$price_second = getValue('price_second','str','POST','');
$link = getValue('link','str','POST','');

$url = '';
$filter ='';
$filter_product ='';
$output1 = '';
$output2 = '';
$output3 = '';

if($list_filter != ''){
    if($list_filter == 'hang_moi'){
        $filter = '&filter=hang_moi';
    }elseif($list_filter == 'xem_nhieu'){
        $filter = '&filter=xem_nhieu';
    }elseif($list_filter == 'giam_nhieu'){
        $filter = '&filter=giam_nhieu';
    }elseif($list_filter == 'tang_dan'){
        $filter = '&filter=tang_dan';
    }elseif($list_filter == 'giam_dan'){
        $filter = '&filter=giam_dan';
    }
}
if($filter_product != ''){
    if($filter_product == 'danh_gia'){
        $product = '&product=danh_gia';
    }
    if($filter_product == 'ten_a_z'){
        $product = '&product=ten_a_z';
    }
}

$url = '?action=filter'.$link;
$data = array(
    'result' => true,
    'url'   => $url,
    'output1'   => $output1,
    'output2'   => $output2,
    'output3'   => $output3,
);

echo json_encode($data);

?>