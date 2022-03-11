<?php 
session_start();
include '../home/config.php';

$hang_sx = getValue('hang_sx','str','POST','');
$loai_may = getValue('loai_may','str','POST','');
$ket_noi = getValue('ket_noi','str','POST','');
$kho_giay = getValue('kho_giay','str','POST','');

$list_filter = getValue('list_filter','arr','POST','');
$filter_product = getValue('filter_product','arr','POST','');
$stock_filter = getValue('stock_filter','arr','POST','');
$price_first = getValue('price_first','str','POST','');
$price_second = getValue('price_second','str','POST','');


$where = '';
if($hang_sx != ''){
    $where .= " AND manufacturer in (".$hang_sx.")";
}
if($loai_may != ''){
    $where .= " AND category in (".$loai_may.")";
}
if($ket_noi != ''){
    $where .= " AND category in (".$ket_noi.")";
}
if($kho_giay != ''){
    $where .= " AND category in (".$kho_giay.")";
}
if($price_first != '' && $price_second != ''){
    $price_first = formatMoney($price_first);
    $price_second = formatMoney($price_second);
    $where .= "AND price_old BETWEEN '".$price_first."' AND '".$price_second."' ";
}
if($stock_filter != ''){
    foreach($stock_filter as $value){
        if($value == 'con_hang'){
            $where .= 'AND quantity > 0';
        }elseif($value == 'lien_he'){
            $where .= 'AND contact > 0';
        }
    }
}
$order = '';
if($list_filter != ''){
    foreach($list_filter as $value){
        if($value == 'hang_moi'){
            $order .= 'created_time DESC,';
        }elseif($value == 'xem_nhieu'){
            $order .= 'view DESC,';
        }elseif($value == 'giam_nhieu'){
            $order .= 'discount DESC,';
        }elseif($value == 'tang_dan'){
            $order .= 'price_old ASC,';
        }elseif($value == 'giam_dan'){
            $order .= 'price_old DESC,';
        }
    }
}elseif($filter_product != ''){
    foreach($filter_product as $value){
        if($value == 'danh_gia'){
            $order .= 'rate DESC,';
        }elseif($value == 'ten_a_z'){
            $order .= 'name DESC,';
        }
    }
}
$output1 = '';
$output2 = '';
$output3 = '';
$str = '';
foreach($array_top_sale as $value){
    $str .= $value['id_product'].',';
}
$str = rtrim($str,',');
$query = new db_query("SELECT id,name,alias,price_old,discount,quantity,image,code_product,contact,rate,total_rate FROM `tbl_product` WHERE `delete` = 0 AND `status` = 1 AND `id` in(".$str.") ".$where." ORDER BY ".$order." modify_time DESC");
// var_dump($query);die;
if(mysql_num_rows($query->result) > 0){
    while($value = mysql_fetch_array($query->result)){
        $output1 .= '
            <div class="item d-block col-xxl-3 col-xl-3 col-lg-4 col-md-6 col-sm-12 col12">
            <div class="item-wrapper">
                <div class="row item-top">
                    <div class="col-12">';
                    if($value['discount'] > 0){
                        $output1 .= '<div class="sale-tag"><span>-'.$value['discount'].'%</span></div>';
                    }          
                    $output1 .= '<a href="'.rewrite_alias($value['id'], $value['alias']).'"><img class="img-fluid item-img" src="/images/item/'.$value['image'].'" alt="'.rewrite_title($value['name']).'"></a>
                    </div>
                </div>
                <div class="row item-body">
                    <div class="col-7 float-start">
                        <div class="rating">
                            '.star_rating($value['rate']).'
                            <span class="rating-num d-inline">( '.$value['total_rate'].' )</span>
                        </div>
                    </div>
                    <div class="col-5 float-end">
                        <p class="item-code">MÃ: '.$value['code_product'].'</p>
                    </div>
                    <p class="mt-2 title-product"><a class="item-title text-decoration-none" href="'.rewrite_alias($value['id'], $value['alias']).'">'.rewrite_title($value['name']).'</a></p>
                    <div class="col-12 item-price">
                        <p class="price">
                            <span class="price-new">'.price_new_2($value['price_old'], $value['discount']).' đ</span>
                            ';
                            if($value['discount'] > 0){
                                $output1 .= '<span class="price-old">'.$value['price_old'].' đ</span>';
                            } 
            $output1 .= '
                        </p>

                    </div>
                    <div class="col-6 item-status float-start d-inline">
                        '.check_status_3($value['quantity'],$value['contact']).'
                    </div>
                    <div class="col-6 add-to-cart float-end d-inline">
                        <button '.disable_button_2($value['quantity'],$value['contact']).' class="button-add-cart" value="'.$value['id'].'" onclick="addToCart(this.value)"><i class="ic-cart"></i></button>
                    </div>

                </div>
                <div class="row item-footer">
                    <div class="col-2  float-start">
                        <i class="ic-presents"></i>
                    </div>
                    <div class="col-10  float-end bonus-gift">
                        <p>Tặng: <span class="text-danger text-decoration-none">Phần mềm Quản lý bán hàng</span>
                            khi mua sản phẩm tại website</p>
                    </div>
                </div>
            </div>
        </div>
        ';
    }
}else{
    $output1 .= '<div class="no-found">
    <img src="../images/no-products-found.png" alt="Không có kết quả">
    <p>Không tìm thấy sản phẩm nào phù hợp</p>
</div>';
}

