<?php
include '../home/config.php';

$name = getValue('name', 'str', 'POST', '');
$email = getValue('email', 'str', 'POST', '');
$phone = getValue('phone', 'str', 'POST', '');
$gender = getValue('gender', 'int', 'POST', '');
$rating = getValue('rate', 'int', 'POST', '');
$comment = getValue('comment', 'str', 'POST', '');

$id_product = getValue('id_product', 'int', 'POST', 0);
$parent = getValue('parent', 'int', 'POST', 0);
$timeaway = time();
$ip = client_ip();
if ($name == '') {
    set_error('Vui lòng nhập họ và tên');
}
if ($comment == '') {
    set_error('Vui lòng nhập nội dung bình luận');
}
$arr = [];
if (isset($_FILES['file'])) {
    $path = "../pictures/comment";
    $f_year = $path . "/" . date('Y', $timeaway);
    $f_month = $path . "/" . date('Y', $timeaway) . "/" . date('m', $timeaway);
    $f_date =  $path . "/" . date('Y', $timeaway) . "/" . date('m', $timeaway) . "/" . date('d', $timeaway);
    if (!file_exists($path)) @mkdir($path, 0777);
    if (!file_exists($f_year)) @mkdir($f_year, 0777);
    if (!file_exists($f_month)) @mkdir($f_month, 0777);
    if (!file_exists($f_date)) @mkdir($f_date, 0777);
    $maxSize = 2000000;
    $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'jfif', 'PNG');
    $files = $_FILES['file'];
    for ($i = 0; $i < count($files['name']); $i++) {
        $type = pathinfo($files['name'][$i], PATHINFO_EXTENSION);
        if (in_array($type, $allowTypes)) {
            $full_path = $f_date . "/" . $files['name'][$i];
            if (move_uploaded_file($files['tmp_name'][$i], $full_path) && $files['name'][$i] != '') {
                $new_name = generateRandomString();
                $full_path_new = $f_date . "/" . $new_name . ".png";
                rename($full_path, $full_path_new);
                array_push($arr, str_replace($path . "/", '', $full_path_new));
            }
        }
    }
}
$arr = implode(',', $arr);
$data = array(
    'id_product' => $id_product,
    'parent'    => $parent,
    'name'      => $name,
    'email'     => $email,
    'phone'     => $phone,
    'ip_address'=> $ip,
    'gender'    => $gender,
    'rate'      => $rating,
    'comment'   => $comment,
    'images'    => $arr,
    'created_time'  => time(),
    'status'        => 0,
);
add('tbl_comments', $data);
$id_comment = mysql_insert_id();
if($rating != ''){
    $query_count = new db_query("SELECT rate FROM `tbl_comments` WHERE ip_address != '' AND id_product = ".$id_product);
    $count = mysql_num_rows($query_count->result);
    if($count > 0){
        $sum = 0;
        while($value = mysql_fetch_assoc($query_count->result)){
            $sum += $value['rate'];
        }
        $rate = ceil($sum/$count);
    }
    $data_update = array('rate' => $rate,'total_rate' => 'total_rate' + 1);
    $condition = array('id' => $id_product );
    update('tbl_product',$data_update,$condition);
}
$output = array(
    'id_comment'=> $id_comment,
    'images'    => explode(',',$arr),
    'day'  => date('d/m/Y',time()),
    'time'  => date('H:i',time()),
);
echo json_encode($output);
