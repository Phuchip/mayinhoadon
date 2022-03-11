<?php
include '../security/config.php';
$id_modules = 6;
$role = check_role($id_modules);
$action = getValue('action','str','GET','');
$id = getValue('id','int','GET',0);
$id = (int)$id;
$submit = getValue('submit','str','POST','');
if($action == ''){
    $sql = new db_query("SELECT * FROM `tbl_tags`");
}
role($role,$action,$id);
if($action == 'delete' AND $id != 0){
    $sql = new db_query("DELETE FROM `tbl_tags` WHERE `id` = ".$id);
    echo '
    <script language="javascript">
    window.alert("Xóa thành công");
   	window.parent.location.href="tag";
   </script>';
}
if($action == 'add' AND $id != 0){
    $sql = new db_query("SELECT * FROM `tbl_tags` WHERE 1 AND id = ".$id);
}
if($action == 'add' AND $submit != ''){
    $id_db = getValue('id','int','POST',0);
    $ten_hang = getValue('ten_hang','str','POST','');
    $alias = replaceTitle($ten_hang);
    $status = getValue('status','int','POST',1);
    $status = (int)$status;
    $id_db = (int)$id_db;
    if($submit == 'add'){
        $created_time = time();
    }
    $data = array(
        'name'  => $ten_hang,
        'alias' => $alias,
        'status'=> $status,
    );
    $condition = array('id' => $id_db );
    if($submit == 'add'){
        add('tbl_tags',$data);
        echo '
        <script language="javascript">
            window.alert("Thêm thành công");
        </script>';
    }elseif($submit == 'update'){
        update('tbl_tags',$data,$condition);
        echo '
        <script language="javascript">
            window.alert("Sửa thành công");
        </script>';
    }
    
    echo '
    <script language="javascript">
   	window.parent.location.href="tag";
   </script>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Tag</title>
    <meta name="robots" content="noindex,nofollow" />
    <meta name="twitter:card" content="summary_large_image" />
    <link rel="shortcut icon" href="../images/favicon.png" type="image/x-icon" />
    <!-- Custom fonts for this template-->
    <link href="./vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template-->
    <link href="./css/sb-admin-2.min.css" rel="stylesheet">
    <link href="./css/admin.css" rel="stylesheet">
    <link href="./fonts/font.css" rel="stylesheet">
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

</body>

</html>