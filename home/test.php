<?php
session_start();
include './config.php';
require_once  '../classes/Mobile_Detect.php';
$url = $_SERVER['REQUEST_URI'];
$detect = new Mobile_Detect;
$id = getValue('id', 'int', 'GET', 0);
$ip = client_ip();

$sql = new db_query("SELECT * FROM `tbl_product` WHERE `delete` = 0 AND `status` = 1 AND id = " . $id);
if (mysql_num_rows($sql->result) > 0) {
    $data = mysql_fetch_array($sql->result);
    $link = rewrite_alias($data['id'],$data['alias']);
    if($url != $link){
        header("HTTP/1.1 301 Moved Permanently"); 
        header("Location: $link"); 
        exit();
    }
    $rating = check_rating($ip,$id);
    $list_img = explode(',', $data['des_images']);
    $sql_cate = new db_query("SELECT * FROM `tbl_product` WHERE `manufacturer` = " . $data['manufacturer'] . " AND `id` != " . $data['id'] . " AND `status` = 1 AND `delete` = 0 ORDER BY modify_time DESC ");
    $price_new = price_new_2($data['price_old'], $data['discount']);
    $db_update = new db_query("UPDATE `tbl_product` SET view = view + 1 WHERE id = " . $id);
    $sql_count_comment = new db_query("SELECT * FROM `tbl_comments` WHERE `isAdmin` = 0 AND `status` = 1 AND `id_product` = " . $id);
    $total_comment = mysql_num_rows($sql_count_comment->result);
    // product view
    if (isset($_SESSION['view'])) {
        $count = count($_SESSION['view']);
        $is_available = 0;
        foreach ($_SESSION['view'] as $key => $value) {
            if ($value['id'] == $id) {
                $is_available++;
            }
        }
        if ($is_available == 0 && $count < 10) {
            $item_array = array(
                'id'    => $id,
                'name'  => $data['name'],
                'alias' => $data['alias'],
                'quantity'  => $data['quantity'],
                'price_old' => $data['price_old'],
                'discount'  => $data['discount'],
                'code_product' => $data['code_product'],
                'contact'   => $data['contact'],
                'image' => $data['image']
            );
            $_SESSION['view'][] = $item_array;
        }
    } else {
        $item_array = array(
            'id'    => $id,
            'name'  => $data['name'],
            'alias' => $data['alias'],
            'quantity'  => $data['quantity'],
            'price_old' => $data['price_old'],
            'discount'  => $data['discount'],
            'code_product' => $data['code_product'],
            'contact'   => $data['contact'],
            'image' => $data['image']
        );
        $_SESSION['view'][] = $item_array;
    }
    $query = new db_query("SELECT * FROM `tbl_comments` WHERE `parent` = 0 AND `status` = 1 AND `id_product` = " . $id . " ORDER BY `created_time` DESC ");
    $query_group = new db_query("SELECT id,name,alias,price_old,discount,contact,rate,total_rate FROM tbl_product WHERE `connector` in (" . $data['connector'] . ") AND `paper_size` = " . $data['paper_size'] . " AND id != " . $data['id'] . " LIMIT 2");
    $query_slide = new db_query("SELECT b.id,b.name,b.alias,b.price_old,b.discount,b.description,a.name as thuong_hieu FROM `tbl_product` b JOIN `tbl_manufacturer` a ON b.`manufacturer` = a.`id` WHERE b.`delete` = 0 AND b.`status` = 1 AND b.`manufacturer` = " . $data['manufacturer'] . " AND b.`id` != " . $data['id'] . " ORDER BY b.`modify_time` DESC LIMIT 1");
    $data_silde = mysql_fetch_assoc($query_slide->result);
}else{
    header("HTTP/1.1 301 Moved Permanently"); 
    header("Location: 404"); 
    exit();
}

