<?php
session_start();
include './config.php';
$meta_title = 'Giỏ hàng';
$meta_desc = 'Giỏ hàng';
$meta_key = 'Giỏ hàng';
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
							<li>3. Thanh toán</li>
						</ul>
						<table class="db-475">
							<tr class="tr-first">
								<td class="active">1</td>
								<td class="active">2</td>
								<td>3</td>
							</tr>
							<tr class="tr-second">
								<td class="active">Chọn sản phẩm</td>
								<td class="active">Xác nhận đơn hàng</td>
								<td>Thanh toán</td>
							</tr>
						</table>
					</div>
					<div class="cart-left-body">
						<div class="clb-top">
							<div class="clb-top-left dn-475">
								<p>Thông tin sản phẩm</p>
							</div>
							<div class="clb-top-right hidden dn-475">
								<a href=""><button><i class="ic-download"></i>Tải báo giá</button></a>
								<a href=""><button><i class="ic-print"></i>In báo giá</button></a>
							</div>
							<div class="gift-promo-title db-375">
								<p class="gift-promo-title1"></p>
								<p class="gift-promo-title2">Thông tin sản phẩm</p>
								<p class="gift-promo-title3"></p>
							</div>
						</div>
						<div class="clb-body">
							<?php if (isset($_SESSION['cart'])) {
								foreach ($_SESSION['cart'] as $key => $value) { ?>
									<?php $qr_item = new db_query("SELECT * FROM `tbl_product` WHERE `id` =" . $value['id']);
									$data = mysql_fetch_assoc($qr_item->result);
									?>
									<div class="cart-item cart_item<?= $data['id'] ?>">
										<div class="cart-item-img">
											<img class="lazyload" src="/images/loading.gif" data-src="/images/item/<?= $data['image'] ?>">
											<a href="<?= rewrite_alias($data['id'],$data['alias']) ?>"><p class="ci-title db-475"><?= $data['name'] ?></p></a>
										</div>
										<div class="cart-item-info">
											<a href="<?= rewrite_alias($data['id'],$data['alias']) ?>"><p class="ci-title dn-475"><?= $data['name'] ?></p></a>
											<div class="ci-body">
												<div class="ci-body-left">
													<div class="ci-dropdown">
														<button class="btn-dropdown"><i class="ic-angle-down-blue"></i>Chi tiết sản phẩm</button>
														<div class="btn-dropdown-content hidden">
															<table>
																<tr>
																	<td>Hãng sản xuất</td>
																	<td><?= $data['thuong_hieu'] ?></td>
																</tr>
																<tr>
																	<td>Mã sản phẩm</td>
																	<td><?= $data['model'] ?></td>
																</tr>
																<tr>
																	<td>Tốc độ</td>
																	<td><?= $data['toc_do_in'] ?></td>
																</tr>
																<tr>
																	<td>Kích cỡ</td>
																	<td><?= $data['kich_co'] ?></td>
																</tr>
																<tr>
																	<td>Trọng lượng</td>
																	<td><?= $data['trong_luong'] ?></td>
																</tr>
																<tr>
																	<td>Kết nối</td>
																	<td><?= $data['ket_noi'] ?></td>
																</tr>
																<tr>
																	<td>Xuất xứ</td>
																	<td><?= $data['xuat_xu'] ?></td>
																</tr>
															</table>
														</div>
													</div>
													<div class="ci-dropdown">
														<button class="btn-dropdown"><i class="ic-angle-down-blue"></i>Quà Tặng & Khuyến mãi</button>
														<div class="btn-dropdown-content hidden">
															<div class="btn-dropdown-content-child">
																<i class="ic-presents"></i>
																<p class="gift-title">Tặng phần mềm quản lý bán hàng (bảo hành trọn đời)</p>
															</div>
														</div>
													</div>
												</div>
												<div class="ci-body-right dn-475">
													<p class="ci-price"><?= $value['price'] ?> đ</p>
												</div>
											</div>
											<div class="ci-footer">
												<div class="cart-num">
													<div class="cart-num-first">
														<p>Số lượng </p>
														<div class="btn-cart-num">
															<button class="minus"><i class="ic-minus"></i></button>
															<input type="number" name="<?= $value['id'] ?>" class="numberPlace" value='<?= $value['quantity'] ?>' placeholder="1">
															<button class="plus"><i class="ic-plus"></i></button>
														</div>
													</div>
													<div class="ci-body-right db-475">
														<p class="ci-price"><?= $value['price'] ?> đ</p>
													</div>
												</div>
												<div class="btn-cart-del">
													<button class="delete-item" value="<?= $value['id'] ?>"><i class="ic-trash-blue"></i> Xóa</button>
												</div>
											</div>
										</div>
									</div>
							<?php }
							} ?>
						</div>
						<div class="clb-footer">
							<a onclick="window.history.go(-1); return false;"><button>Trở lại</button></a>
							<a href="/thanh-toan.html"><button>Thanh toán</button></a>
						</div>
					</div>
				</div>
				<div class="cart-right">
					<div class="info-cart">
						<p class="info-cart-title">Thông tin giỏ hàng</p>
						<div class="modal-num-item">
							<span>Số lượng sản phẩm</span><span class="total_item"><?= (isset($_SESSION['cart'])) ? $num : '0' ?></span>
						</div>
						<div class="modal-total">
							<span>Tổng chi phí</span><span class="total_price"><?= (isset($_SESSION['cart'])) ? $total : '0' ?> đ<span>
						</div>
						<div class="modal-cart-vat"><span>(Đã bao gồm cả VAT nếu có)</span></div>

						<div class="info-cart-btn">
							<a href="<?= (isset($_SESSION['cart'])) ? '/thanh-toan.html' : 'javascript:void(0)' ?>"><button class="btn-cart <?= (isset($_SESSION['cart'])) ? 'active' : '' ?>">Xác nhận đơn hàng</button></a>
							<button class="btn-del-cart <?= (isset($_SESSION['cart'])) ? 'delete-cart active' : '' ?> ">Xóa giỏ hàng</button>
							<a href="/"><button class="btn-view-item">Xem sản phẩm khác</button></a>
						</div>
					</div>
					<div class="info-pay">
						<div class="info-pay-deli">
							<p><i class="ic-tick-white"></i> Giao hàng từ 5 - 7 ngày toàn quốc</p>
							<p><i class="ic-tick-white"></i> Giao hàng từ 5 - 7 ngày toàn quốc</p>
							<p><i class="ic-tick-white"></i> Giao hàng từ 5 - 7 ngày toàn quốc</p>
							<p><i class="ic-tick-white"></i> Giao hàng từ 5 - 7 ngày toàn quốc</p>
						</div>
						<div class="modal-cart-pay">
							<p><i class="ic-wallet"></i> Tiền mặt</p>
							<p><i class="ic-card"></i> internet banking</p>
							<p><i class="ic-master-card"></i></p>
							<p><i class="ic-visa"></i></p>
						</div>
					</div>
				</div>
			</div>
			<div class="product-viewed">
				<div class="pv-title">
					<p>Sản phẩm vừa xem</p>
				</div>
				<div id="slick-product-viewed" class="slick-product-viewed">
					<?php if (isset($_SESSION['view'])) {
						foreach ($_SESSION['view'] as $key => $value) { ?>
							<div class="item d-block col-xxl-3 col-xl-3 col-lg-4 col-md-6 col-sm-12 col12">
								<div class="item-wrapper">
									<div class="row item-top">
										<div class="col-12">
										<?= ($value['discount'] != 0)?'<div class="sale-tag"><span>-'.$value['discount'].'%</span></div>':'' ?>
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
						<?php }
					} else { ?>
					<? } ?>
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
	<script type="text/javascript" src="/js/jquery/jquery-ui.min.js"></script>
	<script type="text/javascript" src="/js/bootstrap/bootstrap.min.js"></script>
	<script type="text/javascript" src="/js/slick.min.js"></script>
	<script type="text/javascript" src="/js/home.js"></script>
	<script type="text/javascript" src="/js/search_advance.js"></script>
	<script type="text/javascript" src="/js/cart.js"></script>
	<script type="text/javascript" src="/js/lazysizes.min.js"></script>
</body>

</html>