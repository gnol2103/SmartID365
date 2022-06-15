<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Chỉnh sửa voucher</h1>
    <div class="card shadow mb-4 px-5 py-4">
        <form method="post" id="form_edit_voucher" enctype="multipart/form-data" name="form_edit_product">
            <div class="d-flex mb-3">
                <label for="exampleInputEmail1" class="d-flex col-xl-3">Tên voucher<span class="text-danger ml-1">*</span></label>
                <div class="w-100 text-right">
                    <input type="text" class="form-control col-xl-12 mb-1" placeholder="Tên sản phẩm" name="vou_name" id="vou_name" value="<?= $info_pro['vou_name'] ?>">
                    <i class="text-danger vou_name_error"></i>
                    <input type="text" hidden name="id" id="id" value="<?= $info_pro['id'] ?>">
                </div>
            </div>
            <div class="d-flex mb-3">
                <label for="exampleInputEmail1" class="d-flex col-xl-3">Mã giảm giá<span class="text-danger ml-1">*</span></label>
                <div class="w-100 text-right">
                    <input type="text" class="form-control col-xl-12 mb-1" placeholder="Mã giảm giá" name="vou_coupon" id="vou_coupon" value="<?= $info_pro['vou_coupon'] ?>">
                    <i class="text-danger vou_coupon_error"></i>
                </div>
            </div>
            <div class="d-flex mb-3">
                <label for="exampleInputEmail1" class="d-flex col-xl-3">Điều kiện giảm<span class="text-danger ml-1">*</span></label>
                <div class="w-100 text-right">
                    <select id="vou_condition" name="vou_condition" class="form_input t_padding form-control mb-1">
                        <option value="1" <?= ($info_pro['vou_condition'] == 1) ? "selected" : "" ?>>Giảm theo VNĐ</option>
                        <option value="2" <?= ($info_pro['vou_condition'] == 2) ? "selected" : "" ?>>Giảm theo %</option>
                    </select>
                    <i class="text-danger vou_condition_error"></i>
                </div>
            </div>
            <div class="d-flex mb-3">
                <label for="exampleInputEmail1" class="d-flex col-xl-3">Giảm giá theo VNĐ hoặc %<span class="text-danger ml-1">*</span></label>
                <div class="w-100 text-right">
                    <input type="text" class="form-control col-xl-12 mb-1" placeholder="Giảm giá theo VNĐ hoặc %" name="discount" id="discount" value="<?php if ($info_pro['vou_condition'] == 1) {
                                                                                                                                                            echo number_format($info_pro['discount'], 0, ',', '.');
                                                                                                                                                        } else {
                                                                                                                                                            echo $info_pro['discount'];
                                                                                                                                                        } ?>">
                    <i class="text-danger discount_error"></i>
                </div>
            </div>
            <div class="d-flex mb-3">
                <label for="exampleInputEmail1" class="d-flex col-xl-3">Số lượng vé<span class="text-danger ml-1">*</span></label>
                <div class="w-100 text-right">
                    <input type="number" class="form-control col-xl-12 mb-1" placeholder="Số lượng vé" name="ticket_number" id="ticket_number" value="<?= $info_pro['ticket_number'] ?>">
                    <i class="text-danger ticket_number_error"></i>
                </div>
            </div>
            <div class="d-flex mb-3">
                <label for="exampleInputEmail1" class="d-flex col-xl-3">Số vé còn lại<span class="text-danger ml-1">*</span></label>
                <div class="w-100 text-right">
                    <input type="number" class="form-control col-xl-12 mb-1" placeholder="Số lượng vé" name="remaining_tickets" id="remaining_tickets" value="<?= $info_pro['remaining_tickets'] ?>">
                    <i class="text-danger remaining_tickets_error"></i>
                </div>
            </div>
            <div class="d-flex mb-3">
                <label for="exampleInputEmail1" class="d-flex col-xl-3">Giới tính<span class="text-danger ml-1">*</span></label>
                <div class="w-100 text-right">
                    <select id="gender" name="gender" class="form_input t_padding form-control mb-1">
                        <option value="4" <?= ($info_pro['gender'] == 4) ? "selected" : "" ?>>Chọn giới tính</option>
                        <option value="0" <?= ($info_pro['gender'] == 0) ? "selected" : "" ?>>Nam</option>
                        <option value="1" <?= ($info_pro['gender'] == 1) ? "selected" : "" ?>>Nữ</option>
                        <option value="1" <?= ($info_pro['gender'] == 2) ? "selected" : "" ?>>Khác</option>
                    </select>
                    <i class="text-danger ticket_number_error"></i>
                </div>
            </div>
            <div class="d-flex mb-3">
                <label for="exampleInputEmail1" class="d-flex col-xl-3">Sinh nhật<span class="text-danger ml-1">*</span></label>
                <div class="w-100 text-right">
                    <select id="birthday" name="birthday" class="form_input t_padding form-control mb-1">
                        <option value="0" <?= ($info_pro['birthday'] == 0) ? "selected" : "" ?>>Không áp dụng</option>
                        <option value="1" <?= ($info_pro['birthday'] == 1) ? "selected" : "" ?>>Áp dụng</option>
                    </select>
                    <i class="text-danger ticket_number_error"></i>
                </div>
            </div>
            <div class="d-flex mb-3">
                <label for="exampleInputEmail1" class="d-flex col-xl-3">Ngày chẵn lẻ<span class="text-danger ml-1">*</span></label>
                <div class="w-100 text-right">
                    <select id="vou_day" name="vou_day" class="form_input t_padding form-control mb-1">
                        <option value="0" <?= ($info_pro['vou_day'] == 0) ? "selected" : "" ?>>Không áp dụng</option>
                        <option value="1" <?= ($info_pro['vou_day'] == 1) ? "selected" : "" ?>>Lẻ</option>
                        <option value="2" <?= ($info_pro['vou_day'] == 2) ? "selected" : "" ?>>Chẵn</option>
                    </select>
                    <i class="text-danger ticket_number_error"></i>
                </div>
            </div>
            <div class="d-flex mb-3">
                <label for="exampleInputEmail1" class="d-flex col-xl-3">Theo Thứ<span class="text-danger ml-1">*</span></label>
                <div class="w-100 text-right">
                    <select id="thu" name="thu" class="form_input t_padding form-control mb-1" multiple>
                        <option value="" <?= ($info_pro['thu_select'] == '') ? "selected" : "" ?>>Không áp dụng</option>
                        <option value="2" <?= ($info_pro['thu_select'] == 1) ? "selected" : "" ?>>Thứ 2</option>
                        <option value="3" <?= ($info_pro['thu_select'] == 2) ? "selected" : "" ?>>Thứ 3</option>
                        <option value="4" <?= ($info_pro['thu_select'] == 3) ? "selected" : "" ?>>Thứ 4</option>
                        <option value="5" <?= ($info_pro['thu_select'] == 4) ? "selected" : "" ?>>Thứ 5</option>
                        <option value="6" <?= ($info_pro['thu_select'] == 5) ? "selected" : "" ?>>Thứ 6</option>
                        <option value="7" <?= ($info_pro['thu_select'] == 6) ? "selected" : "" ?>>Thứ 7</option>
                        <option value="8" <?= ($info_pro['thu_select'] == 0) ? "selected" : "" ?>>Chủ nhật</option>
                    </select>
                    <i class="text-danger ticket_number_error"></i>
                </div>
            </div>
            <div class="d-flex mb-3">
                <label for="exampleInputEmail1" class="d-flex col-xl-3">Theo Ngày<span class="text-danger ml-1">*</span></label>
                <div class="w-100 text-right">
                    <select id="ngay" name="ngay" class="form_input t_padding form-control mb-1" multiple>
                    <option value="" <?= ($info_pro['day_select'] == '') ? "selected" : "" ?>>Không áp dụng</option>
                    <?php 
                    for ($i = 1; $i <= 31; $i++) {
                        if($info_pro['day_select'] == $i){
                        echo '<option value="' . $i . '"'.($info_pro['day_select'] == $i)? "selected": "".'>' . $i . '</option>';

                        }
                    } ?>
                        <!-- <option value="01" <?= ($info_pro['day_select'] == 1) ? "selected" : "" ?>>1</option>
                        <option value="02" <?= ($info_pro['day_select'] == 2) ? "selected" : "" ?>>2</option>
                        <option value="03" <?= ($info_pro['day_select'] == 3) ? "selected" : "" ?>>3</option>
                        <option value="04" <?= ($info_pro['day_select'] == 4) ? "selected" : "" ?>>4</option>
                        <option value="05" <?= ($info_pro['day_select'] == 5) ? "selected" : "" ?>>5</option>
                        <option value="06" <?= ($info_pro['day_select'] == 6) ? "selected" : "" ?>>6</option>
                        <option value="07" <?= ($info_pro['day_select'] == 7) ? "selected" : "" ?>>7</option>
                        <option value="09" <?= ($info_pro['day_select'] == 9) ? "selected" : "" ?>>9</option>
                        <option value="10" <?= ($info_pro['day_select'] == 10) ? "selected" : "" ?>>10</option>
                        <option value="11" <?= ($info_pro['day_select'] == 11) ? "selected" : "" ?>>11</option>
                        <option value="12" <?= ($info_pro['day_select'] == 12) ? "selected" : "" ?>>12</option>
                        <option value="13" <?= ($info_pro['day_select'] == 13) ? "selected" : "" ?>>13</option>
                        <option value="14" <?= ($info_pro['day_select'] == 14) ? "selected" : "" ?>>14</option>
                        <option value="15" <?= ($info_pro['day_select'] == 15) ? "selected" : "" ?>>15</option>
                        <option value="16" <?= ($info_pro['day_select'] == 16) ? "selected" : "" ?>>16</option>
                        <option value="17" <?= ($info_pro['day_select'] == 17) ? "selected" : "" ?>>17</option>
                        <option value="18" <?= ($info_pro['day_select'] == 18) ? "selected" : "" ?>>18</option>
                        <option value="19" <?= ($info_pro['day_select'] == 19) ? "selected" : "" ?>>19</option>
                        <option value="20" <?= ($info_pro['day_select'] == 20) ? "selected" : "" ?>>20</option>
                        <option value="21" <?= ($info_pro['day_select'] == 21) ? "selected" : "" ?>>21</option>
                        <option value="22" <?= ($info_pro['day_select'] == 22) ? "selected" : "" ?>>22</option>
                        <option value="23" <?= ($info_pro['day_select'] == 32) ? "selected" : "" ?>>23</option>
                        <option value="24" <?= ($info_pro['day_select'] == 24) ? "selected" : "" ?>>24</option>
                        <option value="25" <?= ($info_pro['day_select'] == 25) ? "selected" : "" ?>>25</option>
                        <option value="26" <?= ($info_pro['day_select'] == 26) ? "selected" : "" ?>>26</option>
                        <option value="27" <?= ($info_pro['day_select'] == 27) ? "selected" : "" ?>>27</option>
                        <option value="28" <?= ($info_pro['day_select'] == 28) ? "selected" : "" ?>>28</option>
                        <option value="29" <?= ($info_pro['day_select'] == 29) ? "selected" : "" ?>>29</option>
                        <option value="30" <?= ($info_pro['day_select'] == 30) ? "selected" : "" ?>>30</option>
                        <option value="31" <?= ($info_pro['day_select'] == 31) ? "selected" : "" ?>>31</option> -->
                    </select>
                    <i class="text-danger ticket_number_error"></i>
                </div>
            </div>
            <div class="d-flex mb-3">
                <label for="exampleInputEmail1" class="d-flex col-xl-3">Theo Tháng<span class="text-danger ml-1">*</span></label>
                <div class="w-100 text-right">
                    <select id="thang" name="thang" class="form_input t_padding form-control mb-1" multiple>
                        <option value="" <?= ($info_pro['month_select'] == '') ? "selected" : "" ?>>Không áp dụng</option>
                        <option value="01" <?= ($info_pro['month_select'] == 1) ? "selected" : "" ?>>Tháng 1</option>
                        <option value="02" <?= ($info_pro['month_select'] == 2) ? "selected" : "" ?>>Tháng 2</option>
                        <option value="03" <?= ($info_pro['month_select'] == 3) ? "selected" : "" ?>>Tháng 3</option>
                        <option value="04" <?= ($info_pro['month_select'] == 4) ? "selected" : "" ?>>Tháng 4</option>
                        <option value="05" <?= ($info_pro['month_select'] == 5) ? "selected" : "" ?>>Tháng 5</option>
                        <option value="06" <?= ($info_pro['month_select'] == 6) ? "selected" : "" ?>>Tháng 6</option>
                        <option value="07" <?= ($info_pro['month_select'] == 7) ? "selected" : "" ?>>Tháng 7</option>
                        <option value="08" <?= ($info_pro['month_select'] == 8) ? "selected" : "" ?>>Tháng 8</option>
                        <option value="09" <?= ($info_pro['month_select'] == 9) ? "selected" : "" ?>>Tháng 9</option>
                        <option value="10" <?= ($info_pro['month_select'] == 10) ? "selected" : "" ?>>Tháng 10</option>
                        <option value="11" <?= ($info_pro['month_select'] == 11) ? "selected" : "" ?>>Tháng 11</option>
                        <option value="12" <?= ($info_pro['month_select'] == 12) ? "selected" : "" ?>>Tháng 12</option>
                    </select>
                    <i class="text-danger ticket_number_error"></i>
                </div>
            </div>
            <div class="d-flex mb-3">
                <label for="exampleInputEmail1" class="d-flex col-xl-3">Giờ bắt đầu</label>
                <div class="w-100 text-right">
                    <input type="time" class="form-control col-xl-12 mb-1" placeholder="Giờ bắt đầu" name="start_time" id="start_time" \ value="<?php if ($info_pro['start_time'] != 0) {
                                                                                                                                                    echo date('H:i', $info_pro['start_time']);
                                                                                                                                                } else {
                                                                                                                                                    echo '';
                                                                                                                                                } ?>">
                    <i class="text-danger start_time_error"></i>
                </div>
            </div>
            <div class="d-flex mb-3">
                <label for="exampleInputEmail1" class="d-flex col-xl-3">Giờ kết thúc</label>
                <div class="w-100 text-right">
                    <input type="time" class="form-control col-xl-12 mb-1" placeholder="Giờ kết thúc" name="time_end" id="time_end" value="<?php if ($info_pro['time_end'] != 0) {
                                                                                                                                                echo date('H:i', $info_pro['time_end']);
                                                                                                                                            } else {
                                                                                                                                                echo '';
                                                                                                                                            } ?>">
                    <i class="text-danger time_end_error"></i>
                </div>
            </div>
            <div class="d-flex mb-3">
                <label for="exampleInputEmail1" class="d-flex col-xl-3">Ngày bắt đầu<span class="text-danger ml-1">*</span></label>
                <div class="w-100 text-right">
                    <input type="date" class="form-control col-xl-12 mb-1" placeholder="Ngày bắt đầu" name="start_day" id="start_day" value="<?php if ($info_pro['start_day'] != 0) {
                                                                                                                                                    echo date('H:i Y-m-d', $info_pro['start_day']);
                                                                                                                                                } else {
                                                                                                                                                    echo '';
                                                                                                                                                }
                                                                                                                                                ?>">
                    <i class="text-danger start_day_error"></i>
                </div>
            </div>
            <div class="d-flex mb-3">
                <label for="exampleInputEmail1" class="d-flex col-xl-3">Ngày kết thúc<span class="text-danger ml-1">*</span></label>
                <div class="w-100 text-right">
                    <input type="date" class="form-control col-xl-12 mb-1" placeholder="Ngày kết thúc" name="end_date" id="end_date" value="<?php if ($info_pro['end_date'] != 0) {
                                                                                                                                                echo date('H:i Y-m-d', $info_pro['end_date']);
                                                                                                                                            } else {
                                                                                                                                                echo '';
                                                                                                                                            }
                                                                                                                                            ?>">
                    <i class="text-danger end_date_error"></i>
                </div>
            </div>
            <div class="text-center mt-4 mx-auto">
                <a href="/admin/voucher" class="btn btn-outline-secondary w-25 mr-4">Hủy</a>
                <button type="submit" class="btn btn-primary w-25 edit_voucher">Lưu</button>
            </div>
        </form>
    </div>
</div>