$meta_title = $data['title'];
$meta_desc = $data['description'];
$meta_key = $data['keyword'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- include meta -->
    <?php include '../include/meta.php'; ?>

    <!-- Preload css -->
    <link rel="preload" as="style" href="/css/bootstrap/bootstrap.min.css">
    <link rel="preload" as="style" href="/css/jqueryui/jquery-ui.min.css">
    <link rel="preload" as="style" href="/css/slick.css" />
    <link rel="preload" as="style" href="/css/home.css">
    <link rel="preload" as="style" href="/css/detail.css">
    <link rel="preload" as="style" href="/css/icon.css">
    <!--    Libs CSS-->
    <link rel="stylesheet" href="/css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="/css/jqueryui/jquery-ui.min.css">
    <link rel="stylesheet" href="/css/slick.css" />
    <!--    Theme CSS-->
    <link rel="stylesheet" href="/css/home.css">
    <link rel="stylesheet" href="/css/detail.css">
    <link rel="stylesheet" href="/css/icon.css">

</head>

<body>
    <div class="container-fluid main-container">
        <!--    header start-->
        <?php include '../include/header.php'; ?>
        <!--        breadcrumb-->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb pt-4">
                <li class="breadcrumb-item"><a class="breadcrumb-home" href="/">Trang ch???</a></li>
                <li class="breadcrumb-item" aria-current="page">M??y in h??a ????n</li>
                <li class="breadcrumb-item active" aria-current="page"><?= $data['name'] ?></li>
            </ol>
        </nav>
        <!--    header end-->
        <!--        body start-->
        <div class="body-page pd0 ">
            <div class="detail-product">
                <div class="row">
                    <div class="col-xl-4 col-lg-6 col-md-12 col-12 intro-item">
                        <div class="intro-item-top">
                            <div class="title-item">
                                <h2 class="fw-bold"><?= rewrite_title($data['name']) ?></h2>
                            </div>
                            <div class="rate">
                                <p>????nh gi?? : </p>
                                <div class="rating">
                                    <?= star_rating($data['rate']); ?>
                                </div>
                            </div>
                            <div class="relate">
                                <p>M?? SP :
                                <p class="p-color"><?= $data['code_product'] ?></p>
                                </p>
                                <span>|</span>
                                <p>B??nh lu???n :
                                <p class="p-color"><?= $total_comment ?></p>
                                </p>
                                <span>|</span>
                                <p>L?????t xem :
                                <p class="p-color"><?= $data['view'] ?></p>
                                </p>
                            </div>
                        </div>

                        <div class="intro-item-body">
                            <ul id="multiple-items">
                                <li><img class="img-fluid item-img images-slick" data-lazy="/images/item/<?= $data['image'] ?>" alt="???nh ?????i di???n"></li>
                                <?php foreach ($list_img as $key => $value) : ?>
                                    <li><img class="img-fluid item-img images-slick" data-lazy="/images/item/<?= $value ?>" alt="INRT029"></li>
                                <?php endforeach ?>
                            </ul>
                            <ul id="thumbnail-slick">
                                <li><img class="img-fluid item-img images-slick" data-lazy="/images/item/<?= $data['image'] ?>" alt="???nh ?????i di???n"></li>
                                <?php foreach ($list_img as $key => $value) : ?>
                                    <li><img class="img-fluid item-img images-slick" data-lazy="/images/item/<?= $value ?>" alt="INRT029"></li>
                                <?php endforeach ?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-6 col-md-12 col-12 detail-item">
                        <div class="para-item">
                            <p class="para-title">Th??ng s??? s???n ph???m</p>
                            <ul>
                                <?= (isset($data['cong_nghe']) && $data['cong_nghe'] != '') ? '<li>C??ng ngh??? : ' . $data['cong_nghe'] . '</li>' : '' ?>
                                <?= (isset($data['do_phan_giai']) && $data['do_phan_giai'] != '') ? '<li>????? ph??n gi???i : ' . $data['do_phan_giai'] . '</li>' : '' ?>
                                <?= (isset($data['kho_in']) && $data['kho_in'] != '') ? '<li>Kh??? in : ' . $data['kho_in'] . '</li>' : '' ?>
                                <?= (isset($data['toc_do']) && $data['toc_do'] != '') ? '<li>T???c ????? in (T???i ??a) : ' . $data['toc_do'] . '</li>' : '' ?>
                                <?= (isset($data['kho_giay_in']) && $data['kho_giay_in'] != '') ? '<li>Kh??? gi???y in : ' . $data['kho_giay_in'] . '</li>' : '' ?>
                                <?= (isset($data['mo_ta']) && $data['mo_ta'] != '') ? '<li>' . $data['mo_ta'] . '</li>' : '' ?>
                            </ul>
                            <a href="javascript:void(0)" class="para-detail">Th??ng s??? chi ti???t <i class="ic-right"></i></a>
                        </div>
                        <div class="relate-item">
                            <p class="relate-title">S???n ph???m c??ng nh??m</p>
                            <ul>
                                <li class="active">
                                    <p><i class="ic-tick-small"></i><?= $data['name'] ?></p>
                                    <span><?php price_new($data['price_old'], $data['discount']) ?> VND</span>
                                </li>
                                <?php
                                if (mysql_num_rows($query_group->result) > 0) {
                                    while ($value = mysql_fetch_array($query_group->result)) { ?>
                                        <li>
                                            <a href="<?= rewrite_alias($value['id'], $value['alias']) ?>">
                                                <p><i class="ic-tick-small"></i><?= $value['name'] ?></p>
                                                <span><?php price_new($value['price_old'], $value['discount']) ?> VND</span>
                                            </a>
                                        </li>
                                <?   }
                                }
                                ?>
                            </ul>
                        </div>
                        <div class="change-768-merge">
                            <div class="detail-price">
                                <p class="price-new"><?= $price_new ?>??? </p>
                                <?= ($data['discount'] != 0) ? '<p class="price-old">' . $data['price_old'] . '??? </p>
                                <p>Ti???t ki???m ' . $data['discount'] . '%</p>' : '' ?>
                            </div>
                            <div class="change-768">
                                <div class="vat-insur">
                                    <button>Gi?? ???? c?? VAT</button>
                                    <button>B???o h??nh <?= $data['insurance'] ?> th??ng</button>
                                </div>
                                <div class="status">
                                    <?= check_status_2($data['quantity'],$data['contact']) ?>
                                </div>
                            </div>
                        </div>
                        <div class="add-cart">
                            <form onsubmit="return false" id="form_add_cart">
                                <div class="add-to-cart">
                                    <div class="atc-first">
                                        <div class="atc-se">
                                            <div class="status dn-475">
                                                <?= check_status_2($data['quantity'],$data['contact']) ?>
                                            </div>
                                            <div class="add-cart-num">
                                                <p>S??? l?????ng : </p>
                                                <button class="btn-adjust minus">
                                                    <i class="btn-down"></i>
                                                </button>
                                                <input type="number" name="quantity" value="1" min="1">
                                                <button class="btn-adjust plus">
                                                    <i class="btn-up"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="detail-price dn-475">
                                            <p class="price-new"><?= $price_new ?>??? </p>
                                            <div class="dp-price-old">
                                                <p class="price-old"><?= $data['price_old'] ?>??? </p>
                                                <p class="dp-save">(<?= $data['discount'] ?>%)</p>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" id="id_product" value="<?= $data['id'] ?>">
                                    <button <?= disable_button($data['quantity'],$data['contact']) ?> class="btn-add-cart btn-add-to-cart"><i class="ic-cart-white"></i>Th??m v??o gi??? h??ng</button>
                                </div>
                            </form>
                        </div>
                        <button <?= disable_button($data['quantity'],$data['contact']) ?> class="contact-supplier" value="<?= $data['id'] ?>">
                            <p>?????t h??ng ngay</p>
                            <span>Giao h??ng t???n n??i nhanh ch??ng</span>
                        </button>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-3 dn-1024">
                        <div class="group-btn-txt">
                            <button>S???n ph???m ??ang c?? s???n t???i</button>
                            <ul>
                                <li>S??? 206 ?????nh C??ng H??? , P. ?????nh C??ng</li>
                            </ul>
                        </div>
                        <div class="group-btn-txt">
                            <button>Y??n t??m mua h??ng</button>
                            <ul>
                                <li>Uy t??n 20 n??m x??y d???ng v?? ph??t tri???n</li>
                                <li>S???n ph???m ch??nh h??ng 100%</li>
                                <li>Tr??? b???o h??nh t???n n??i s??? d???ng</li>
                                <li>B???o h??nh t???n n??i cho doanh nghi???p</li>
                                <li>V??? sinh mi???n ph?? tr???n ?????i m??y in</li>
                            </ul>
                        </div>
                        <div class="group-btn-txt">
                            <button>Mi???n ph?? giao h??ng</button>
                            <ul>
                                <li>Giao h??ng si??u t???c trong 2h</li>
                                <li>Giao h??ng mi???n ph?? to??n qu???c</li>
                                <li>Nh???n h??ng v?? thanh to??n t???i nh??</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="gift-promo">
                <div class="gift-promo-title">
                    <p class="gift-promo-title1"></p>
                    <p class="gift-promo-title2">Qu?? t???ng & khuy???n m??i</p>
                    <p class="gift-promo-title3"></p>
                </div>
                <div class="row gift-promo-content">
                    <div class="col-xl-7 col-lg-7 col-md-12 col-12">
                        <p class="gift-promo-content-title"><i class="ic-presents"></i>??u ????i t???ng k??m</p>
                        <div class="border-gift">
                            <div class="col-md-8 border-gift-first">
                                <p class="boder-gift-first">T???ng Ph???n m???m qu???n l?? b??n h??ng:</p>
                                <ul>
                                    <li>????n gi???n, hi???u qu???, ?????y ????? ch???c n??ng</li>
                                    <li>Nhanh, ch??nh x??c, h??? tr??? quy???t ?????nh qu???n l??</li>
                                    <li>MI???N PH?? v???i ng?????i m???i Kh???i nghi???p kinh doanh.</li>
                                    <li>MI???N PH?? v???i ng?????i m???i Kh???i nghi???p kinh doanh.</li>
                                </ul>
                                <p class="boder-gift-last db-768"><i class="ic-tick-white"></i>??ang ch???n</p>
                            </div>
                            <div class="col-md-4 col-12 dn-768 mg-auto gift-choose">
                                <img class="lazyload" src="/images/loading.gif" data-src="../images/image-removebg-preview.png" alt="gift-promo">
                                <p class="boder-gift-last">??ang ch???n</p>
                            </div>
                            <div class="col-md-4 db-768">
                                <div class="bg-img-gift-se">
                                    <img class="lazyload" src="/images/loading.gif" data-src="../images/icon/Rectangle_549.png">
                                </div>
                                <div class="bg-img-gift-th">
                                    <img class="lazyload" src="/images/loading.gif" data-src="../images/item/box_1.png">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-1 col-lg-1 dn-1024"></div>
                    <div class="col-xl-4 col-lg-4 dn-768 bg-img-gift">
                        <div class="bg-img-gift-se">
                            <img class="lazyload" src="/images/loading.gif" data-src="../images/item/Rectangle_549.png">
                        </div>
                        <div class="bg-img-gift-th">
                            <img class="lazyload" src="/images/loading.gif" data-src="../images/item/box_1.png">
                        </div>
                    </div>
                </div>
            </div>
            <div class="info-product">
                <div class="gift-promo-title">
                    <p class="gift-promo-title1"></p>
                    <p class="gift-promo-title2">Th??ng tin s???n ph???m</p>
                    <p class="gift-promo-title3"></p>
                </div>
                <?php
                if ($detect->isMobile()) {
                    include '../include/detail_375.php';
                } elseif ($detect->isTablet()) {
                    include '../include/detail_1024.php';
                } else {
                    include '../include/detail_1366.php';
                }
                ?>
            </div>
            <div class="product-relate change-1024">
                <p class="product-relate-title">S???n ph???m t????ng t???</p>
                <div id="list-pr" class="list-pr">
                    <?php
                    while ($value = mysql_fetch_array($sql_cate->result)) { ?>
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
                                        <p class="item-code">M??: <?= $value['code_product'] ?></p>
                                    </div>
                                    <p class="mt-2 title-product"><a class="item-title text-decoration-none" href="<?= rewrite_alias($value['id'], $value['alias']) ?>"><?= rewrite_title($value['name']) ?></a></p>
                                    <div class="col-12 item-price">
                                        <p class="price">
                                            <span class="price-new"><?= price_new($value['price_old'], $value['discount']) ?>??</span>
                                            <?= ($value['discount'] != 0) ? '<span class="price-old">' . $value['price_old'] . ' ??</span>' : '' ?>
                                        </p>

                                    </div>
                                    <div class="col-6 item-status float-start d-inline">
                                        <?= check_status($value['quantity'],$value['contact']) ?>
                                    </div>
                                    <div class="col-6 add-to-cart float-end d-inline">
                                        <button <?= disable_button($data['quantity'],$data['contact']) ?> class="button-add-cart" value="<?= $value['id'] ?>"><i class="ic-cart"></i></button>
                                    </div>

                                </div>
                                <div class="row item-footer">
                                    <div class="col-2  float-start">
                                        <i class="ic-presents"></i>
                                    </div>
                                    <div class="col-10  float-end bonus-gift">
                                        <p>T???ng: <span class="text-danger text-decoration-none">Ph???n m???m Qu???n l?? b??n h??ng</span>
                                            khi mua s???n ph???m t???i website</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <!--        body end-->
    </div>
    <div class="newsletter">
        <p>????NG K?? NH???N EMAIL TH??NG B??O KHUY???N M???I HO???C ????? ???????C T?? V???N MI???N PH??</p>
        <div class="form-newsletter">
            <form method="POST" onsubmit="return false" class="btn-new-letter">
                <div class="input-group">
                    <input type="text" required name="new_email" class="form-control new_letter" placeholder="Nh???p email ho???c s??? ??i???n tho???i c???a b???n">
                    <input type="hidden" data-id=<?= $id ?> class="id_product">
                    <div class="group-btn">
                        <button type="submit">G???i</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!--footer-->
    <?php
    include '../include/footer.php';
    include '../include/modal_form.php';

    ?>
    <!-- End footer -->

    <!-- Include Libs & Plugins
============================================ -->
    <script type="text/javascript" src="/js/jquery/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="/js/jquery/jquery-ui.min.js"></script>
    <script type="text/javascript" src="/js/bootstrap/bootstrap.min.js"></script>
    <script type="text/javascript" src="/js/slick.min.js"></script>
    <script type="text/javascript" src="/js/home.js"></script>
    <script type="text/javascript" src="/js/search_advance.js"></script>
    <script type="text/javascript" src="/js/detail.js"></script>
    <script type="text/javascript" src="/js/lazysizes.min.js"></script>
</body>

</html>