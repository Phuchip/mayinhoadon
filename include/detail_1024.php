<div class="info-product-content-tablet">
    <div class="group-tabs">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#rate-item" type="button" role="tab" aria-controls="rate-item" aria-selected="true">Đánh giá sản phẩm</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#para-item" type="button" role="tab" aria-controls="para-item" aria-selected="false">Thông số kĩ thuật</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#opinion-custom" type="button" role="tab" aria-controls="opinion-custom" aria-selected="false">Ý kiến khách hàng</button>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane active" id="rate-item" role="tabpanel" aria-labelledby="rate-item-tab">
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
            </div>
            <div class="tab-pane" id="para-item" role="tabpanel" aria-labelledby="para-item-tab">
                <div class="para-item-tab">
                    <div class="info-product-body">
                        <div class="product-intro-title">
                            <p>Thông tin cơ bản</p>
                        </div>
                        <div class="product-intro-body">
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
                    <div class="location-item">
                        <div class="group-btn-txt">
                            <button>Sản phẩm đang có sẵn tại</button>
                            <ul>
                                <li>Số 206 Định Công Hạ , P. Định Công</li>
                            </ul>
                        </div>
                        <div class="group-btn-txt">
                            <button>Yên tâm mua hàng</button>
                            <ul>
                                <li>Uy tín 20 năm xây dựng và phát triển</li>
                                <li>Sản phẩm chính hãng 100%</li>
                                <li>Trả bảo hành tận nơi sử dụng</li>
                                <li>Bảo hành tận nơi cho doanh nghiệp</li>
                                <li>Vệ sinh miễn phí trọn đời máy in</li>
                            </ul>
                        </div>
                        <div class="group-btn-txt">
                            <button>Miễn phí giao hàng</button>
                            <ul>
                                <li>Giao hàng siêu tốc trong 2h</li>
                                <li>Giao hàng miễn phí toàn quốc</li>
                                <li>Nhận hàng và thanh toán tại nhà</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="opinion-custom" role="tabpanel" aria-labelledby="opinion-custom-tab">
                <div class="product-comment">
                    <div class="pc-title">
                        <p>Khách hàng chấm điểm, đánh giá, nhận xét</p>
                    </div>
                    <div class="tab-rate-cmt">
                        <div class="rate-product">
                            <div class="col-xl-6 col-12 rp-first">
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
                            <div class="col-xl-6 col-12 rp-last">
                                <ul>
                                    <li>
                                        <span>5</span>
                                        <i class="ic-star-grey"></i>
                                        <p class="bg-line-color"></p>
                                        <p class="rate-txt">0 Đánh giá</p>
                                    </li>
                                    <li class="active">
                                        <span>4</span>
                                        <i class="ic-star-grey"></i>
                                        <p class="bg-line-color"></p>
                                        <p class="rate-txt">5 Đánh giá</p>
                                    </li>
                                    <li>
                                        <span>3</span>
                                        <i class="ic-star-grey"></i>
                                        <p class="bg-line-color"></p>
                                        <p class="rate-txt">0 Đánh giá</p>
                                    </li>
                                    <li>
                                        <span>2</span>
                                        <i class="ic-star-grey"></i>
                                        <p class="bg-line-color"></p>
                                        <p class="rate-txt">0 Đánh giá</p>
                                    </li>
                                    <li>
                                        <span>1</span>
                                        <i class="ic-star-grey"></i>
                                        <p class="bg-line-color"></p>
                                        <p class="rate-txt">0 Đánh giá</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="tab-cmt-are">
                            <div class="comment-are">
                                <form method="POST" enctype="multipart/form-data">
                                    <textarea name="comment" class="input-txt input-comment" required> </textarea>
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
                </div>
            </div>
        </div>
    </div>
</div>