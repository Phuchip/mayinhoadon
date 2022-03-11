<?php
session_start();
include './config.php';
$str = '';
foreach ($array_top_sale as $value) {
    $str .= $value['id_product'] . ',';
}
$str = rtrim($str, ',');
$sql_top = new db_query("SELECT id,name,alias,price_old,discount,quantity,image,code_product,contact,rate,total_rate,total_rate FROM `tbl_product` WHERE `delete` = 0 AND `status` = 1 AND `id` in(" . $str . ") ORDER BY modify_time DESC");
$sql_discount = new db_query("SELECT id,name,alias,price_old,discount,quantity,image,code_product,contact,rate,total_rate FROM `tbl_product` WHERE `delete` = 0 AND `status` = 1 ORDER BY `discount` DESC limit 12");
$sql_view = new db_query("SELECT id,name,alias,price_old,discount,quantity,image,code_product,contact,rate,total_rate FROM `tbl_product` WHERE `delete` = 0 AND `status` = 1 ORDER BY `view` DESC limit 12");
$query_slide = new db_query("SELECT b.id,b.name,b.alias,b.price_old,b.discount,b.description,a.name as thuong_hieu FROM `tbl_product` b JOIN `tbl_manufacturer` a ON b.`manufacturer` = a.`id` WHERE b.`delete` = 0 AND b.`status` = 1 ORDER BY b.`modify_time` DESC LIMIT 1");
$data_silde = mysql_fetch_assoc($query_slide->result);

$meta_title = 'Quản lý máy in';
$meta_desc = 'Quản lý máy in';
$meta_key = 'Quản lý máy in';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- include meta -->
    <?php include '../include/meta.php'; ?>
    <!-- Preload css -->
    <link rel="preload" as="style" href="/css/bootstrap/bootstrap.min.css">
    <link rel="preload" as="style" href="/css/jqueryui/jquery-ui.min.css">
    <link rel="preload" as="style" href="/css/home.css">
    <link rel="preload" as="style" href="/css/icon.css">
    <!--    Libs CSS-->
    <link rel="stylesheet" href="/css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="/css/jqueryui/jquery-ui.min.css">
    <!--    Theme CSS-->
    <link rel="stylesheet" href="/css/home.css">
    <link rel="stylesheet" href="css/icon.css">

</head>

