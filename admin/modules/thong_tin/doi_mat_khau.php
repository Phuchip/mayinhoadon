<?php
include '../security/config.php';
$sql = new db_query("SELECT * FROM `tbl_admin` WHERE 1 AND id = " . $_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Đổi mật khẩu</title>
    <meta name="twitter:card" content="summary_large_image" />
    <link rel="shortcut icon" href="../images/favicon.png" type="image/x-icon" />
    <!-- Custom fonts for this template-->
    <link href="./vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template-->
    <link href="./css/sb-admin-2.min.css" rel="stylesheet">
    <link href="./css/admin.css" rel="stylesheet">
    <link href="./fonts/font.css" rel="stylesheet">
    <script type="text/javascript" src="../ckeditor446/ckeditor.js"></script>
    <script type="text/javascript" src="../ckfinder/ckfinder.js"></script>
    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<?php include '../../include/inc_head.php' ?>
<!-- End of Topbar -->

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800 bb">Đổi mật khẩu</h1>
    <!-- DataTales Example -->
    <?php if (isset($sql)) {
        $data = mysql_fetch_array($sql->result);
    }
    ?>
    <form method="POST" id="form_account" enctype="multipart/form-data" onsubmit="return false" novalidate="novalidate">
        <div class="form-group info">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Mật khẩu cũ</label>
                        <input id="password_old" class="form-control" required >
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Mật khẩu mới</label>
                        <input id="password" class="form-control" required >
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Nhập lại mật khẩu mới</label>
                        <input id="re_password" class="form-control" required >
                    </div>
                </div>
            </div>
            
            <div class="col-md-12 text-center">
                <button type="submit" id="btn_form" class="btn btn-info" value="update">Đổi mật khẩu</button>
            </div>
        </div>
    </form>
</div>
<!-- /.container-fluid -->

<?php include '../../include/inc_footer.php' ?>

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>
<script>
    $(document).ready(function() {
        $('#btn_form').click(function() {
            var password_old = $('#password_old').val();
            var password = $('#password').val();
            var re_password = $('#re_password').val();
            var submit = $(this).val();
            if(password_old == ''){
                return $('#password_old').after("<label class='error'>Vui lòng nhập mật khẩu cũ</label>");
            }
            $('.error').remove();
            if (password !== re_password) {
                return $('#re_password').after("<label class='error'>Vui lòng nhập lại đúng password</label>");
            }
            $('.error').remove();
            if(password.length < 8){
                return  $('#password').after("<label class='error'>Vui lòng nhập mật khẩu tối thiểu 8 ký tự</label>");
            }else{
                $('.error').remove();
            }
            $.ajax({
                type: "POST",
                url: "./ajax/change_pass.php",
                data: {
                    password_old: password_old,
                    password: password,
                    submit: submit,
                },
                dataType: "json",
                success: function(data) {
                    if (data.result == true) {
                        alert(data.mes);
                        window.location.href = './doi-mat-khau';
                    } else{
                        $('#password_old').after("<label class='error'>" + data.mes + "</label>");
                    }
                }
            });
        });
    });
</script>

</body>

</html>