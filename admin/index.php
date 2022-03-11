<?php 
    session_start();
    error_reporting(E_ALL);
    //require_once("aut.php");
    require_once("../functions/translate.php");
    require_once("../functions/functions.php");
    require_once("../classes/config.php");
    require_once("../classes/database.php");
    require_once("modules/security/functions.php");
    checklogged("login.php");
    $url = $_SERVER['REQUEST_URI'];
    $sub_url = explode('/',$url);
    $active = $sub_url[2];
    $query_order = new db_query("SELECT quantity,total FROM `tbl_order`");
    $count_order = mysql_num_rows($query_order->result);
    $total_order = 0;
    $count_product = 0;
    if($count_order > 0){
        while ($value = mysql_fetch_array($query_order->result)) {
            $total = (float)$value['total'];
            $total_order += $total;
            $count_product += $value['quantity'];
        }
        $total_order = $total_order.'.000 đ';
    }
    $query_comment = new db_query("SELECT count(*) as count FROM `tbl_comments`");
    
    $count_comment = mysql_fetch_assoc($query_comment->result);
    $count_comment = $count_comment['count'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Quản lý máy in</title>
    <meta name="twitter:card" content="summary_large_image" />
    <link rel="shortcut icon" href="../images/favicon.png" type="image/x-icon" />
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="css/admin.css" rel="stylesheet">
    <link href="fonts/font.css" rel="stylesheet">
</head>

<?php include 'include/inc_head.php' ?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Bảng điều khiển</h1>
        </div>

        <!-- Content Row -->
        <div class="row">
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Doanh thu</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_order ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Số đơn hàng 
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $count_order ?></div>
                            </div>
                            <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Số sản phẩm(đã bán)</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $count_product ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Bình luận</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $count_comment ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-comments fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
<?php include 'include/inc_footer.php' ?>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    <script src="js/admin.js"></script>

</body>

</html>