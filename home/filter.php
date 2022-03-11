<?php
session_start();
include './config.php';
require_once("../functions/pagination.php");

include '../include/get_filter.php';
$page  = getValue('page', 'int', 'GET', 1);
$page  = intval(@$page);
if ($page == 0) {
    $page = 1;
}
$curentPage = 2;
$pageab = abs($page - 1);
$start = $pageab * $curentPage;
$start = intval(@$start);
$start = abs($start);

$pagination = "LIMIT " . $start . "," . $curentPage;
$str = '';
foreach ($array_top_sale as $value) {
    $str .= $value['id_product'] . ',';
}
$str = rtrim($str, ',');
$sql = new db_query("SELECT id,name,alias,price_old,discount,quantity,image,code_product,contact,rate,total_rate FROM `tbl_product` WHERE `delete` = 0 AND `status` = 1 AND `id` in(" . $str . ") " . $where . " ORDER BY " . $order . " modify_time DESC " . $pagination);
$sql_discount = new db_query("SELECT id,name,alias,price_old,discount,quantity,image,code_product,contact,rate,total_rate FROM `tbl_product` WHERE `delete` = 0 AND `status` = 1 " . $where . " ORDER BY " . $order . " discount DESC " . $pagination);
$sql_view = new db_query("SELECT id,name,alias,price_old,discount,quantity,image,code_product,contact,rate,total_rate FROM `tbl_product` WHERE `delete` = 0 AND `status` = 1 " . $where . " ORDER BY " . $order . " view DESC " . $pagination);
$manu = explode(',', $manu);
$cate = explode(',', $cate);
$connect = explode(',', $connect);
$paper = explode(',', $paper);
$query_total = new db_query("SELECT id,name,alias,price_old,discount,quantity,image,code_product,contact,rate,total_rate FROM `tbl_product` WHERE `delete` = 0 AND `status` = 1 AND `id` in(" . $str . ") " . $where . "");
$total_records = mysql_num_rows($query_total->result);
$total_page = ceil($total_records / $curentPage);
if ($page > $total_page) {
    $page = $total_page;
}
$query_slide = new db_query("SELECT b.id,b.name,b.alias,b.price_old,b.discount,b.description,a.name as thuong_hieu FROM `tbl_product` b JOIN `tbl_manufacturer` a ON b.`manufacturer` = a.`id` WHERE b.`delete` = 0 AND b.`status` = 1 ORDER BY b.`modify_time` DESC LIMIT 1");
$data_silde = mysql_fetch_assoc($query_slide->result);
$meta_title = 'Danh sách máy in hóa đơn';
$meta_desc = 'Danh sách máy in hóa đơn';
$meta_key = 'Danh sách máy in hóa đơn';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- include meta -->
	<?php include '../include/meta.php'; ?>
    <!-- Preload css -->
    <link rel="preload" as="style" href="/css/bootstrap/bootstrap.min.css">
    <link rel="preload" as="style" href="/css/slick.css" />
    <link rel="preload" as="style" href="/css/home.css">
    <link rel="preload" as="style" href="/css/filter.css">
    <link rel="preload" as="style" href="/css/icon.css">
    <!--    Libs CSS-->
    <link rel="stylesheet" href="/css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="/css/jqueryui/jquery-ui.min.css">
    <!--    Theme CSS-->
    <link rel="stylesheet" href="/css/home.css">
    <link rel="stylesheet" href="/css/filter.css">
    <link rel="stylesheet" href="/css/icon.css">

</head>

