<?php
include '../security/config.php';
$id_modules = 1;
$role = check_role($id_modules);

$action = getValue('action','str','GET','');
$id = getValue('id','int','GET',0);
$id = (int)$id;
$submit = getValue('submit','str','POST','');
if($action == ''){
    $sql = new db_query("SELECT id,name,image,alias,code_product,quantity,price_old,discount,status FROM `tbl_product` WHERE `delete` = 0 ORDER BY modify_time DESC");
}
role($role,$action);
if($action == 'delete' AND $id != 0){
    $sql = new db_query("UPDATE `tbl_product` SET `delete` = '1' WHERE `tbl_product`.`id` = ".$id);
    echo '
    <script language="javascript">
    window.alert("Xóa thành công");
   	window.parent.location.href="./san-pham";
   </script>';
}
if($action == 'edit' AND $id != 0){
    $sql = new db_query("SELECT * FROM `tbl_product` WHERE 1 AND id = ".$id);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Sản phẩm</title>
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
               if ($action=='add') {
                   include 'add.php';
               }elseif($action == 'edit'){
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
    <script src="js/select2.min.js"></script>

    <script>
        $('#price_old').keyup(function(){
            var price_old = $(this).val();
            var discount = $('#discount').val();
            if(discount == 0){
                $('#price_new').val(price_old);
            }else{
                price_old = price_old.replace(/\D/g, "");
                var price_new = price_old * ((100 - discount)/100);
                price_new = replaceMoney(price_new);
                $('#price_new').val(price_new);
            }
            
        });
        $('#discount').keyup(function(){
            var price_old = $('#price_old').val();
            price_old = price_old.slice(0,-4);
            var discount = $(this).val();
            var price_new = price_old * ((100 - discount)/100);
            price_new = price_new.toFixed(3)
            price_new += '.000';
            $('#price_new').val(price_new);
        });
        $('.select').select2();

        // replace money
        var price_res = document.querySelectorAll("#price_old");
        for(price_re of price_res){
            price_re.onkeyup = formatCurrency;
        }

        function formatCurrency(event){
            var input_var = event.target.value;
            if (input_var !=="") {
                event.target.value = input_var.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }
        }
        function replaceMoney(value){
            return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }
    </script>

</body>

</html>