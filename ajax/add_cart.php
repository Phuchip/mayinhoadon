<?
session_start();
include '../home/config.php';

$id = getValue('id', 'int', 'POST', 0);
$quantity = getValue('quantity', 'int', 'POST', 0);
$id = (int)$id;
$quantity = (int)$quantity;
$action = getValue('action', 'str', 'POST', '');
if ($action == 'add') {
    $qr_check = new db_query("SELECT `name`,`alias`,`image`,`quantity`,`price_old`,`discount` FROM `tbl_product` WHERE `id`=" . $id);
    $check_num = mysql_fetch_assoc($qr_check->result);
    if ($check_num['quantity'] < $quantity) {
        set_error('Số lượng trong kho không đủ xin vui lòng nhập lại số lượng');
    }
    if (isset($id) && $id != 0) {
        if (isset($_SESSION['cart'])) {
            $is_available = 0;
            foreach ($_SESSION['cart'] as $key => $value) {
                if ($value['id'] == $id) {
                    $is_available++;
                    $_SESSION['cart'][$key]['quantity'] = $value['quantity'] + $quantity;
                }
            }
            if ($is_available == 0) {
                $item_array = array(
                    'id'    => $id,
                    'name'  => $check_num['name'],
                    'alias' => $check_num['alias'],
                    'quantity'  => $quantity,
                    'price' => price_new_2($check_num['price_old'], $check_num['discount']),
                    'image' => $check_num['image']
                );
                $_SESSION['cart'][] = $item_array;
            }
        } else {
            $item_array = array(
                'id'    => $id,
                'name'  => $check_num['name'],
                'alias' => $check_num['alias'],
                'quantity'  => $quantity,
                'price' => price_new_2($check_num['price_old'], $check_num['discount']),
                'image' => $check_num['image']
            );
            $_SESSION['cart'][] = $item_array;
        }
        
    }
    success('Thêm giỏ hàng thành công');
}elseif($action == 'delete'){
    $num = 0;
    $total = 0;
    foreach($_SESSION['cart'] as $key => $value){
        if($value['id'] == $id){
            unset($_SESSION['cart'][$key]);
        }else{
            $num += $_SESSION['cart'][$key]['quantity'];
            $total += $_SESSION['cart'][$key]['price'] * $_SESSION['cart'][$key]['quantity'];
            $total = number_format((float)$total,3,'.','').'.000';
        }
    }
    $GLOBALS['num'] = $num;
    $GLOBALS['total'] = $total;
    $data = array('num' => $num,'total'=> $total );
    echo json_encode($data);
    
}elseif($action == 'update'){
    $num = 0;
    $total = 0;
    foreach($_SESSION['cart'] as $key => $value){
        if($value['id'] == $id){
            $_SESSION['cart'][$key]['quantity'] =  $quantity;
        }
        $num += $_SESSION['cart'][$key]['quantity'];
        $total += $_SESSION['cart'][$key]['price'] * $_SESSION['cart'][$key]['quantity']; 
        $total = number_format((float)$total,3,'.','').'.000';
    }
    $GLOBALS['num'] = $num;
    $GLOBALS['total'] = $total;
    $data = array('num' => $num,'total'=> $total );
    echo json_encode($data);
}
