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
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800 bb">Thông tin tài khoản</h1>
    <!-- DataTales Example -->
    <?php if (isset($sql)) {
        $data = mysql_fetch_array($sql->result);
    }
    ?>
    <form method="POST" id="form_account" enctype="multipart/form-data" onsubmit="return false" novalidate="novalidate">
        <div class="form-group info">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Tên đăng nhập</label>
                        <input readonly name="username" class="form-control" required value="<?= (isset($data)) ? $data['username'] : '' ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="info-first">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Họ tên</label>
                                <input id="name" name="name" class="form-control" required value="<?= (isset($data)) ? $data['name'] : '' ?>">
                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <div class="form-group">
                                <label>Số điện thoại</label>
                                <div class="validate">
                                    <input id="phone" name="phone" class="form-control" value="<?= (isset($data)) ? $data['phone'] : '' ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="info-second">
                        <div class="col-md-6 ">
                            <div class="form-group">
                                <label>Email</label>
                                <input id="email" name="email" class="form-control" value="<?= (isset($data)) ? $data['email'] : '' ?>">
                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <div class="form-group">
                                <label>Địa chỉ</label>
                                <input name="address" id="address" class="form-control" value="<?= (isset($data)) ? $data['address'] : '' ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Mô tả</label>
                            <textarea name="sapo" id="sapo" class="form-control" style="height: 120px;" cols="30" rows="10"><?= (isset($data)) ? $data['sapo'] : '' ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 text-center">
                <button type="submit" id="btn_form" class="btn btn-info" name="submit" value="<?= (isset($data)) ? 'update' : 'add' ?>"><?= (isset($data)) ? 'Cập nhật' : 'Thêm mới' ?></button>
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

            if (email != '') {
                if (!validateEmail(email)) {
                    $('#email').after("<label class='error'>Sai định dạng email</label>");
                }
            }
            if (phone != '') {
                if (!validatePhone(phone)) {
                    $('#phone').after("<label class='error'>Sai định dạng số điện thoại</label>");
                }
            }

            $.ajax({
                type: "POST",
                url: "./ajax/info.php",
                data: {
                    id: id,
                    username: username,
                    password: password,
                    name: name,
                    status: status,
                    phone: phone,
                    email: email,
                    address: address,
                    sapo: sapo,
                    submit: submit,
                },
                dataType: "json",
                success: function(data) {
                    if (data.result == false) {
                        $('#username').after("<label class='error'>" + data.mes + "</label>");
                    } else {
                        alert(data.mes);
                        window.location.href = './thong-tin';
                    }
                }
            });
        });
    });

    function validatePhone($phone) {
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