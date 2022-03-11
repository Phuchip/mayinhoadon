<?php
session_start();
require_once("../functions/translate.php");
require_once("../functions/functions.php");
require_once("../classes/config.php");
require_once("../classes/database.php");
require_once("modules/security/functions.php");
$username	= getValue("username", "str", "POST", "", 1);
$password	= getValue("password", "str", "POST", "", 1);
$action		= getValue("action", "str", "POST", "");
if ($action = 'login') {
    $user_id = 0;
    $user_id = checkLogin($username,$password);
    if($user_id != 0){
		$isAdmin		= 0;
		$db_isadmin	= new db_query("SELECT id,name,image FROM `tbl_admin` WHERE id = " . $user_id);
		$row			= mysql_fetch_array($db_isadmin->result);
		//Set SESSION
		$_SESSION["logged"]			= 1;
		$_SESSION["user_id"]		= $user_id;  
   		$_SESSION["admin_id"]       = $row['id'];
		$_SESSION["userlogin"]		= $username;
		$_SESSION["password"]		= md5($password);
		$_SESSION["isAdmin"]		= $isAdmin;
        $_SESSION["name"]         = $row['name'];
        $_SESSION["avatar"]         = $row['image'];
        $_SESSION["checsum"]		= md5($user_id . "|" . $username . "|" . md5($password) . "|" . $key_checksum);
		unset($db_isadmin);
	}
}
$logged = getValue("logged", "int", "SESSION", 0);

?>
<!DOCTYPE html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<title>Đăng nhập</title>
    <meta name="twitter:card" content="summary_large_image" />
	<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="css/admin.css" rel="stylesheet">
    <link href="fonts/font.css" rel="stylesheet">
</head>
<?
if($logged == 1){
	?>
	<script language="javascript">
   	window.parent.location.href="./";
   </script>
	<?
}
?>
<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <img src="../images/logo1.png" alt="">
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Đăng nhập trang quản trị</p>

                <form action="<?=$_SERVER['REQUEST_URI']?>" method="POST">
                    <div class="input-group mb-3">
                        <input type="text" name="username" class="form-control" placeholder="Tên đăng nhập">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Mật khẩu">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- /.col -->
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-primary btn-block" value="login">Đăng nhập</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
</body>
</html>