<body>
    <div class="container-fluid main-container">
        <!--    header start-->
        <?php include '../include/header.php'; ?>
        <!--    header end-->
        <!--        body start-->
        <div class="body-page pd0">
            <div class="row mt-3 mt0">
                <div class="col-12">
                    <div class="banner">
                        <img class="img-fluid w-100 lazyload" src="/images/loading.gif" data-src="/images/banners/banner1.png" alt="banner" />
                    </div>
                </div>
            </div>
            <!--        filter-->
            <?php include '../include/filter.php'; ?>
            <!--        filter end-->
            <!--        top product-->
            <p class="text-uppercase mt-3 name-search">Máy in hóa đơn</p>
            <p class="text-uppercase mt-3 top-cate">Top máy in hóa đơn bán chạy</p>
            <div class="row mt-4 load-bg top-sale">
                <?php
                while ($value = mysql_fetch_array($sql_top->result)) { ?>
                    <div class="item d-block col-xxl-3 col-xl-3 col-lg-4 col-md-6 col-sm-12 col12">
                        <div class="item-wrapper">
                            <div class="row item-top">
                                <div class="col-12">
                                    <?= ($value['discount'] != 0) ? '<div class="sale-tag"><span>-' . $value['discount'] . '%</span></div>' : '' ?>
                                    <a href="<?= rewrite_alias($value['id'], $value['alias']); ?>"><img class="img-fluid item-img lazyload" src="/images/loading.gif" data-src="/images/item/<?= $value['image'] ?>" alt="<?= rewrite_title($value['name']) ?>"></a>
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
                                    <?= check_status($value['quantity'],$value['contact']) ?>
                                </div>
                                <div class="col-6 add-to-cart float-end d-inline">
                                    <button <?= disable_button($value['quantity'],$value['contact']) ?> class="button-add-cart" value="<?= $value['id'] ?>"><i class="ic-cart"></i></button>
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
            </div>
            <!--        top product end-->
            <!--        load more button-->
            <div class="d-flex justify-content-center mt-4 bg-see-more">
                <button class="btn btn-seemore"><a href="/tat-ca-may-in-hoa-don.html"><span>Xem Thêm</span></a></button>
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
                                <p class="text-orange slide-text-price"><?= price_new_2($data_silde['price_old'],$data_silde['discount']) ?> VND</p>
                                <p class="text-white fw-bold slide-text-item"><?= $data_silde['name'] ?></p>
                                <span class="text-white slide-text-sapo"><?= $data_silde['description'] ?></span>
                                <a class="text-decoration-none text-uppercase text-grey d-flex seemore" href="<?= rewrite_alias($data_silde['id'],$data_silde['alias']) ?>">
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
            <a href="/tat-ca-may-in-hoa-don.html" class="d-inline text-decoration-none text-grey float-end view-all"><span>Xem tất cả</span><i class="ic-angle-right"></i></a>
            <div class="row mt-4 mb-5 load-bg top-discount">
                <?php
                while ($value = mysql_fetch_array($sql_discount->result)) { ?>
                    <div class="item d-block col-xxl-3 col-xl-3 col-lg-4 col-md-6 col-sm-12 col12">
                        <div class="item-wrapper">
                            <div class="row item-top">
                                <div class="col-12">
                                    <?= ($value['discount'] != 0) ? '<div class="sale-tag"><span>-' . $value['discount'] . '%</span></div>' : '' ?>
                                    <a href="<?= rewrite_alias($value['id'], $value['alias']); ?>"><img class="img-fluid item-img lazyload" src="/images/loading.gif" data-src="/images/item/<?= $value['image'] ?>" alt="<?= rewrite_title($value['name']) ?>"></a>
                                </div>
                            </div>
                            <div class="row item-body">
                                <div class="col-7 float-start">
                                    <div class="rating">
                                        <i class="ic-star checked"></i>
                                        <i class="ic-star checked"></i>
                                        <i class="ic-star checked"></i>
                                        <i class="ic-star checked"></i>
                                        <i class="ic-star"></i>
                                        <span class="rating-num d-inline">( 4 )</span>
                                    </div>
                                </div>
                                <div class="col-5 float-end">
                                    <p class="item-code">MÃ: <?= $value['code_product'] ?></p>
                                </div>
                                <p class="mt-2 title-product"><a class="item-title text-decoration-none" href="<?= rewrite_alias($value['id'], $value['alias']) ?>"><?= rewrite_title($value['name']) ?></a></p>
                                <div class="col-12 item-price">
                                    <p class="price">
                                        <span class="price-new"><?= price_new($value['price_old'], $value['discount']) ?>đ</span>
                                        <?= ($value['discount'] != 0) ? '<span class="price-old">' . $value['price_old'] . ' đ</span>' : '' ?>
                                    </p>

                                </div>
                                <div class="col-6 item-status float-start d-inline">
                                    <?= check_status($value['quantity'],$value['contact']) ?>
                                </div>
                                <div class="col-6 add-to-cart float-end d-inline">
                                    <button <?= disable_button($value['quantity'],$value['contact']) ?> class="button-add-cart" value="<?= $value['id'] ?>"><i class="ic-cart"></i></button>
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
                <div class="d-flex justify-content-center mt-4 all-view bg-see-more">
                    <button class="btn btn-seemore"><a href="/tat-ca-may-in-hoa-don.html"><span>Xem tất cả</span></a></button>
                </div>
            </div>
            <!--        end best selloff-->
            <!--        best selloff-->
            <p class="text-uppercase mt-5 d-inline top-cate">Máy in hóa đơn được xem nhiều</p>
            <a href="/tat-ca-may-in-hoa-don.html" class="d-inline text-decoration-none text-grey float-end view-all"><span>Xem tất cả</span><i class="ic-angle-right"></i></a>
            <div class="row mt-4 mb-5 load-bg top-view">
                <?php
                while ($value = mysql_fetch_array($sql_view->result)) { ?>
                    <div class="item d-block col-xxl-3 col-xl-3 col-lg-4 col-md-6 col-sm-12 col12">
                        <div class="item-wrapper">
                            <div class="row item-top">
                                <div class="col-12">
                                    <?= ($value['discount'] != 0) ? '<div class="sale-tag"><span>-' . $value['discount'] . '%</span></div>' : '' ?>
                                    <a href="<?= rewrite_alias($value['id'], $value['alias']); ?>"><img class="img-fluid item-img lazyload" src="/images/loading.gif" data-src="/images/item/<?= $value['image'] ?>" alt="<?= rewrite_title($value['name']) ?>"></a>
                                </div>
                            </div>
                            <div class="row item-body">
                                <div class="col-7 float-start">
                                    <div class="rating">
                                        <i class="ic-star checked"></i>
                                        <i class="ic-star checked"></i>
                                        <i class="ic-star checked"></i>
                                        <i class="ic-star checked"></i>
                                        <i class="ic-star"></i>
                                        <span class="rating-num d-inline">( 4 )</span>
                                    </div>
                                </div>
                                <div class="col-5 float-end">
                                    <p class="item-code">MÃ: <?= $value['code_product'] ?></p>
                                </div>
                                <p class="mt-2 title-product"><a class="item-title text-decoration-none" href="<?= rewrite_alias($value['id'], $value['alias']) ?>"><?= rewrite_title($value['name']) ?></a></p>
                                <div class="col-12 item-price">
                                    <p class="price">
                                        <span class="price-new"><?= price_new($value['price_old'], $value['discount']) ?>đ</span>
                                        <?= ($value['discount'] != 0) ? '<span class="price-old">' . $value['price_old'] . ' đ</span>' : '' ?>
                                    </p>

                                </div>
                                <div class="col-6 item-status float-start d-inline">
                                    <?= check_status($value['quantity'],$value['contact']) ?>
                                </div>
                                <div class="col-6 add-to-cart float-end d-inline">
                                    <button <?= disable_button($value['quantity'],$value['contact']) ?> class="button-add-cart" value="<?= $value['id'] ?>"><i class="ic-cart"></i></button>
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
                <div class="d-flex justify-content-center mt-4 all-view bg-see-more">
                    <button class="btn btn-seemore"><a href="/tat-ca-may-in-hoa-don.html"><span>Xem tất cả</span></a></button>
                </div>
            </div>
            <!--        end best selloff-->
            <!--     brands-->
            <?php include '../include/brand.php'; ?>
        </div>
        <!--        body end-->
    </div>
    <!--footer-->
    <?php
    include '../include/footer.php';
    include '../include/modal_filter.php';
    ?>
    <!-- End footer -->

    <!-- Include Libs & Plugins
============================================ -->
    <script type="text/javascript" src="/js/jquery/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="/js/jquery/jquery-ui.min.js"></script>
    <script type="text/javascript" src="/js/bootstrap/bootstrap.min.js"></script>
    <script type="text/javascript" src="/js/owlcarousel/owl.carousel.min.js"></script>

    <script type="text/javascript" src="/js/home.js"></script>
    <script type="text/javascript" src="/js/search_advance.js"></script>
    <script type="text/javascript" src="js/Range-slider.js"></script>
    <script type="text/javascript" src="js/imageslider.js"></script>
    <script type="text/javascript" src="/js/lazysizes.min.js"></script>

</body>

</html>