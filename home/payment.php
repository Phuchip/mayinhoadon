<?php
session_start();
include './config.php';
$meta_title = 'Thanh toán';
$meta_desc = 'Thanh toán';
$meta_key = 'Thanh toán';
?>
<!DOCTYPE html>
<html>

<head>
    <!-- include meta -->
	<?php include '../include/meta.php'; ?>
    <!-- Preload css -->
    <link rel="preload" as="style" href="/css/bootstrap/bootstrap.min.css">
    <link rel="preload" as="style" href="/css/jqueryui/jquery-ui.min.css">
    <link rel="preload" as="style" href="/css/slick.css" />
    <link rel="preload" as="style" href="/css/home.css">
    <link rel="preload" as="style" href="/css/cart.css">
    <link rel="preload" as="style" href="/css/icon.css">
    <!--    Libs CSS-->
    <link rel="stylesheet" href="/css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="/css/jqueryui/jquery-ui.min.css">
    <link rel="stylesheet" href="/css/slick.css" />
    <!--    Theme CSS-->
    <link rel="stylesheet" href="/css/home.css">
    <link rel="stylesheet" href="/css/cart.css">
    <link rel="stylesheet" href="/css/icon.css">
</head>

<body>
    <div class="container-fluid main-container">
        <!--    header start-->
        <?php include '../include/header.php'; ?>
        <!--        breadcrumb-->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb pt-4">
                <li class="breadcrumb-item"><a class="breadcrumb-home" href="/">Trang chủ</a></li>
                <li class="breadcrumb-item" aria-current="page">Máy in hóa đơn</li>
                <li class="breadcrumb-item active" aria-current="page">Đơn hàng</li>
            </ol>
        </nav>
        <!--    header end-->
        <!--        body start-->
        <div class="body-page pd0">
            <div class="cart">
                <div class="cart-left">
                    <div class="cart-left-top">
                        <ul>
                            <li class="active">1. Chọn sản phẩm</li>
                            <li class="active">2. Xác nhận đơn hàng</li>
                            <li class="active">3. Thanh toán</li>
                        </ul>
                    </div>
                    <form method="POST" onsubmit="return false" id="validate_form" novalidate="novalidate">
                        <div class="cart-left-body">
                            <div class="clb-top">
                                <div class="clb-top-left">
                                    <p>Thông tin khách hàng</p>
                                </div>
                            </div>
                            <div class="clb-body">
                                <div class="clb-body-form">
                                    <p class="ff-title"><i class="compulsory"></i>Trường bắt buộc</p>
                                    <div class="form-first">
                                        <label>Họ tên quý khách <i class="compulsory"></i></label>
                                        <div class="form-check-info">
                                            <input type="text" name="name" id="name" required placeholder="Nhập tên khách hàng">
                                        </div>
                                    </div>
                                    
                                    <div class="form-first">
                                        <label>Địa chỉ email <i class="compulsory"></i></label>
                                        <div class="form-check-info">
                                        <input type="text" name="email" id="email" required placeholder="Nhập email"></div>
                                    </div>
                                    <div class="form-first">
                                        <label>Số điện thoại <i class="compulsory"></i></label>
                                        <div class="form-check-info">
                                        <input type="text" name="phone" id="phone" required placeholder="Nhập số điện thoại">
                                        </div>
                                    </div>
                                    <div class="form-first">
                                        <label>Địa chỉ thường trú <i class="compulsory"></i></label>
                                        <div class="form-check-info">
                                        <input type="text" name="address" id="address" required placeholder="Nhập địa chỉ"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="cart-left-second">
                            <div class="clb-top">
                                <div class="clb-top-left">
                                    <p>Thông tin giao hàng</p>
                                </div>
                            </div>
                            <div class="clb-checkbox">
                                <input id="check_box" type="checkbox" name="check_box"><label>Sử dụng thông tin khách hàng để giao hàng</label>
                            </div>
                            <div class="clb-body">
                                <div class="form_second">
                                    <p class="ff-title"><i class="compulsory"></i>Trường bắt buộc</p>
                                    <div class="form-second">
                                        <label>Họ tên người nhận <i class="compulsory"></i></label>
                                        <div class="form-check-info">
                                        <input type="text" name="ship_name" id="ship_name" placeholder="Nhập tên khách hàng"></div>
                                    </div>
                                    <div class="form-second">
                                        <label>Số điện thoại <i class="compulsory"></i></label>
                                        <div class="form-check-info">
                                        <input type="text" name="ship_phone" id="ship_phone" placeholder="Nhập số điện thoại"></div>
                                    </div>
                                    <div class="form-second">
                                        <label>Địa chỉ giao nhận <i class="compulsory"></i></label>
                                        <div class="form-check-info">
                                        <input type="text" name="ship_address" id="ship_address" placeholder="Nhập địa chỉ giao hàng"></div>
                                    </div>
                                    <div class="dp-flex">
                                        <label>Ghi chú</label>
                                        <div class="form-check-info">
                                        <textarea id="ship_note" name="ship_note" cols="30" rows="4" placeholder="Nhập ghi chú"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="btn-submit">
                                <button class="btn-submit-form <?= (isset($num) && $num > 0)?'active':'' ?>" value="order"> Đặt ngay</button>
                            </div>
                        </div>
                    </form>
                    <div class="info-payment dn-1024">
                        <div class="info-payment-first">
                            <p class="ipf-title">Thông tin liên hệ</p>
                            <div class="ipf-content">
                                <p>Hotline : <span>0971.335.869 | 024 36.36.66.99 </span></p>
                                <p>Email hỗ trợ: <span>Timviec365com@gmail.com</span></p>
                                <p>Địa chỉ: <span>Số 206 Định Công Hạ , Phường Định Công, Quận Hoàng Mai, Thành phố Hà Nội, Việt Nam</span></p>
                            </div>
                        </div>
                        <div class="info-payment-last">
                            <p class="ipl-title">Cách thức thanh toán</p>
                            <p class="ipl-content"><i class="ic-dot-black"></i>Thanh toán bằng chuyển khoản</p>
                            <table>
                                <tr>
                                    <td>
                                        <div class="payment-bank">
                                            <img class=" lazyload" src="/images/loading.gif" data-src="../images/brands/vietcombank.png" alt="Viecombank">
                                        </div>
                                        <div class="payment-content">
                                            <p>Ngân hàng Viecombank</p>
                                            <p>Chủ tài khoản: <span>TRƯƠNG VĂN TRẮC</span></p>
                                            <p>Số tài khoản: <span>1023780714</span> </p>
                                            <p>Chi tiết: <span>PGD Định Công - Chi nhánh Hoàn Kiếm</span></p>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="payment-bank">
                                            <img class=" lazyload" src="/images/loading.gif" data-src="../images/brands/mbbank.png" alt="Mb Bank">
                                        </div>
                                        <div class="payment-content">
                                            <p>Ngân hàng MBbank</p>
                                            <p>Chủ tài khoản: <span>TRƯƠNG VĂN TRẮC</span></p>
                                            <p>Số tài khoản: <span>0680114396002</span> </p>
                                            <p>Chi tiết: <span>Hà Nội</span></p>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="payment-bank">
                                            <img class=" lazyload" src="/images/loading.gif" data-src="../images/brands/vietinbank.png" alt="Vietinbank">
                                        </div>
                                        <div class="payment-content">
                                            <p>Ngân hàng Vietinbank</p>
                                            <p>Chủ tài khoản: <span>TRƯƠNG VĂN TRẮC</span></p>
                                            <p>Số tài khoản: <span>100874190609</span> </p>
                                            <p>Chi tiết: <span>Thanh Xuân - Hà Nội</span></p>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="payment-bank">
                                            <img class=" lazyload" src="/images/loading.gif" data-src="../images/brands/bidv.png" alt="BIDV">
                                        </div>
                                        <div class="payment-content">
                                            <p>Ngân hàng BIDV</p>
                                            <p>Chủ tài khoản: <span>TRƯƠNG VĂN TRẮC</span></p>
                                            <p>Số tài khoản: <span>21610000775434</span> </p>
                                            <p>Chi tiết: <span>Hoàng Mai, Hà Nội</span></p>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="cart-right payment-right">
                    <div class="info-cart">
                        <p class="info-cart-title">Thông tin giỏ hàng</p>
                        <div class="modal-num-item">
                            <span>Số lượng sản phẩm</span><span class="total_item"><?= $num ?></span>
                        </div>
                        <div class="modal-total">
                            <span>Tổng chi phí</span><span class="total_price"><?= $total ?> đ<span>
                        </div>
                        <div class="modal-cart-vat"><span>(Đã bao gồm cả VAT nếu có)</span></div>
                    </div>
                    <div class="list-item-payment">
                        <?php if (isset($_SESSION['cart'])) {
                            foreach ($_SESSION['cart'] as $key => $value) { ?>
                            <?php $qr_item = new db_query("SELECT * FROM `tbl_product` WHERE `id` =" . $value['id']);
									$data = mysql_fetch_assoc($qr_item->result);
									?>
                                <div class="item-payment cart_item<?= $value['id'] ?>">
                                    <p class="item-payment-title"><?= rewrite_title($data['name']) ?></p>
                                    <div class="ci-dropdown">
                                        <button class="btn-dropdown"><i class="ic-angle-right-blue"></i>Chi tiết sản phẩm</button>
                                        <div class="btn-dropdown-content hidden">
                                            <div class="lip-para-div">
                                                <p class="lip-para-title">Hãng sản xuất</p>
                                                <p><?= $data['thuong_hieu'] ?></p>
                                            </div>

                                            <div class="lip-para-div">
                                                <p class="lip-para-title">Mã sản phẩm</p>
                                                <p><?= $data['model'] ?></p>
                                            </div>
                                            <div class="lip-para-div">
                                                <p class="lip-para-title">Tốc độ</p>
                                                <p><?= $data['toc_do_in'] ?></p>
                                            </div>
                                            <div class="lip-para-div">
                                                <p class="lip-para-title">Kích cỡ</p>
                                                <p><?= $data['kich_co'] ?></p>
                                            </div>
                                            <div class="lip-para-div">
                                                <p class="lip-para-title">Trọng lượng</p>
                                                <p><?= $data['trong_luong'] ?></p>
                                            </div>
                                            <div class="lip-para-div">
                                                <p class="lip-para-title">Kết nối</p>
                                                <p><?= $data['ket_noi'] ?></p>
                                            </div>
                                            <div class="lip-para-div">
                                                <p class="lip-para-title">Xuất xứ</p>
                                                <p><?= $data['xuat_xu'] ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ci-dropdown">
                                        <button class="btn-dropdown"><i class="ic-angle-right-blue"></i>Quà Tặng & Khuyến mãi</button>
                                        <div class="btn-dropdown-content hidden">
                                            <p class="gift-title">Tặng phần mềm quản lý bán hàng <span>(bảo hành trọn đời)</span></p>
                                        </div>
                                    </div>
                                    <div class="item-payment-price">
                                        <p><?= $value['price'] ?> đ</p>
                                    </div>
                                </div>
                        <?php }
                        } ?>
                    </div>
                    <div class="payment-btn-contact">
                        <button>Liên hệ ngay</button>
                    </div>
                    <div class="info-payment db-1024">
                        <div class="info-payment-first">
                            <p class="ipf-title dn-475">Thông tin liên hệ</p>
                            <p class="ipf-title db-375">Thông tin nhà sản xuất</p>
                            <div class="ipf-content">
                                <p>Hotline : <span>0971.335.869 | 024 36.36.66.99 </span></p>
                                <p>Email hỗ trợ: <span>Timviec365com@gmail.com</span></p>
                                <p>Địa chỉ: <span>Số 206 Định Công Hạ , Phường Định Công, Quận Hoàng Mai, Thành phố Hà Nội, Việt Nam</span></p>
                            </div>
                        </div>
                        <div class="info-payment-last">
                            <p class="ipl-title">Cách thức thanh toán</p>
                            <p class="ipl-content"><i class="ic-dot-black"></i>Thanh toán bằng chuyển khoản</p>
                            <table>
                                <tr>
                                    <td>
                                        <div class="payment-bank">
                                            <img class=" lazyload" src="/images/loading.gif" data-src="../images/brands/vietcombank.png" alt="Viecombank">
                                        </div>
                                        <div class="payment-content">
                                            <p>Ngân hàng Viecombank</p>
                                            <p>Chủ tài khoản: <span>TRƯƠNG VĂN TRẮC</span></p>
                                            <p>Số tài khoản: <span>1023780714</span> </p>
                                            <p>Chi tiết: <span>PGD Định Công - Chi nhánh Hoàn Kiếm</span></p>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="payment-bank">
                                            <img class=" lazyload" src="/images/loading.gif" data-src="../images/brands/mbbank.png" alt="Mb Bank">
                                        </div>
                                        <div class="payment-content">
                                            <p>Ngân hàng MBbank</p>
                                            <p>Chủ tài khoản: <span>TRƯƠNG VĂN TRẮC</span></p>
                                            <p>Số tài khoản: <span>0680114396002</span> </p>
                                            <p>Chi tiết: <span>Hà Nội</span></p>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="payment-bank">
                                            <img class=" lazyload" src="/images/loading.gif" data-src="../images/brands/vietinbank.png" alt="Vietinbank">
                                        </div>
                                        <div class="payment-content">
                                            <p>Ngân hàng Vietinbank</p>
                                            <p>Chủ tài khoản: <span>TRƯƠNG VĂN TRẮC</span></p>
                                            <p>Số tài khoản: <span>100874190609</span> </p>
                                            <p>Chi tiết: <span>Thanh Xuân - Hà Nội</span></p>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="payment-bank">
                                            <img class=" lazyload" src="/images/loading.gif" data-src="../images/brands/bidv.png" alt="BIDV">
                                        </div>
                                        <div class="payment-content">
                                            <p>Ngân hàng BIDV</p>
                                            <p>Chủ tài khoản: <span>TRƯƠNG VĂN TRẮC</span></p>
                                            <p>Số tài khoản: <span>21610000775434</span> </p>
                                            <p>Chi tiết: <span>Hoàng Mai, Hà Nội</span></p>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--        body end-->
    </div>
    <!--footer-->
    <?php
    include '../include/footer.php';

    ?>
    <!-- End footer -->


    <!-- Include Libs & Plugins
============================================ -->
    <script type="text/javascript" src="/js/jquery/jquery-3.6.0.min.js"></script>
    <script src="/js/jquery/jquery-ui.min.js"></script>
    <script type="text/javascript" src="/js/bootstrap/bootstrap.min.js"></script>
    <script type="text/javascript" src="/js/slick.min.js"></script>
    <script type="text/javascript" src="/js/home.js"></script>
    <script type="text/javascript" src="/js/search_advance.js"></script>
    <script type="text/javascript" src="/js/cart.js"></script>
    <script type="text/javascript" src="/js/payment.js"></script>
    <script type="text/javascript" src="/js/lazysizes.min.js"></script>
</body>

</html>