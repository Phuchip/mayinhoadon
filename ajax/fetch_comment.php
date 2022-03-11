<?php 
include '../home/config.php';

$id_product = getValue('id_product','int','POST',4);
$output ='';
$query = new db_query("SELECT * FROM `tbl_comments` WHERE `parent` = 0 AND `status` = 0 AND `id_product` = ".$id_product);
if(mysql_num_rows($query->result) > 0){
    while($value = mysql_fetch_array($query->result)){
        $output .= '
            <div class="show-comment">
                <div class="col-md-3 info-user">
                    <div class="cmt-avatar">
                        <img class=" lazyload" src="/images/loading.gif" data-src="../pictures/users/Ellipse_83.png" alt="Avtar user">
                    </div>
                    <div class="name-date-cmt-mobile">
                        <p class="cmt-name">'.$value['name'].'</p>
                        <div class="cmt-date-time">
                            <span class="cmt-date">'.date('d/m/Y',$value['created_time']).'</span>
                            <span class="cmt-time">'.date('H:i',$value['created_time']).'</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-9 info-cmt">
                    <p class="cmt-content">'.$value['comment'].'</p>
                    <div class="cmt-image">';
        $output .= showImage($value['images']);
        $output .= '</div>
        <a href="javascript:void(0)" class="reply" id="'.$value['id'].'">Trả lời</a>';
        $output .= get_reply_comment($value['id'],$id_product);
        $output .='</div>
        </div>';
    }
}

function showImage($images = ''){
    $output3 = '';
    if($images != ''){
        $image = explode(',',$images);
        foreach($image as $row){
            $output3 .= '<img class="lazyload" src="/images/loading.gif" data-src="../pictures/comment/'.$row.'" alt="comment image">';
        }
    }
    return $output3;
}

function get_reply_comment($parent = 0,$id_product){
    $query2 = new db_query("SELECT * FROM `tbl_comments` WHERE `parent` = '".$parent."' AND `status` = 0 AND `id_product` = ".$id_product);
    $output1 = '';
    if(mysql_num_rows($query2->result) > 0){
        while($value2 = mysql_fetch_array($query2->result)){
            $output1 .= '
                <div class="show-reply d-flex">
                    <i class="ic-top-result"></i>
                    <div class="reply-avt">
                        <img class="lazyload" src="/images/loading.gif" data-src="../pictures/users/Ellipse_84.png">
                    </div>
                    <div class="reply-cmt">
                        <p class="reply-cmt-name">'.$value2['name'].'</p>
                        <p class="reply-cmt-content">'.$value2['comment'].'</p>
                        <div class="cmt-date-time">
                            <span class="cmt-date">'.date('d/m/Y',$value2['created_time']).'</span>
                            <span class="cmt-time">'.date('H:i',$value2['created_time']).'</span>
                        </div>
                    </div>
                </div>
            ';
        }
    }
    return $output1;
}
success('',$output);
?>