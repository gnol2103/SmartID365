<div class="cart">
    <h1 class="bn_t1">Thông tin đơn hàng</h1>
    <p class="no_pro">Không có sản phẩm nào trong giỏ hàng</p>
    <? if ($this->session->has_userdata('cart') && count($this->session->userdata('cart')) > 0) { ?>
        <input type="hidden" class="payment" value="<?= $payment ?>">
        <div class="ctn_cart">
            <div class="k_cart">
                <div class="cart_l"></div>
                <div class="cart_r">
                    <div class="k_promotion d-flex mb_20">
                        <input type="text" class="input_km" id="vou_coupon" placeholder="Nhập mã khuyến mại">
                        <button type="button" class="btn_x btn_km">Áp dụng</button>
                    </div>
                    <div class="k_order">
                        <p class="bn_t3">Chi tiết đơn hàng</p>
                        <div class="ctn_order d-flex">
                            <p class="order_l">Tổng tạm tính</p>
                            <p class="ml-auto order_r "><span class="order_r value_sum valSum">0</span> VNĐ</p>
                        </div>
                        <div class="ctn_order d-flex">
                            <p class="order_l">Phí giao hàng</p>
                            <p class="ml-auto order_r"><span class="h_trans_fee">0</span> VNĐ</p>
                        </div>
                        <div class="ctn_order d-flex">
                            <p class="order_l">Khuyến mại áp dụng</p>
                            <!-- <?= number_format(20000, 0, ',', ',') ?> -->
                            <p class="ml-auto order_r tienKM"><span class="h_voucher_fee">0</span> VNĐ</p>

                        </div>
                        <div class="ctn_order d-flex">
                            <p class="order_l">Thành tiền</p>
                            <p class="ml-auto order_r tongTien total total_money color_x"><span class="order_r total_money color_x value_sum h_total_fee">0</span> VNĐ</p>
                        </div>
                        <div class="k_center">
                            <button class="btn_x btn_payment">Thanh toán</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="k_payment">
                <form method="POST" role="form" enctype="multipart/form-data" id="form_payment">
                    <p class="bn_t3 mb_20">Thông tin giao hàng</p>
                    <div class="mb_20">
                        <p class="font_15">Họ và tên <span class="color_d">*</span></p>
                        <input type="text" name="user_name" class="input_gh user_name" placeholder="Họ và tên">
                    </div>
                    <div class="mb_20">
                        <p class="font_15">Số điện thoại <span class="color_d">*</span></p>
                        <input type="number" name="phone" class="input_gh user_phone" placeholder="Số điện thoại" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                    </div>
                    <div class="mb_20 k_address d-flex justify-content-between">
                        <div class="k_city">
                            <p class="font_15">Tỉnh / Thành phố <span class="color_d">*</span></p>
                            <div class="d-flex flex-column-reverse">
                                <select class="select_payment" name="city" id="city">
                                    <option value=""></option>
                                    <?php foreach ($city as $key => $value) : ?>
                                        <option value="<?= $value['cit_id'] ?>"><?= $value['cit_name'] ?></option>
                                    <?php endforeach; ?>

                                </select>
                            </div>
                        </div>
                        <div class="k_district">
                            <p class="font_15">Quận / Huyện <span class="color_d">*</span></p>
                            <div class="d-flex flex-column-reverse ">
                                <select class="select_payment" class="district" name="district" id="district">
                                    <option value="" ></option>
                                    <?php foreach ($district as $key => $value) : ?>
                                        <option value="<?= $value['dis_id'] ?>"><?= $value['dis_name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb_20">
                        <p class="font_15">Địa chỉ <span class="color_d">*</span></p>
                        <input type="text" name="address" class="input_gh user_address" placeholder="Địa chỉ nhận hàng">
                    </div>
                    <div class="mb_20">
                        <p class="font_15">Tên in trên thẻ (tuỳ chọn) <span class="color_d">**</span></p>
                        <input type="text" class="input_gh user_card" placeholder="Nhập tên in trên thẻ">
                    </div>
                    <div class="mb_20">
                        <p class="font_14">(<span class="color_d">**</span>): Đối với đơn hàng có nhiều thẻ, bạn vui lòng liệt kê tên trên từng thẻ vào ô ghi chú bên dưới, hoặc để lại yêu cầu, chúng tôi sẽ liên hệ lại để xác nhận.</p>
                    </div>
                    <div class="mb_20">
                        <p class="font_15">Ghi chú (tuỳ chọn)</p>
                        <textarea class="input_gh textarea_gh user_note" rows="2" placeholder="Nhập ghi chú, yêu cầu của bạn"></textarea>
                    </div>
                    <div class="mb_20">
                        <p class="font_15">Phương thức thanh toán <span class="color_d">***</span></p>
                        <select class="select_payment" id="select_payment" disabled>
                            <option value="1" selected>Thanh toán khi nhận hàng (COD)</option>
                        </select>
                    </div>
                    <div class="mb_20">
                        <p class="font_14">(<span class="color_d">***</span>): Đối với phương thức thanh toán chuyển khoản, thông tin thanh toán sẽ hiển thị sau khi bạn nhấn nút “Đặt hàng”</p>
                    </div>
                    <div class="k_center">
                        <button class="btn_x btn_order">Đặt hàng</button>
                    </div>
                </form>
            </div>
        </div>
    <? } ?>
</div>
