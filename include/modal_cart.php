<!-- Modal -->
<div class="modal fade" id="cart-modal" role="dialog" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-cart-dialog">
        <!-- Modal content-->
        <div class="modal-content container-modal-cart">
            <div class="modal-header">
                <p class="modal-title-cart">Bạn đang có <span class="total_item"><?= $num ?></span> sản phẩm trong giỏ hàng</p>
                <button class="btn-modal-close"><i class="ic-close"></i></button>
            </div>
            <div class="modal-body">
                <div class="mb-left <?= ($num > 0)?'active':'' ?>">
                    <p class="no-cart">Bạn đang không có sản phẩm nào trong giỏ hàng</p>
                    <?php if(isset($_SESSION['cart'])){foreach($_SESSION['cart'] as $key => $value){ ?>
                        <div class="mb-cart-item cart-item cart_item<?= $value['id'] ?>">
                        <div class="mb-cart-item-img">
                            <img src="../images/item/<?= $value['image'] ?>">
                        </div>
                        <div class="mb-cart-item-info">
                            <a href="<?= rewrite_alias($value['id'],$value['alias']) ?>">
                            <p class="mb-cart-title"><?= rewrite_title($value['name']) ?></p></a>
                            <p class="mb-cart-gift"><i class="ic-presents"></i>Phần mềm Quản lý bán hàng </p>
                            <p class="mb-cart-price"><?= $value['price'] ?> đ</p>
                        </div>
                        <div class="change-325">
                            <div class="mb-cart-num">
                                <button class="minus"><i class="ic-minus"></i></button>
                                <input type="number" name="<?= $value['id'] ?>" class="numberPlace" value='<?= $value['quantity'] ?>' placeholder="1">
                                <button class="plus"><i class="ic-plus"></i></button>
                            </div>
                            <div class="mb-cart-del">
                                <button class="delete-item" value="<?= $value['id'] ?>"><i class="ic-trash-blue"></i></button>
                            </div>
                        </div>
                    </div>
                    
                    <?}} ?>
                </div>
                <div class="mb-right">
                    <div class="info-cart">
                        <p class="info-cart-title">Thông tin giỏ hàng</p>
                        <div class="modal-num-item">
                            <span>Số lượng sản phẩm</span><span class="total_item"><?= $num ?></span>
                        </div>
                        <div class="modal-total">
                            <span>Tổng chi phí</span><span class="total_price"><?= $total ?> đ<span>
                        </div>
                        <div class="modal-cart-vat"><span>(Đã bao gồm cả VAT nếu có)</span></div>
                        
                        <div class="info-cart-btn">
                            <a href="<?= (isset($_SESSION['cart']))?'/gio-hang.html':'javascript:void(0)' ?>"><button class="btn-cart <?= (isset($_SESSION['cart']))?'active':'' ?>">Đến giỏ hàng</button></a>
                            <button class="btn-del-cart <?= (isset($_SESSION['cart']))?'delete-cart active':'' ?> ">Xóa giỏ hàng</button>
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
      </div>
  </div>
</div>