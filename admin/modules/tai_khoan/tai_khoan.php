<?php
include '../security/config.php';
$id_modules = 8;
$role = check_role($id_modules);
$action = getValue('action', 'str', 'GET', '');
$id = getValue('id', 'int', 'GET', 0);
$id = (int)$id;
$submit = getValue('submit', 'str', 'POST', '');
if ($action == '') {
    $sql = new db_query("SELECT id,username,name,email,modify_time,status FROM `tbl_admin` WHERE `delete` = 0 AND `id` != " . $_SESSION['user_id'] . " ORDER BY id DESC");
}
if ($action == 'delete' and $id != 0) {
    $sql = new db_query("UPDATE `tbl_admin` SET `delete` = '1' WHERE `id` = " . $id);
}
if($action == 'add'){
    $query = new db_query("SELECT * FROM `tbl_modules` ");
}
if ($action == 'edit' and $id != 0) {
    $sql = new db_query("SELECT * FROM `tbl_admin` WHERE 1 AND id = " . $id);
    $query = new db_query("SELECT * FROM `tbl_role` join `tbl_modules` on tbl_role.id_modules = tbl_modules.id where tbl_role.id_user = ".$id);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Quản lý tài khoản</title>
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
    <?php
    if ($action != '') {
        if ($action == 'add') {
            include 'add.php';
        }
        if ($action == 'edit') {
            include 'edit.php';
        }
    } else {
        if($role['view'] == 0){
            include '../../include/404.php';
        }else{
            include 'list.php';
        }
    }

    ?>
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
        $('#all_role').click(function(){
            if(this.checked) {
                // Iterate each checkbox
                $(':checkbox').each(function() {
                    this.checked = true;                        
                });
            } else {
                $(':checkbox').each(function() {
                    this.checked = false;                       
                });
            }
        });

        $('#btn_form').click(function() {
            var id = $('#id').val();
            var username = $('#username').val();
            var password = $('#password').val();
            var status = $('#status').val();
            var name = $('#name').val();
            var phone = $('#phone').val();
            var email = $('#email').val();
            var address = $('#address').val();
            var sapo = $('#sapo').val();
            var submit = $(this).val();

            if(email != ''){
                if( !validateEmail(email)){
                    $('#email').after("<label class='error'>Sai định dạng email</label>");
                }
            }
            if(phone != ''){
                if( !validatePhone(phone)){
                    $('#phone').after("<label class='error'>Sai định dạng số điện thoại</label>");
                }
            }

            var array_choose = [];
            $('.module').each(function(index) {
                elm = $(this);
                var id_module = elm.attr('data-id');
                var array_value = [];
                $(this).find('input[type=checkbox]').each(function(index, value) {
                    if ($(this).is(':checked')) {
                        array_value[index] = 1
                    } else {
                        array_value[index] = 0
                    }
                });
                array_choose[index] = {
                    id_module : id_module,
                    array_value : array_value
                }
            });
            $.ajax({
                type: "POST",
                url: "./ajax/account.php",
                data: {
                    id : id,
                    username : username,
                    password : password,
                    name : name,
                    status : status,
                    phone : phone,
                    email :email,
                    address : address,
                    sapo : sapo,
                    submit : submit,
                    array_choose: array_choose,
                },
                dataType: "json",
                success: function(data) {
                    if(data.result == false){
                        $('#username').after("<label class='error'>"+data.mes+"</label>");
                    }else{
                        alert(data.mes);
                        window.location.href = './tai-khoan';
                    }
                }
            });
        });
    });
    
    function validatePhone($phone){
        var phoneReg = /(84|0[3|5|7|8|9])+([0-9]{8})\b/;
        return phoneReg.test($phone);
    }
    function validateEmail($email) {
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        return emailReg.test($email);
    }

    function getParent(element, selector) {
        while (element.parentElement) {
            if (element.parentElement.matches(selector)) {
                return element.parentElement;
            }
            element = element.parentElement;
        }
    }
</script>

</body>

</html>