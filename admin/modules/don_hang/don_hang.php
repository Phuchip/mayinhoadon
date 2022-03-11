<?php
include '../security/config.php';
$id_modules = 6;
$role = check_role($id_modules);
$action = getValue('action', 'str', 'GET', '');
$id = getValue('id', 'int', 'GET', 0);
$id = (int)$id;
$submit = getValue('submit', 'str', 'POST', '');
if ($action == '') {
    $sql = new db_query("SELECT id,name,phone,address,quantity,total,status FROM `tbl_order` WHERE `delete` = 0 ORDER BY modify_time DESC");
}
role($role, $action);
if($action == 'view'){
    $sql = new db_query("SELECT * FROM `tbl_order` WHERE `id` =".$id);
    $query = new db_query("SELECT a.id,a.name,a.alias,b.quantity,b.price FROM tbl_product a JOIN tbl_detail_order b ON a.id = b.id_product WHERE id_order = ".$id);
}
if($action == 'delete' AND $id != 0){
    $sql = new db_query("UPDATE `tbl_order` SET `delete` = '1' WHERE `id` = ".$id);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Đơn hàng</title>
    <meta name="twitter:card" content="summary_large_image" />
    <link rel="shortcut icon" href="../images/favicon.png" type="image/x-icon" />
    <!-- Custom fonts for this template-->
    <link href="./vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template-->
    <link href="./css/sb-admin-2.min.css" rel="stylesheet">
    <link href="./css/admin.css" rel="stylesheet">
    <link href="./fonts/font.css" rel="stylesheet">
    <link href="./css/select2.min.css" rel="stylesheet" />

    <script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
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
        if ($action == 'view') {
            include 'view.php';
        }
    } else {
        if ($role['view'] == 0) {
            include '../../include/404.php';
        } else {
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
<script src="js/select2.min.js"></script>
<script>
    $('.status_order').change(function(){
        var status = $(this).val();
        var id = $(this).attr('data-id');
        $.ajax({
            type: "POST",
            url: "./ajax/status_order.php",
            data: {
                status: status,
                id: id,
            },
            dataType: "json",
            success: function(data) {
                if(data.result == false){
                    alert(data.mes);
                }
            }
        });
    });
</script>
</body>

</html>