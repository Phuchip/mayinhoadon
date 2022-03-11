<!-- Modal -->
<div class="modal fade" id="form-modal" role="dialog" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content container-modal-form">
            <div class="modal-header">
                <p class="modal-title-form">Nhập thông tin</p>
                <button class="btn-modal-close"><i class="ic-close"></i></button>
            </div>
            <div class="modal-body">
                <form onsubmit="return false">
                    <?php if($rating == 0){ ?>
                        <div class="star-rank">
                        <span class="txt-rank">Chọn đánh giá của bạn</span>
                        <div class="rating-comment">
                            <input type="radio" id="star5" name="rating" class="rating" value="5" checked/>
                            <label class="full" for="star5" title="Rất hài lòng"></label>

                            <input type="radio" id="star4" name="rating" class="rating" value="4" />
                            <label class="full" for="star4" title="Hài lòng"></label>

                            <input type="radio" id="star3" name="rating" class="rating" value="3" />
                            <label class="full" for="star3" title="Bình thường"></label>

                            <input type="radio" id="star2" name="rating" class="rating" value="2" />
                            <label class="full" for="star2" title="Tạm được"></label>

                            <input type="radio" id="star1" name="rating" class="rating" value="1" />
                            <label class="full" for="star1" title="Không thích"></label>
                        </div>
                        <span class="desc-star">Rất hài lòng</span>
                    </div>
                    <?} ?>
                    <div class="input_radio">
                        <input type="radio" name="gender" value="1" checked><label>Anh</label>
                        <input type="radio" name="gender" value="2"><label>Chị</label>
                    </div>
                    <div class="input_form_txt">
                        <input type="text" name="name" placeholder="Họ tên (bắt buộc)">
                        <input type="text" name="email" placeholder="Email (để nhận phải hồi qua email)">
                        <input type="text" name="phone" placeholder="Số điện thoại (để nhận phản hồi)">
                    </div>
                    <input type="hidden" name="id_product" value="<?= $data['id'] ?>">
                    <input class="id_parent" type="hidden" name="parent" value="0">
                    <button type="submit" class="md-form-btn">Cập nhật</button>
                </form>
            </div>
        </div>
    </div>
</div>