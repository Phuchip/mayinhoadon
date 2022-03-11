<div class="row mt-5 ft1">
                <!-- filter right-->
                <div class="col-xl-6 col-lg-8 col-md-8 text-start">
                    <button id="filter1-btn" class="btn btn-outline-gray d-inline dropdown show" onclick="filter1dropdown()">
                        <i class="ic-filter1"></i>
                        Lọc sản phẩm <i id="ic-filter1-expand" class="ic-filter1-expand d-none"></i>
                    </button>
                    <div id="filter1" class="dropdown-content">
                        <button class="accordion"><i class="ic-printer"></i> Hãng sản xuất</button>
                        <div class="panel">
                            <div class="row">
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

                        </div>
                        <button class="accordion"><i class="ic-category"></i> Loại máy in</button>
                        <div class="panel category">
                            <?php foreach ($array_loai_may as $value) { ?>
                                <div class="form-check">
                                    <input class="form-check-input input_cate" type="checkbox" value="<?= $value['id'] ?>" name="loai_may">
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
                                    <input class="form-check-input input_connect" type="checkbox" value="<?= $value['id'] ?>" name="ket_noi">
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
                                    <input class="form-check-input input_paper" type="checkbox" value="<?= $value['id'] ?>" name="kho_giay">
                                    <label class="form-check-label">
                                        <?= $value['name'] ?>
                                    </label>
                                </div>
                            <?php } ?>
                        </div>
                        <button class="accordion">Khoảng giá</button>
                        <div class="panel">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control price_re price_first" placeholder="0" aria-label="0" value="0">
                                <i class="ic-chevron px-3"></i>
                                <input type="text" id="range-price" class="form-control price_re price_second">
                            </div>
                            <div id="range-slider1" class="range-slider"></div>
                        </div>
                        <div class="apply-button">
                            <button class="modal-footer-btn apply_button active">Áp dụng</button>
                            <button class="modal-footer-btn modal-footer-second" onclick="filter1dropdown()">Hủy</button>
                        </div>
                    </div>
                    <button id="stock-filter-btn" class="btn btn-outline-gray d-inline dropdown show" onclick="stockfilter()">Tình Trạng kho hàng <i class="ic-angle-down"></i></button>
                    <div id="stock-filter" class="dropdown-content stock_filter">
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
                </div>
                <div class="col-xl-4 col-lg-1 col-md-1"></div>
                <div class="col-xl-2 col-lg-3 col-md-3 text-end">
                    <button id="filter2-btn" class="btn btn-outline-gray d-inline dropdown show" onclick="filter2()">
                        Lọc sản phẩm <i class="ic-filter2"></i>
                    </button>
                    <div id="filter2" class="dropdown-content mgl-3 filter_product">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input input-filter" id="filtercheck1" value="danh_gia">
                            <label class="form-check-label" for="filtercheck1">Đánh giá</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input input-filter" id="filtercheck2" value="ten_a_z">
                            <label class="form-check-label" for="filtercheck2">Tên A-Z</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3 ft2">
                <div class="col-md-12 list-filter">
                    <?php foreach ($array_filter as $value) { ?>
                    <button class="btn btn-outline-gray filter" value="<?= $value['value'] ?>"><?= $value['name'] ?></button>
                    <? }?>
                </div>
            </div>
            <div class="row mt-4 filter-tablet">
                <button class="btn btn-outline-gray d-inline dropdown show filter-modal" data-toggle="modal" data-target="#filter-modal" id="btn-modal">
                    <i class="ic-filter1"></i>
                    Lọc sản phẩm <i id="ic-filter1-expand" class="ic-filter1-expand d-none"></i>
                </button>
            </div>