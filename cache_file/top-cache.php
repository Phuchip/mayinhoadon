<?
include("../home/config.php");
// text file cache 

function rewrite_alias($id,$alias){
    $url = '/'.$alias.'-id-'.$id.'.html';
    return $url;
}
function rewrite_title($name=''){
    $title = 'Máy in hóa đơn '.$name;
    return $title;
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
function price_new_2($price_old,$discount=0){
    if ($discount == 0) {
        $price_new = $price_old;
    } else {
        $price_old = (float)$price_old;
        $price = $price_old*(100 - $discount)/100;
        $price_new = number_format((float)$price,3,'.','').'.000';
    }
    return $price_new;
}
function formatMoney($number, $fractional=false) {  
    if ($fractional) {  
        $number = sprintf('%.2f', $number);  
    }  
    while (true) {  
        $replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1.$2', $number);  
        if ($replaced != $number) {  
            $number = $replaced;  
        } else {  
            break;  
        }  
    }  
    return $number;  
}
function check_status($quantity,$contact){
    $text = '';
    if($contact > 0){
        $text = '<i class="ic-tick-contact"></i>
            <span class="contact-icon">Liên hệ</span>';
    }else{
        if($quantity >= 1){
            $text = '<i class="ic-tick"></i>
            <span>Còn hàng</span>';
        }else{
            $text = '<i class="ic-tick-off"></i>
            <span class="color-red">Hết hàng</span>';
        }
    }
    echo $text;
}
function check_status_2($quantity,$contact){
    $text = '';
    if($contact > 0){
        $text = '<i class="ic-tick-contact"></i>
            <p class="contact-icon">Liên hệ</p>';
    }else{
        if($quantity >= 1){
            $text = '<i class="ic-status active"></i>
            <p>Còn hàng</p>';
        }else{
            $text = '<i class="ic-status"></i>
            <p>Hết hàng</p>';
        }
    }
    echo $text;
}
function check_status_3($quantity,$contact){
    $text = '';
    if($contact > 0){
        $text = '<i class="ic-tick-contact"></i>
            <span class="contact-icon">Liên hệ</span>';
    }else{
        if($quantity >= 1){
            $text = '<i class="ic-tick"></i>
            <span>Còn hàng</span>';
        }else{
            $text = '<i class="ic-tick-off"></i>
            <span class="color-red">Hết hàng</span>';
        }
    }
    return $text;
}
function disable_button($quantity,$contact){
    $text = '';
    if($contact > 0){
        $text = 'type="button" disabled';
    }else{
        if($quantity < 1){
            $text = 'type="button" disabled';
        }
    }
    echo $text;
}
function disable_button_2($quantity,$contact){
    $text = '';
    if($contact > 0){
        $text = 'type="button" disabled';
    }else{
        if($quantity < 1){
            $text = 'type="button" disabled';
        }
    }
    return $text;
}
function set_error($mes){
    $data = array('result' => false,'mes' => $mes );
    echo json_encode($data);
    exit();
}
function success($mes,$output=''){
    $data = array('result' => true,'mes' => $mes,'output'=>$output);
    echo json_encode($data);
    exit();
}
function redirect_301($link){
    header("HTTP/1.1 301 Moved Permanently"); 
    header("Location: $link"); 
    exit();
}
function check_rating($ip='',$id=0){
    $query = new db_query("SELECT * FROM `tbl_comments` WHERE ip_address = '".$ip."' AND rate != '' AND id_product = '".$id."' ");
    $count = mysql_num_rows($query->result);
    return $count;
}
function star_rating($rating = 0){
    $text = '';
    for($i = 1;$i<6;$i++){
        $check = '';
        if($i <= $rating){
            $check = 'checked';
        }
        $text .= '
            <i class="ic-star '.$check.'"></i>
        ';
    }
    return $text;
}
function count_rate($id = 0){
    $rate = array('5' => 0,'4'=>0,'3'=>0,'2'=>0,'1'=>0 );
    $query_rate = new db_query("SELECT `rate` FROM `tbl_comments` WHERE `rate` != 0 AND `id_product` = '".$id."' ");
    $total = mysql_num_rows($query_rate->result);
    if($total > 0){
        while($value = mysql_fetch_assoc($query_rate->result)){
            for($i= 1;$i<6;$i++){
                if($value['rate'] == $i){
                    $rate[$i] = $rate[$i] + 1; 
                }
            }
        }
    }
    $output = '';
    foreach($rate as $key => $row){
        if($row > 0){
            $output .= '<li class="active">';
        }else{
            $output .= '<li>';
        }
        $output .= '
                <span>'.$key.'</span>
                <i class="ic-star-grey"></i>
                <div class="bg-line-color">';
        if($total != 0){
            $percent = ($row/$total)*100;
            $output .= '<p class="time-line-star" style="width:'.$percent.'%"></p>';
        }else{
            $output .= '<p class="time-line-star"></p>';
        }
                    
            $output .= '</div>
                <p class="rate-txt">'.$row.' Đánh giá</p>
            </li>
        ';
    }
    return $output;
}
$num = 0;
$total = 0;
if(isset($_SESSION['cart'])){
    foreach($_SESSION['cart'] as $key => $value){
        $num += $value['quantity'];
        $total += $value['quantity'] * $value['price'];
        $total = number_format((float)$total,3,'.','').'.000';
    }
}

$GLOBALS['num']= $num;
$GLOBALS['total'] = $total;


$file = '../cache_file/sql_cache.json'; 
$query_hang_sx = new db_query("SELECT * FROM `tbl_manufacturer` ORDER BY id DESC");
$array_hang_sx = $query_hang_sx->result_array('id');

$query_loai_may = new db_query("SELECT * FROM `tbl_category` ORDER BY id DESC");
$array_loai_may = $query_loai_may->result_array('id');

$query_ket_noi = new db_query("SELECT * FROM `tbl_connector` ORDER BY id DESC");
$array_ket_noi = $query_ket_noi->result_array('id');

$query_kho_giay = new db_query("SELECT * FROM `tbl_paper_size` ORDER BY id DESC");
$array_kho_giay = $query_kho_giay->result_array('id');

$query_recom_search = new db_query("SELECT id,name,alias,price_old,discount,quantity,image,code_product FROM `tbl_product` WHERE `delete` = 0 AND `status` = 1 ORDER BY `modify_time` DESC LIMIT 5");
$array_recom_search = $query_recom_search->result_array('id');

$query_top_sale = new db_query("SELECT id_product,sum(quantity) as quantity FROM tbl_detail_order GROUP BY id_product ORDER BY SUM(quantity) DESC limit 12");
$array_top_sale = $query_top_sale->result_array('id_product');

$query_tag = new db_query("SELECT * FROM tbl_tags limit 3");
$array_tag = $query_tag->result_array('id');

$query_all_tag = new db_query("SELECT * FROM tbl_tags");
$array_all_tag = $query_all_tag->result_array('id');

$array_filter = array(
    '0' => array('id' => 1,'name'  => 'Hàng Mới','value'  => 'hang_moi'),
    '1' => array('id' => 2,'name'  => 'Xem Nhiều','value'  => 'xem_nhieu'),
    '2' => array('id' => 3,'name'  => 'Giá Giảm Nhiều','value'  => 'giam_nhieu'),
    '3' => array('id' => 4,'name'  => 'Giá Tăng Dần','value'  => 'tang_dan'),
    '4' => array('id' => 5,'name'  => 'Giá Giảm Dần','value'  => 'giam_dan'),
);

$query_array_product = new db_query("SELECT id,name,alias,price_old,discount,image FROM `tbl_product` WHERE `delete` = 0 AND `status` = 1");
$array_product = $query_array_product->result_array('id');

$arraytong = array(
               'array_hang_sx' => $array_hang_sx,
               'array_loai_may' => $array_loai_may,
               'array_ket_noi' => $array_ket_noi,
               'array_kho_giay' => $array_kho_giay,
               'array_recom_search' => $array_recom_search,
               'array_top_sale' => $array_top_sale,
               'array_filter' => $array_filter,
               'array_tag' => $array_tag,
               'array_all_tag' => $array_all_tag,
               'array_product'  => $array_product
           );
$OUTPUT = json_encode($arraytong);  
$fp = fopen($file,"w"); 
fputs($fp, $OUTPUT); 
fclose($fp);