$query2= new db_query("SELECT id,name,alias,price_old,discount,quantity,image,code_product,contact,rate,total_rate FROM `tbl_product` WHERE `delete` = 0 AND `status` = 1 ".$where." ORDER BY ".$order." discount DESC limit 12");
if(mysql_num_rows($query2->result) > 0){
    while($value = mysql_fetch_array($query2->result)){
        $output2 .= '
            <div class="item d-block col-xxl-3 col-xl-3 col-lg-4 col-md-6 col-sm-12 col12">
            <div class="item-wrapper">
                <div class="row item-top">
                    <div class="col-12">';
        if($value['discount'] > 0){
            $output2 .= '<div class="sale-tag"><span>-'.$value['discount'].'%</span></div>';
        }          
        $output2 .= '<a href="'.rewrite_alias($value['id'], $value['alias']).'"><img class="img-fluid item-img" src="/images/item/'.$value['image'].'" alt="'.rewrite_title($value['name']).'"></a>
                    </div>
                </div>
                <div class="row item-body">
                    <div class="col-7 float-start">
                        <div class="rating">
                            '.star_rating($value['rate']).'
                            <span class="rating-num d-inline">( '.$value['total_rate'].' )</span>
                        </div>
                    </div>
                    <div class="col-5 float-end">
                        <p class="item-code">MÃ: '.$value['code_product'].'</p>
                    </div>
                    <p class="mt-2 title-product"><a class="item-title text-decoration-none" href="'.rewrite_alias($value['id'], $value['alias']).'">'.rewrite_title($value['name']).'</a></p>
                    <div class="col-12 item-price">
                        <p class="price">
                            <span class="price-new">'.price_new_2($value['price_old'], $value['discount']).' đ</span>
                            ';
                            if($value['discount'] > 0){
                                $output2 .= '<span class="price-old">'.$value['price_old'].' đ</span>';
                            } 
            $output2 .= '</p>

                    </div>
                    <div class="col-6 item-status float-start d-inline">
                        '.check_status_3($value['quantity'],$value['contact']).'
                    </div>
                    <div class="col-6 add-to-cart float-end d-inline">
                        <button '.disable_button_2($value['quantity'],$value['contact']).' class="button-add-cart" value="'.$value['id'].'" onclick="addToCart(this.value)"><i class="ic-cart"></i></button>
                    </div>

                </div>
                <div class="row item-footer">
                    <div class="col-2  float-start">
                        <i class="ic-presents"></i>
                    </div>
                    <div class="col-10  float-end bonus-gift">
                        <p>Tặng: <span class="text-danger text-decoration-none">Phần mềm Quản lý bán hàng</span>
                            khi mua sản phẩm tại website</p>
                    </div>
                </div>
            </div>
        </div>
        ';
    }
}else{
    $output2 .= '<div class="no-found">
    <img src="../images/no-products-found.png" alt="Không có kết quả">
    <p>Không tìm thấy sản phẩm nào phù hợp</p>
</div>';
}

$query3= new db_query("SELECT id,name,alias,price_old,discount,quantity,image,code_product,contact,rate,total_rate FROM `tbl_product` WHERE `delete` = 0 AND `status` = 1 ".$where." ORDER BY ".$order." view DESC limit 12");
if(mysql_num_rows($query3->result) > 0){
    while($value = mysql_fetch_array($query3->result)){
        $output3 .= '
            <div class="item d-block col-xxl-3 col-xl-3 col-lg-4 col-md-6 col-sm-12 col12">
            <div class="item-wrapper">
                <div class="row item-top">
                    <div class="col-12">';
        if($value['discount'] > 0){
            $output3 .= '<div class="sale-tag"><span>-'.$value['discount'].'%</span></div>';
        }          
        $output3 .= '<a href="'.rewrite_alias($value['id'], $value['alias']).'"><img class="img-fluid item-img" src="/images/item/'.$value['image'].'" alt="'.rewrite_title($value['name']).'"></a>
                    </div>
                </div>
                <div class="row item-body">
                    <div class="col-7 float-start">
                        <div class="rating">
                            '.star_rating($value['rate']).'
                            <span class="rating-num d-inline">( '.$value['total_rate'].' )</span>
                        </div>
                    </div>
                    <div class="col-5 float-end">
                        <p class="item-code">MÃ: '.$value['code_product'].'</p>
                    </div>
                    <p class="mt-2 title-product"><a class="item-title text-decoration-none" href="'.rewrite_alias($value['id'], $value['alias']).'">'.rewrite_title($value['name']).'</a></p>
                    <div class="col-12 item-price">
                        <p class="price">
                            <span class="price-new">'.price_new_2($value['price_old'], $value['discount']).' đ</span>
                            ';
                            if($value['discount'] > 0){
                                $output3 .= '<span class="price-old">'.$value['price_old'].' đ</span>';
                            } 
            $output3 .= '</p>

                    </div>
                    <div class="col-6 item-status float-start d-inline">
                        '.check_status_3($value['quantity'],$value['contact']).'
                    </div>
                    <div class="col-6 add-to-cart float-end d-inline">
                        <button '.disable_button_2($value['quantity'],$value['contact']).' class="button-add-cart" value="'.$value['id'].'" onclick="addToCart(this.value)"><i class="ic-cart"></i></button>
                    </div>

                </div>
                <div class="row item-footer">
                    <div class="col-2  float-start">
                        <i class="ic-presents"></i>
                    </div>
                    <div class="col-10  float-end bonus-gift">
                        <p>Tặng: <span class="text-danger text-decoration-none">Phần mềm Quản lý bán hàng</span>
                            khi mua sản phẩm tại website</p>
                    </div>
                </div>
            </div>
        </div>
        ';
    }
}else{
    $output3 .= '<div class="no-found">
    <img src="../images/no-products-found.png" alt="Không có kết quả">
    <p>Không tìm thấy sản phẩm nào phù hợp</p>
</div>';
}

$output = array('output1' => $output1,'output2' => $output2,'output3' => $output3);
echo json_encode($output);