<body>
    <div class="container-fluid main-container">
        <!--    header start-->
        <?php include '../include/header.php'; ?>
        <!--    header end-->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb pt-4">
                <li class="breadcrumb-item"><a class="breadcrumb-home" href="/">Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Máy in hóa đơn</li>
            </ol>
        </nav>
        <!--        body start-->
        <div class="body-page pd0">
            <div class="row mt-3 mt0">
                <div class="col-12">
                    <div class="banner">
                        <img class="img-fluid w-100" src="/images/banners/banner1.png" alt="banner" />
                    </div>
                </div>
            </div>
            <!--        filter-->
            <div class="row mt-5 mt-0-md filter_page">
                <div class="col-xl-3 col-lg-4 col-md-5 ft1">
                    <button id="filter1-btn" class="btn btn-outline-gray d-inline dropdown show filter1-btn-width" onclick="filter1dropdown()">
                        <i class="ic-filter1"></i>
                        Lọc sản phẩm <i id="ic-filter1-expand" class="ic-filter1-expand"></i>
                    </button>
                    <div id="filter1" class="dropdown-content show-view">
                        <button class="accordion"><i class="ic-printer"></i> Hãng sản xuất</button>
                        <div class="panel">
                            <div class="row">
                                <div class="col-12 manufacturer">
                                    <?php foreach ($array_hang_sx as $value) { ?>
                                        <div class="form-check text-uppercase ">
                                            <input class="form-check-input input_manu_2" type="checkbox" value="<?= $value['id'] ?>" <?= (in_array($value['id'], $manu)) ? 'checked' : '' ?>>
                                            <label class="form-check-label">
                                                <?= $value['name'] ?>
                                            </label>
                                        </div>
                                    <? } ?>
                                </div>
                            </div>
                        </div>
                        <button class="accordion"><i class="ic-category"></i> Loại máy in</button>
                        <div class="panel category">
                            <?php foreach ($array_loai_may as $value) { ?>
                                <div class="form-check">
                                    <input class="form-check-input input_cate_2" type="checkbox" value="<?= $value['id'] ?>" <?= (in_array($value['id'], $cate)) ? 'checked' : '' ?>>
                                    <label class="form-check-label">
                                        <?= $value['name'] ?>
                                    </label>
                                </div>
                            <?php } ?>
                        </div>
                        <button class="accordion"><i class="ic-database"></i> Cổng kết nối</button>
                        <div class="panel connect">
                            <?php foreach ($array_ket_noi as $value) { ?>
                                <div class="form-check">
                                    <input class="form-check-input input_connect_2" type="checkbox" value="<?= $value['id'] ?>" <?= (in_array($value['id'], $connect)) ? 'checked' : '' ?>>
                                    <label class="form-check-label">
                                        <?= $value['name'] ?>
                                    </label>
                                </div>
                            <?php } ?>
                        </div>
                        <button class="accordion"><i class="ic-file-alt"></i> Khổ giấy</button>
                        <div class="panel paper">
                            <?php foreach ($array_kho_giay as $value) { ?>
                                <div class="form-check">
                                    <input class="form-check-input input_paper_2" type="checkbox" value="<?= $value['id'] ?>" <?= (in_array($value['id'], $paper)) ? 'checked' : '' ?>>
                                    <label class="form-check-label">
                                        <?= $value['name'] ?>
                                    </label>
                                </div>
                            <?php } ?>
                        </div>
                        <button class="accordion">Khoảng giá</button>
                        <div class="panel">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control price_re price_first" placeholder="0" aria-label="0" value="<?= ($min) ? $min : 0 ?>">
                                <i class="ic-chevron px-3"></i>
                                <input type="text" id="range-price" class="form-control price_re price_second" value="<?= ($max) ? $max : '3.500.00' ?>">
                            </div>
                            <div id="range-slider1" class="range-slider"></div>
                        </div>
                        <div class="apply-button justify-content-center">
                            <button class="modal-footer-btn apply_button_filter active">Áp dụng</button>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-8 col-md-12 col-12">
                    <div class="row">
                        <!-- filter right-->
                        <div class="col-xl-6 col-lg-7 col-md-6 text-start ft2">
                            <button id="stock-filter-btn" class="btn btn-outline-gray ml-0 d-inline dropdown show" onclick="stockfilter()">Tình Trạng kho hàng <i class="ic-angle-down"></i></button>
                            <div id="stock-filter" class="dropdown-content ml-0 stock_filter">
                                <div class="form-check">
                                    <input class="form-check-input input_stock_2" type="checkbox" value="con_hang" id="instock" <?= (in_array('con_hang', $stock)) ? "checked" : ""; ?>>
                                    <label class="form-check-label" for="instock">
                                        Còn hàng
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input input_stock_2" type="checkbox" value="lien_he" id="contact" <?= (in_array('lien_he', $stock)) ? "checked" : ""; ?>>
                                    <label class="form-check-label" for="contact">
                                        Liên hệ
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-1 col-md-1"></div>
                        <div class="col-xl-3 col-lg-4 col-md-5 text-end ft2">
                            <button id="filter2-btn" class="btn btn-outline-gray d-inline dropdown show" onclick="filter2()">
                                Lọc sản phẩm <i class="ic-filter2"></i>
                            </button>
                            <div id="filter2" class="dropdown-content mgl-3 ml-9 filter_product">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input input-filter-2" id="filtercheck1" value="danh_gia" <?= (in_array('danh_gia', $product)) ? "checked" : ""; ?>>
                                    <label class="form-check-label" for="filtercheck1">Đánh giá</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input input-filter-2" id="filtercheck2" value="ten_a_z" <?= (in_array('ten_a_z', $product)) ? "checked" : ""; ?>>
                                    <label class="form-check-label" for="filtercheck2">Tên A-Z</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3 ft2">
                        <div class="col-md-12 list-filter">
                            <?php foreach ($array_filter as $value) { ?>
                                <button class="btn btn-outline-gray filter_2 <?= (isset($filter) && $filter == $value['value']) ? 'active' : '' ?>" value="<?= $value['value'] ?>"><?= $value['name'] ?></button>
                            <? } ?>
                        </div>
                    </div>
                    <div class="row mt-4 filter-tablet">
                        <button class="btn btn-outline-gray d-inline dropdown show filter-modal" data-toggle="modal" data-target="#filter-modal" id="btn-modal">
                            <i class="ic-filter1"></i>
                            Lọc sản phẩm <i id="ic-filter1-expand" class="ic-filter1-expand d-none"></i>
                        </button>
                    </div>
                    <!--        filter end-->
                    <!--        top product-->
                    <p class="text-uppercase mt-3 name-search">Máy in hóa đơn</p>
                    <p class="text-uppercase mt-3 top-cate">Top máy in hóa đơn bán chạy</p>
                    <div class="row mt-4">
                        <?php if (mysql_num_rows($sql->result)) {
                            while ($value = mysql_fetch_array($sql->result)) { ?>
                                <div class="item d-block col-xxl-4 col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="item-wrapper">
                                        <div class="row item-top">
                                            <div class="col-12">
                                                <?= ($value['discount'] != 0) ? '<div class="sale-tag"><span>-' . $value['discount'] . '%</span></div>' : '' ?>
                                                <a href="<?= rewrite_alias($value['id'], $value['alias']); ?>"><img class="img-fluid item-img" src="/images/item/<?= $value['image'] ?>" alt="<?= rewrite_title($value['name']) ?>"></a>
                                            </div>
                                        </div>
                                        <div class="row item-body">
                                            <div class="col-7 float-start">
                                                <div class="rating">
                                                    <?= star_rating($value['rate']); ?>
                                                    <span class="rating-num d-inline">( <?= $value['total_rate'] ?> )</span>
                                                </div>
                                            </div>
                                            <div class="col-5 float-end">
                                                <p class="item-code">MÃ: <?= $value['code_product'] ?></p>
                                            </div>
                                            <p class="mt-2 title-product"><a class="item-title text-decoration-none" href="<?= rewrite_alias($value['id'], $value['alias']) ?>"><?= rewrite_title($value['name']) ?></a></p>
                                            <div class="col-12 item-price">
                                                <p class="price">
                                                    <span class="price-new"><?= price_new($value['price_old'], $value['discount']) ?> đ</span>
                                                    <?= ($value['discount'] != 0) ? '<span class="price-old">' . $value['price_old'] . ' đ</span>' : '' ?>
                                                </p>

                                            </div>
                                            <div class="col-6 item-status float-start d-inline">
                                                <?= check_status($value['quantity'], $value['contact']) ?>
                                            </div>
                                            <div class="col-6 add-to-cart float-end d-inline">
                                                <button <?= disable_button($value['quantity'], $value['contact']) ?> class="button-add-cart" value="<?= $value['id'] ?>"><i class="ic-cart"></i></button>
                                            </div>

                                        </div>
                                        <div class="row item-footer">
                                            <div class="col-2  float-start">
                                                <i class="ic-presents"></i>
                                            </div>
                                            <div class="col-10  float-end bonus-gift">
                                                <p>Tặng: <span class="text-danger text-decoration-none">Phần mềm Quản lý bán hàng</span>
                                                    khi mua sản phẩm tại website</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="d-flex justify-content-center mt-4 txt-center">
                                <?= pagination($page, $total_page); ?>
                            </div>
                        <? } else { ?>
                            <div class="no-found">
                                <img src="../images/no-products-found.png" alt="Không có kết quả">
                                <p>Không tìm thấy sản phẩm nào phù hợp</p>
                            </div>
                        <?php } ?>
                    </div>
                    <!--        top product end-->
                    <!--        load more button-->

                </div>
            </div>
            <!--        load more button-->
            <!--        slider-->
            <div class="row mt-4 mb-5">
                <div class="col-12">
                    <p class="text-uppercase top-cate">Gợi ý cho bạn</p>
                    <div class="mt-4 banner-recom">
                        <div class="item">
                            <img class="banner-bg lazyload" src="/images/slider/slider1.png" alt="may in 2">
                            <div class="slide-text d-inline">
                                <p class="text-orange fw-bold slide-text-intro">Quà tặng ưu đãi khi mua máy in</p>
                                <p class="text-blue fw-bold slide-text-title">Phần mềm quản lý</p>
                                <span class="slide-text-sapo">Giúp chủ kinh doanh tự động tính tiền và trả tiền thừa cho khách, thanh toán đa
                                    hình thức bằng mã QR, quẹt thẻ, chuyển khoản,... giúp hạn chế sai sót và đảm bảo
                                    an toàn trong mùa dịch</span>
                                <a class="text-decoration-none text-uppercase text-grey d-flex seemore" href="#">
                                    <i class="ic-cricle-right"></i>
                                    <span class="fw-bold">Xem thêm</span>
                                </a>
                            </div>
                            <div class="slide-image">
                                <img class="img-fluid lazyload" src="/images/loading.gif" data-src="/images/slider/mayin1.png" alt="may in 1">
                            </div>
                        </div>
                        <div class="item">
                            <img class="banner-bg lazyload" src="/images/slider/slider2.png" alt="may in 1">
                            <div class="slide-text">
                                <p class="text-white fw-bold slide-text-recom">Máy in <?= $data_silde['thuong_hieu'] ?></p>
                                <p class="text-orange slide-text-price"><?= price_new_2($data_silde['price_old'], $data_silde['discount']) ?> VND</p>
                                <p class="text-white fw-bold slide-text-item"><?= $data_silde['name'] ?></p>
                                <span class="text-white slide-text-sapo"><?= $data_silde['description'] ?></span>
                                <a class="text-decoration-none text-uppercase text-grey d-flex seemore" href="<?= rewrite_alias($data_silde['id'], $data_silde['alias']) ?>">
                                    <i class="ic-cricle-right-white"></i>
                                    <span class="text-white fw-bold">Xem sản phẩm</span>
                                </a>
                            </div>
                            <div class="slide-image">
                                <img class="img-fluid lazyload" src="/images/loading.gif" data-src="/images/slider/mayin2.png" alt="may in 2">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--        slider end-->
            <!--        best selloff-->
            <p class="text-uppercase mt-5 d-inline top-cate">Máy in hóa đơn giảm giá nhiều nhất</p>
            <a href="#" class="d-inline text-decoration-none text-grey float-end view-all"><span>Xem tất cả</span><i class="ic-angle-right"></i></a>
            <div class="row mt-4 mb-5">
                <?php if (mysql_num_rows($sql_discount->result)) {
                    while ($value = mysql_fetch_array($sql_discount->result)) { ?>
                        <div class="item d-block col-xxl-3 col-xl-3 col-lg-4 col-md-6 col-sm-12 col12">
                            <div class="item-wrapper">
                                <div class="row item-top">
                                    <div class="col-12">
                                        <?= ($value['discount'] != 0) ? '<div class="sale-tag"><span>-' . $value['discount'] . '%</span></div>' : '' ?>
                                        <a href="<?= rewrite_alias($value['id'], $value['alias']); ?>"><img class="img-fluid item-img" src="/images/item/<?= $value['image'] ?>" alt="<?= rewrite_title($value['name']) ?>"></a>
                                    </div>
                                </div>
                                <div class="row item-body">
                                    <div class="col-7 float-start">
                                        <div class="rating">
                                            <?= star_rating($value['rate']); ?>
                                            <span class="rating-num d-inline">( <?= $value['total_rate'] ?> )</span>
                                        </div>
                                    </div>
                                    <div class="col-5 float-end">
                                        <p class="item-code">MÃ: <?= $value['code_product'] ?></p>
                                    </div>
                                    <p class="mt-2 title-product"><a class="item-title text-decoration-none" href="<?= rewrite_alias($value['id'], $value['alias']) ?>"><?= rewrite_title($value['name']) ?></a></p>
                                    <div class="col-12 item-price">
                                        <p class="price">
                                            <span class="price-new"><?= price_new($value['price_old'], $value['discount']) ?>đ</span>
                                            <span class="price-old"><?= $value['price_old'] ?>đ</span>
                                        </p>

                                    </div>
                                    <div class="col-6 item-status float-start d-inline">
                                        <?= check_status($value['quantity'], $value['contact']) ?>
                                    </div>
                                    <div class="col-6 add-to-cart float-end d-inline">
                                        <button <?= disable_button($value['quantity'], $value['contact']) ?> class="button-add-cart" value="<?= $value['id'] ?>"><i class="ic-cart"></i></button>
                                    </div>

                                </div>
                                <div class="row item-footer">
                                    <div class="col-2  float-start">
                                        <i class="ic-presents"></i>
                                    </div>
                                    <div class="col-10  float-end bonus-gift">
                                        <p>Tặng: <span class="text-danger text-decoration-none">Phần mềm Quản lý bán hàng</span>
                                            khi mua sản phẩm tại website</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php }
                } else { ?>
                    <div class="no-found">
                        <img src="../images/no-products-found.png" alt="Không có kết quả">
                        <p>Không tìm thấy sản phẩm nào phù hợp</p>
                    </div>
                <?php } ?>
            </div>
            <!--        end best selloff-->
            <!--        best selloff-->
            <p class="text-uppercase mt-5 d-inline top-cate">Máy in hóa đơn được xem nhiều</p>
            <a href="#" class="d-inline text-decoration-none text-grey float-end view-all"><span>Xem tất cả</span><i class="ic-angle-right"></i></a>
            <div class="row mt-4 mb-5">
                <?php if (mysql_num_rows($sql_view->result)) {
                    while ($value = mysql_fetch_array($sql_view->result)) { ?>
                        <div class="item d-block col-xxl-3 col-xl-3 col-lg-4 col-md-6 col-sm-12 col12">
                            <div class="item-wrapper">
                                <div class="row item-top">
                                    <div class="col-12">
                                        <?= ($value['discount'] != 0) ? '<div class="sale-tag"><span>-' . $value['discount'] . '%</span></div>' : '' ?>
                                        <a href="<?= rewrite_alias($value['id'], $value['alias']); ?>"><img class="img-fluid item-img" src="/images/item/<?= $value['image'] ?>" alt="<?= rewrite_title($value['name']) ?>"></a>
                                    </div>
                                </div>
                                <div class="row item-body">
                                    <div class="col-7 float-start">
                                        <div class="rating">
                                            <?= star_rating($value['rate']); ?>
                                            <span class="rating-num d-inline">( <?= $value['total_rate'] ?> )</span>
                                        </div>
                                    </div>
                                    <div class="col-5 float-end">
                                        <p class="item-code">MÃ: <?= $value['code_product'] ?></p>
                                    </div>
                                    <p class="mt-2 title-product"><a class="item-title text-decoration-none" href="<?= rewrite_alias($value['id'], $value['alias']) ?>"><?= rewrite_title($value['name']) ?></a></p>
                                    <div class="col-12 item-price">
                                        <p class="price">
                                            <span class="price-new"><?= price_new($value['price_old'], $value['discount']) ?>đ</span>
                                            <span class="price-old"><?= $value['price_old'] ?>đ</span>
                                        </p>

                                    </div>
                                    <div class="col-6 item-status float-start d-inline">
                                        <?= check_status($value['quantity'], $value['contact']) ?>
                                    </div>
                                    <div class="col-6 add-to-cart float-end d-inline">
                                        <button <?= disable_button($value['quantity'], $value['contact']) ?> class="button-add-cart" value="<?= $value['id'] ?>"><i class="ic-cart"></i></button>
                                    </div>

                                </div>
                                <div class="row item-footer">
                                    <div class="col-2  float-start">
                                        <i class="ic-presents"></i>
                                    </div>
                                    <div class="col-10  float-end bonus-gift">
                                        <p>Tặng: <span class="text-danger text-decoration-none">Phần mềm Quản lý bán hàng</span>
                                            khi mua sản phẩm tại website</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php }
                } else { ?>
                    <div class="no-found">
                        <img class=" lazyload" src="/images/loading.gif" data- src="../images/no-products-found.png" alt="Không có kết quả">
                        <p>Không tìm thấy sản phẩm nào phù hợp</p>
                    </div>
                <?php } ?>
            </div>
            <!--        end best selloff-->
            <!--     brands-->
            <?php include '../include/brand.php'; ?>
        </div>
        <!--        body end-->
    </div>
    <!--footer-->
    <?php include '../include/footer.php';
    include '../include/modal_filter_2.php'; ?>
    <!-- End footer -->


    <!-- Include Libs & Plugins
============================================ -->
    <script type="text/javascript" src="/js/jquery/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="/js/jquery/jquery-ui.min.js"></script>
    <script type="text/javascript" src="/js/bootstrap/bootstrap.min.js"></script>

    <script type="text/javascript" src="/js/home.js"></script>
    <script type="text/javascript" src="/js/search_advance.js"></script>
    <script type="text/javascript" src="/js/filter.js"></script>
    <script type="text/javascript" src="/js/Range-slider.js"></script>
    <script type="text/javascript" src="/js/lazysizes.min.js"></script>
</body>

</html>