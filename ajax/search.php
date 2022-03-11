<?php 
include '../home/config.php';
$key = getValue('key','str','POST','');
$output ='';
$output2 = '';
$sql = new db_query("SELECT id,name,alias,price_old,discount,image FROM `tbl_product` WHERE `delete` = 0 AND `status` = 1 AND `name` LIKE '%".$key."%' ORDER BY modify_time DESC limit 5");
$sql2 = new db_query("SELECT * FROM `tbl_tags` WHERE `name` LIKE '%".$key."%' LIMIT 3");
if(mysql_num_rows($sql->result) > 0){
    while($value = mysql_fetch_array($sql->result)){
        $output .= '
            <li class="item-suggest d-flex">
            <a href="'.rewrite_alias($value['id'], $value['alias']).'">
                <img src="/images/item/'.$value['image'].'" alt="'.$value['name'].'">
            </a>
            <div class="item-info">
                <a href="'.rewrite_alias($value['id'], $value['alias']).'" class="item-info-title">
                    <p>'.$value['name'].'</p>
                </a>
                <p class="price">
                    <span class="price-new">'.price_new_2($value['price_old'], $value['discount']).' đ</span>
                    <span class="price-old">'.$value['price_old'].' đ</span>
                </p>
                <div class="item-gift">
                    <img src="../images/icon/presents_2.png">
                    <span>Phần mềm Quản lý bán hàng </span>
                </div>
            </div>
        </li>
        ';
    }
}else{
    $output .= '<label class="no-result">Không có kết quả tìm kiếm phù hợp</label>';
}
if(mysql_num_rows($sql2->result) > 0){
    while($value = mysql_fetch_array($sql2->result)){
        $output2 .= '
            <li class="list-group-item"><a href="/'.$value['alias'].'-ID-'.$value['id'].'.html">'.$value['name'].'</a></li>
        ';
    }
}else{
    $output2 .='<li class="list-group-item">Không có kết quả tìm kiếm phù hợp</li>';
}
$data = array('output1' => $output,'output2'=>$output2 );
echo json_encode($data);

?>