<?
session_start();
include("../home/config.php"); 

if ($_POST['name']== null || $_POST['phone']== null || $_POST['mail']== null || $_POST['nd']== null || $_POST['capcha'] == null) {
	echo " * Vui lòng điền đầy đủ thông tin";
}else{

if($_POST['capcha'] == $_SESSION['code'])
{
  $db_qrs = new db_query("INSERT INTO lien_he (lh_name, lh_phone, lh_email, lh_nd) VALUES ('".$_POST['name']."', '".$_POST['phone']."', '".$_POST['mail']."', '".$_POST['nd']."')");
  echo " * Lưu thành công";
}
else
{
  echo" * Mã lệnh không hợp lệ ";
}
}

?>