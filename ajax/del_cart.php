<?
session_start();
include '../home/config.php';
$action = getValue('action','str','POST','');
if($action == 'delete_all'){
    unset($_SESSION['cart']);
    success('Xóa giỏ hàng thành công');
}
?>