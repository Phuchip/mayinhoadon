<!-- Modal -->
<div class="modal fade" id="filter-modal" role="dialog" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content container-modal">
            <div class="modal-header">
                <p class="modal-title">Lọc sản phẩm</p>
                <button class="btn-modal-exit"><i class="ic-exit"></i></button>
            </div>
            <div class="modal-body">
                <div class="filter-modal-1">
                    <div class="col-md-9 col-sm-9 col-xs-9 col-12 list_filter">
                        <button id="stock-filter-modal" class="btn btn-outline-gray d-inline dropdown show">Tình Trạng kho hàng <i class="ic-angle-down"></i></button>
                        <div id="stock-filter2" class="dropdown-content stock_filter">
                            <div class="form-check">
                                <input class="form-check-input input_stock" type="checkbox" value="con_hang" id="instock">
                                <label class="form-check-label" for="instock">
                                    Còn hàng
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input input_stock" type="checkbox" value="lien_he" id="contact">
                                <label class="form-check-label" for="contact">
                                    Liên hệ
                                </label>
                            </div>
                        </div>
                        <?php foreach ($array_filter as $value) { ?>
                            <button class="btn btn-outline-gray filter" value="<?= $value['value'] ?>"><?= $value['name'] ?></button>
                        <? } ?>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-3 col-12 filter-modal-last">
                        <button id="filter2-modal" class="btn btn-outline-gray d-inline dropdown show">Lọc sản phẩm <i class="ic-filter2"></i>
                        </button>
                        <div id="modal-filter-2" class="dropdown-content mgl-3 filter_product">
                            <div class="form-check">
                                <input type="checkbox" value="danh_gia" class="form-check-input input-filter" id="filtercheck1">
                                <label class="form-check-label" for="filtercheck1">Đánh giá</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" value="ten_a_z" class="form-check-input input-filter" id="filtercheck2">
                                <label class="form-check-label" for="filtercheck2">Tên A-Z</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="filter-modal-content">
                    <div class="modal-content-list">
                        <p class="accordion2"><i class="ic-printer"></i> Hãng sản xuất</p>
                        <div class="col-12 manufacturer">
                            <?php foreach ($array_hang_sx as $value) { ?>
                                <div class="form-check text-uppercase ">
                                    <input class="form-check-input input_manu" type="checkbox" value="<?= $value['id'] ?>" name="hang_sx">
                                    <label class="form-check-label">
                                        <?= $value['name'] ?>
                                    </label>
                                </div>
                            <? } ?>
                        </div>
                    </div>
                    <div class="modal-content-list">
                        <p class="accordion2"><i class="ic-dolar"></i> Khoảng giá</p>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control price_re price_first_modal" value="0" name="price-first" placeholder="0">
                            <i class="ic-left-right px-3"></i>
                            <input type="text" class="form-control price_re price_second_modal" value="3.500.000" placeholder="3.500.000">
                        </div>
                    </div>
                    <div class="modal-content-list">
                        <p class="accordion2"><i class="ic-category"></i> Loại máy in</p>
                        <div class="category">
                            <?php foreach ($array_loai_may as $value) { ?>
                                <div class=" form-check">
                                    <input class="form-check-input input_cate" type="checkbox" value="<?= $value['id'] ?>" name="loai_may">
                                    <label class="form-check-label">
                                        <?= $value['name'] ?>
                                    </label>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="modal-content-list">
                        <p class="accordion2"><i class="ic-database"></i> Cổng kết nối</p>
                        <div class="connect">
                            <?php foreach ($array_ket_noi as $value) { ?>
                                <div class="form-check">
                                    <input class="form-check-input input_connect" type="checkbox" value="<?= $value['id'] ?>" name="ket_noi">
                                    <label class="form-check-label">
                                        <?= $value['name'] ?>
                                    </label>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="modal-content-list">
                        <p class="accordion2"><i class="ic-file-alt"></i> Khổ giấy</p>
                        <div class="paper">
                            <?php foreach ($array_kho_giay as $value) { ?>
                                <div class="form-check">
                                    <input class="form-check-input input_paper" type="checkbox" value="<?= $value['id'] ?>" name="kho_giay">
                                    <label class="form-check-label">
                                        <?= $value['name'] ?>
                                    </label>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="modal-footer-btn modal-footer-fisrt apply-modal">Áp dụng</button>
                    <button class="modal-footer-btn" id="modal-footer-cancel">Hủy</button>
                </div>
            </div>
        </div>
    </div>