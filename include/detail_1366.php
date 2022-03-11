<div class="info-product-content">
    <div class="info-product-left">
        <div class="info-product-intro">
            <div class="product-intro-title">
                <p>Đánh giá <?= rewrite_title($data['name']) ?></p>
            </div>
            <div class="product-intro-body">
                <?= $data['review_product'] ?>
            </div>
            <div class="btn-compact">
                <button class="compact">Thu gọn <i class="ic-angle-up"></i></button>
            </div>
        </div>
        <div class="product-comment">
            <div class="pc-title">
                <p>Khách hàng chấm điểm, đánh giá, nhận xét</p>
            </div>
            <div class="rate-product">
                <div class="col-md-6 rp-first">
                    <div class="rp-text">
                        <p><?= $data['rate'] ?></p>
                        <span>/</span>
                        <p>5</p>
                    </div>
                    <div class="rp-star">
                        <img src="../images/icon/star-color.png">
                    </div>
                </div>
                <i class="ic-line-18"></i>
                <div class="col-md-6 rp-last">
                    <ul>
                        <?= count_rate($id) ?>
                    </ul>
                </div>
            </div>
            <div class="comment-are">
                <form method="POST" enctype="multipart/form-data">
                    <textarea name="comment" class="input-txt input-comment" placeholder="Mời bạn để lại bình luận..." required></textarea>
                    <div class="group-input">
                        <div class="group-btn-left">
                            <button type="button" class="send_img"><i class="ic-camera"></i>Gửi ảnh</button>
                            <a href="">Quy định đăng bình luận</a>
                        </div>
                        <div class="group-btn-right">
                            <button type="button" class="send_comment hidden">Gửi bình luận</button>
                        </div>
                    </div>
                    <input type="file" name="file_img[]" id="files" multiple class="input-img">
                    <div id="files-list"></div>
                </form>
            </div>
            <div id="show-comment" class="fetch_comment">
                <?php
                if (mysql_num_rows($query->result) > 0) {
                    while ($value = mysql_fetch_array($query->result)) { ?>
                    <div class="show-comment">
                        <div class="col-md-3 info-user">
                            <div class="cmt-avatar">
                                <img class=" lazyload" src="/images/loading.gif" data-src="../pictures/users/Ellipse_83.png" alt="Avtar user">
                            </div>
                            <div class="name-date-cmt-mobile">
                                <p class="cmt-name"><?=$value['name']?></p>
                                <div class="cmt-date-time">
                                    <span class="cmt-date"><?=date('d/m/Y',$value['created_time'])?></span>
                                    <span class="cmt-time"><?=date('H:i',$value['created_time'])?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9 info-cmt">
                            <p class="cmt-content"><?=$value['comment']?></p>
                            <div class="cmt-image">
                                <?php if($value['images'] != ''){
                                    $image = explode(',',$value['images']);
                                    foreach($image as $row){
                                        echo ('<img class="lazyload" src="/images/loading.gif" data-src="../pictures/comment/'.$row.'" alt="comment image">');
                                    }
                                }?>
                            </div>
                            <a href="javascript:void(0)" class="reply" id="<?=$value['id']?>">Trả lời</a>
                            <?php $query2 = new db_query("SELECT * FROM `tbl_comments` WHERE `parent` = '".$value['id']."' AND `status` = 1 AND `id_product` = ".$id);
                            if(mysql_num_rows($query2->result) > 0){
                                while($value2 = mysql_fetch_array($query2->result)){ ?>
                                    <div class="show-reply d-flex">
                                        <i class="ic-top-result"></i>
                                        <div class="reply-avt">
                                            <img class="lazyload" src="/images/loading.gif" data-src="../pictures/users/Ellipse_84.png">
                                        </div>
                                        <div class="reply-cmt">
                                            <p class="reply-cmt-name"><?=$value2['name']?> <?= ($value2['isAdmin'] != 0)?'<b class="admin">Quản trị viên</b>':'' ?></p>
                                            <p class="reply-cmt-content"><?=$value2['comment']?></p>
                                            <div class="cmt-date-time">
                                                <span class="cmt-date"><?=date('d/m/Y',$value2['created_time'])?></span>
                                                <span class="cmt-time"><?=date('H:i',$value2['created_time'])?></span>
                                            </div>
                                        </div>
                                    </div>
                                <?}
                            }?>
                        </div>
                    </div>
                <?  }
                } ?>
            </div>
        </div>
    </div>
    <div class="info-product-right">
        <div class="info-product-body">
            <div class="product-intro-title">
                <p>Thông số kỹ thuật</p>
            </div>
            <div class="product-intro-body">
                <p class="pib-title">Thông tin cơ bản </p>
                <table>
                    <tr>
                        <td>Thương hiệu</td>
                        <td><?= $data['thuong_hieu'] ?></td>
                    </tr>
                    <tr>
                        <td>Model</td>
                        <td><?= $data['model'] ?></td>
                    </tr>
                    <tr>
                        <td class="td-title">Chi tiết</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Tính năng</td>
                        <td><?php $tinh_nang = explode('|', $data['tinh_nang']);
                            foreach ($tinh_nang as $value) {
                                echo "<p>$value</p>";
                            } ?></td>
                    </tr>
                    <tr>
                        <td>Kết nối</td>
                        <td><?= $data['ket_noi'] ?></td>
                    </tr>
                    <tr>
                        <td class="td-title">Hiệu năng</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Tốc độ in</td>
                        <td><?= $data['toc_do_in'] ?></td>
                    </tr>
                    <tr>
                        <td>Kích cỡ & Trọng lượng</td>
                        <td></td>
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
                        <td class="td-title">Thông số khác</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Xuất xứ</td>
                        <td><?= $data['xuat_xu'] ?></td>
                    </tr>
                    <tr>
                        <td>Bảo hành</td>
                        <td><?= $data['bao_hanh'] ?></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="recom">
            <p class="recom-title top-cate">Gợi ý cho bạn</p>
            <div class="list-recom">
                <div class="item">
                    <img class=" recom-bg lazyload" src="/images/loading.gif" data-src="/images/slider/slider1.png" alt="">
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
                    <img class="recom-bg lazyload" src="/images/loading.gif" data-src="/images/slider/slider2.png" alt="may in 1">
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
                <div class="item">
                    <img class="recom-bg lazyload" src="/images/loading.gif" data-src="/images/slider/slider1.png" alt="">
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
            </div>
        </div>
    </div>
</div>