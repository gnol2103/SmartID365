<div class="product_details">
    <div class="details_k1">
        <a href="/san-pham.html" class="cb_sp d-flex align-items-center">Quay lại trang Sản phẩm</a>
        <div class="details_k2">
            <div class="dt_left">
                <h1 class="dt_text1"><?= $infoProduct['name'] ?></h1>
                <div class="details_k3">
                    <input type="hidden" class="pro_id" value="<?= $infoProduct['id'] ?>">
                    <input type="hidden" class="color" value="<?= $infoProduct['color'] ?>">
                    <p class="dt_text2"><?= $infoProduct['introduce'] ?></p>
                    <p class="dt_text3"><span class="dt_text3 price"><?= price_product($infoProduct['price'], $infoProduct['type_sale'], $infoProduct['sale']) ?></span> VNĐ</p>
                    <? if ($infoProduct['type_sale'] != 0) { ?>
                        <p class="dt_text4"><?= number_format($infoProduct['price']) ?> VNĐ</p>
                    <? } ?>
                    <div class="details_k4 d-flex align-items-center">
                        <button type="button" class="tang_giam">
                            <span class="tg_tru btn_tru">-</span>
                            <!-- <span class="tg_value">45</span> -->
                            <input type="text" class="tg_value amount" value="1" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                            <span class="tg_cong btn_cong">+</span>
                        </button>
                        <button type="button" class="btn_t btn_cart1" data-id="<?= $infoProduct['id'] ?>"><img src="/assets/images/cart1.svg" alt="Thêm vào giỏ hàng" class="icon_card1"></button>
                        <a href="/gio-hang.html" class="btn_x dt_text5" id="buy_now">Mua ngay</a>
                    </div>
                </div>
            </div>
            <div class="dt_right">
                <img src="/assets/product_image/<?= $infoProduct['image'] ?>" alt="Sản phẩm" class="dt_img_card" data-toggle="modal" data-target="#img_product">
            </div>
        </div>
    </div>
    <div class="nav_product">
        <ul class="nav nav-pills" id="pills-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active bn_t3" id="pills-descrip-tab" data-toggle="pill" href="#pills-descrip" role="tab" aria-controls="pills-descrip" aria-selected="true">Mô tả</a>
            </li>
            <li class="nav-item">
                <a class="nav-link bn_t3" id="pills-evaluate-tab" data-toggle="pill" href="#pills-evaluate" role="tab" aria-controls="pills-evaluate" aria-selected="false">Đánh giá</a>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active dt_descrip" id="pills-descrip" role="tabpanel" aria-labelledby="pills-descrip-tab"><?= $infoProduct['description'] ?></div>
            <div class="tab-pane fade dt_evaluate" id="pills-evaluate" role="tabpanel" aria-labelledby="pills-evaluate-tab">
                <form method="POST" role="form" enctype="multipart/form-data" id="form_evaluate">
                    <div class="evaluate_k1">
                        <div class="eva_k1_l">
                            <div class="mb_20">
                                <? if (empty($_SESSION['user'])) { ?>
                                    <p class="dg_t">Địa chỉ email</p>
                                    <input type="email" name="email" id="email" class="dg_input" placeholder="Địa chỉ email">
                                <? } else { ?>
                                    <input type="email" name="email" id="email" class="dg_input" placeholder="Địa chỉ email" value="<?= $user->email ?>">
                                <? } ?>

                            </div>
                            <div class="mb_20">
                                <? if (empty($_SESSION['user'])) { ?>
                                    <p class="dg_t">Tên hiển thị</p>
                                    <input type="text" name="display_name" id="display_name" class="dg_input" placeholder="Tên hiển thị">
                                <? } else { ?>
                                    <input type="text" name="display_name" id="display_name" class="dg_input" placeholder="Tên hiển thị" value="<?= $user->user_name ?>">
                                <? } ?>

                            </div>
                            <div class="mb_20">
                                <div class="dg_stars d-flex">
                                    <p class="dg_t">Đánh giá của bạn</p>
                                    <div class='rating-stars'>
                                        <ul id='stars'>
                                            <li class='star' title='Poor' data-value='1'>
                                                <i class='fa fa-star fa-fw'></i>
                                            </li>
                                            <li class='star' title='Fair' data-value='2'>
                                                <i class='fa fa-star fa-fw'></i>
                                            </li>
                                            <li class='star' title='Good' data-value='3'>
                                                <i class='fa fa-star fa-fw'></i>
                                            </li>
                                            <li class='star' title='Excellent' data-value='4'>
                                                <i class='fa fa-star fa-fw'></i>
                                            </li>
                                            <li class='star' title='WOW!!!' data-value='5'>
                                                <i class='fa fa-star fa-fw'></i>
                                            </li>
                                        </ul>
                                        <input type="text" name="star" id="star" class="hidden hide_star">
                                    </div>
                                </div>
                            </div>
                            <div class="dg_upload d-flex">
                                <p class="dg_t">Thêm ảnh</p>
                                <div class="upload_img">
                                    <div class="ul_k1 d-flex align-items-center">
                                        <button type="button" class="btn_x btn_gdg select_img">Chọn ảnh</button>
                                        <p class="ul_t">(Tối đa 3 ảnh)</p>
                                    </div>
                                    <input type="file" name="uploadimg" id="uploadimg" class="hidden upload-img" accept=".png, .jpg, .jpeg" multiple>
                                    <div class="validate_img"></div>
                                </div>
                            </div>
                            <div class="d-show-file">
                                <p class="files-area">
                                    <span id="filesList">
                                        <span id="files-names"></span>
                                    </span>
                                </p>
                            </div>
                        </div>
                        <div class="eva_k1_r">
                            <div class="mb_20">
                                <p class="dg_t">Đánh giá</p>
                                <textarea class="dg_textarea" name="evaluate" id="evaluate" rows="11" placeholder="Viết đánh giá"></textarea>
                            </div>
                            <div class="dg_btn">
                                <button type="submit" class="btn_x btn_gdg danh_gia">Gửi đánh giá</button>
                            </div>
                        </div>
                    </div>
                </form>
                <?php if (!empty($eva)) { ?>
                    <div class="evaluate_k2">
                        <div class="dg_k2_l">
                            <div class="star_t">
                                <p class="percent"><?= substr($avg['avg'], 0, 3) ?></p>
                                <div class="star-rating">
                                    <div class="back-stars">
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        
                                        <div class="front-stars" style="width: <?= substr($avg['avg'], 0, 3) / 5 * 100 ?>%">
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="star_b">
                                <div class="star_k d-flex align-items-center">
                                    <div class="star-rating">
                                        <div class="back-stars">
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <div class="front-stars" style="width: 100%">
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: <?php if ($star5['count'] != 0) {
                                                                                                        echo 100 / $count['count'] * $star5['count'];
                                                                                                    } else {
                                                                                                        echo "0";
                                                                                                    } ?>%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <p class="sum_star"><?= $count['count'] ?></p>
                                </div>
                                <div class="star_k d-flex align-items-center">
                                    <div class="star-rating">
                                        <div class="back-stars">
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <div class="front-stars" style="width: 80%">
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: <?php if ($star4['count'] != 0) {
                                                                                                        echo 100 / $count['count'] * $star4['count'];
                                                                                                    } else {
                                                                                                        echo "0";
                                                                                                    } ?>%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <p class="sum_star"><?= $count['count'] ?></p>
                                </div>
                                <div class="star_k d-flex align-items-center">
                                    <div class="star-rating">
                                        <div class="back-stars">
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <div class="front-stars" style="width: 60%">
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: <?php if ($star3['count'] != 0) {
                                                                                                        echo 100 / $count['count'] * $star3['count'];
                                                                                                    } else {
                                                                                                        echo "0";
                                                                                                    } ?>%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <p class="sum_star"><?= $count['count'] ?></p>
                                </div>
                                <div class="star_k d-flex align-items-center">
                                    <div class="star-rating">
                                        <div class="back-stars">
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <div class="front-stars" style="width: 40%">
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: <?php if ($star2['count'] != 0) {
                                                                                                        echo 100 / $count['count'] * $star2['count'];
                                                                                                    } else {
                                                                                                        echo "0";
                                                                                                    } ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <p class="sum_star"><?= $count['count'] ?></p>
                                </div>
                                <div class="star_k d-flex align-items-center">
                                    <div class="star-rating">
                                        <div class="back-stars">
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <div class="front-stars" style="width: 20%">
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: <?php if ($star1['count'] != 0) {
                                                                                                        echo 100 / $count['count'] * $star1['count'];
                                                                                                    } else {
                                                                                                        echo "0";
                                                                                                    } ?>%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <p class="sum_star"><?= $count['count'] ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="dg_k2_r">
                            <?php foreach ($eva as $value) { ?>
                                <div class="dg_user">
                                    <div class="dg_user_k1 d-flex justify-content-between">
                                        <div class="dg_user_l">
                                            <p class="dg_username"><?= $value['name_eva'] ?></p>
                                            <div class="star-rating">
                                                <?php
                                                $star = '';
                                                if ($value['star'] == 1) {
                                                    $star = '20';
                                                } else if ($value['star'] == 2) {
                                                    $star = '40';
                                                } else if ($value['star'] == 3) {
                                                    $star = '60';
                                                } else if ($value['star'] == 4) {
                                                    $star = '80';
                                                } else if ($value['star'] == 5) {
                                                    $star = '100';
                                                }
                                                ?>
                                                <div class="back-stars">
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>

                                                    <div class="front-stars" style="width: <?= $star ?>%">
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="dg_user_r d-flex">
                                            <?php $img = explode(',', $value['image']);
                                            foreach ($img as $val) { ?>
                                                <div class="k_card">
                                                    <img src="/assets/images/evaluate/<?= $val ?>" alt="Thẻ SmartID365" class="img_card">
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <p class="dg_ctn"><?= $value['content'] ?></p>
                                    <p class="dg_time">
                                        <?php
                                        $created = $value['created_at'];
                                        if (date('Y', $created) == getdate()['year'] && date('m', $created) == getdate()['mon'] && date('d', $created) == getdate()['mday'] && date('H', $created) == getdate()['hours'] && date('i', $created) == getdate()['minutes'] ) {
                                            echo 'vừa đăng';
                                        } else if (date('Y', $created) == getdate()['year'] && date('m', $created) == getdate()['mon'] && date('d', $created) == getdate()['mday'] && date('H', $created) == getdate()['hours'] && date('i', $created) < getdate()['minutes']) {
                                            echo '' . getdate()['minutes'] - date('i', $created) . ' phút trước';
                                        } else if (date('Y', $created) == getdate()['year'] && date('m', $created) == getdate()['mon'] && date('d', $created) == getdate()['mday'] && date('H', $created) < getdate()['hours']) {
                                            echo '' . getdate()['hours'] - date('H', $created) . ' giờ trước';
                                        } else if (date('Y', $created) == getdate()['year'] && date('m', $created) == getdate()['mon'] && date('d', $created) < getdate()['mday']) {
                                            echo '' . getdate()['mday'] - date('d', $created) . ' ngày trước';
                                        } else if (date('Y', $created) == getdate()['year'] && date('m', $created) < getdate()['mon']) {
                                            echo '' . getdate()['mon'] - date('m', $created) . ' tháng trước';
                                        } else if (date('Y', $created) < getdate()['year']) {
                                            echo '' . getdate()['year'] - date('Y', $created) . ' năm trước';
                                        }
                                        ?>
                                    </p>
                                </div>
                            <?php } ?>

                            <!-- <?php if (isset($links)) { ?>
                                <?php echo $links ?>
                            <?php } ?> -->

                            <!-- <div class="paging text-right">
                                <button type="button" class="dg_pt pt_chon">1</button>
                                <button type="button" class="dg_pt">2</button>
                                <button type="button" class="dg_pt">3</button>
                                <button type="button" class="dg_pt">4</button>
                                <button type="button" class="dg_pt">5</button>
                            </div> -->
                        </div>
                    </div>
                <?php } else {
                    echo '<h1 style="text-align: center;font-size: 24px; margin-top:50px;">Chưa có đánh giá về sản phẩm này</h1>';
                } ?>
                <section>
                    <div class="data-container"></div>
                    <div id="pagination-demo1" name="demo1"></div>
                </section>

            </div>
        </div>
    </div>
    <p class="dt_splq bn_t3">Sản phẩm liên quan</p>
    <div class="ctn_product">

    </div>
</div>



<div class="modal" id="img_product">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <button type="button" class="close d-flex justify-content-end" data-dismiss="modal">&times;</button>
            <img src="/assets/images/card.png" alt="Sản phẩm" class="img_sp">
        </div>
    </div>
</div>
