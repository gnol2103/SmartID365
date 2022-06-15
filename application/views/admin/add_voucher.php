<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Thêm voucher</h1>
    <div class="card shadow mb-4 px-5 py-4">
        <form method="post" id="form_add_voucher" enctype="multipart/form-data">
            <div class="d-flex mb-3">
                <label for="exampleInputEmail1" class="d-flex col-xl-3">Tên Voucher<span class="text-danger ml-1">*</span></label>
                <div class="w-100 text-right">
                    <input type="text" class="form-control col-xl-12 mb-1" placeholder="Tên Voucher" name="vou_name" id="vou_name">
                    <i class="text-danger vou_name_error"></i>
                </div>
            </div>
            <div class="d-flex mb-3">
                <label for="exampleInputEmail1" class="d-flex col-xl-3">Mã giảm giá<span class="text-danger ml-1">*</span></label>
                <div class="w-100 text-right">
                    <input type="text" class="form-control col-xl-12 mb-1" placeholder="Mã giảm giá" name="vou_coupon" id="vou_coupon">
                    <i class="text-danger vou_coupon_error"></i>
                </div>
            </div>
            <div class="d-flex mb-3">
                <label for="exampleInputEmail1" class="d-flex col-xl-3">Giảm theo VND hoặc %<span class="text-danger ml-1">*</span></label>
                <div class="w-100 text-right">
                    <select id="vou_condition" name="vou_condition" class="form_input t_padding form-control mb-1">
                        <option value="">Chọn</option>
                        <option value="1">Giảm theo VND</option>
                        <option value="2">Giảm theo %</option>
                    </select>
                    <i class="text-danger vou_condition_error"></i>

                </div>
            </div>
            <div class="d-flex mb-3">
                <label for="exampleInputEmail1" class="d-flex col-xl-3">Giảm giá<span class="text-danger ml-1">*</span></label>
                <div class="w-100 text-right">
                    <input type="text" class="form-control col-xl-12 mb-1" placeholder="Giảm giá" name="discount" id="discount">
                    <i class="text-danger discount_error"></i>
                </div>
            </div>
            <div class="d-flex mb-3">
                <label for="exampleInputEmail1" class="d-flex col-xl-3">Số lượng vé<span class="text-danger ml-1">*</span></label>
                <div class="w-100 text-right">
                    <input type="number" class="form-control col-xl-12 mb-1" placeholder="Số lượng vé" name="ticket_number" id="ticket_number">
                    <i class="text-danger ticket_number_error"></i>
                </div>
            </div>
            <div class="d-flex mb-3">
                <label for="exampleInputEmail1" class="d-flex col-xl-3">Giới Tính</label>
                <select id="gender" name="gender" class="form_input t_padding form-control mb-1">
                    <option value="4">Không áp dụng</option>
                    <option value="0">Nam</option>
                    <option value="1">Nữ</option>
                    <option value="2">Khác</option>
                </select>
                <i class="text-danger gender_error"></i>
            </div>
            <div class="d-flex mb-3">
                <label for="exampleInputEmail1" class="d-flex col-xl-3">Sinh nhật</label>
                <select id="birthday" name="birthday" class="form_input t_padding form-control mb-1">
                    <option value="0">Không áp dụng</option>
                    <option value="1">Có áp dụng</option>
                </select>
                <i class="text-danger gender_error"></i>
            </div>
            <div class="d-flex mb-3">
                <label for="exampleInputEmail1" class="d-flex col-xl-3">Điều kiện áp dụng</label>
                <select id="vou_day" name="vou_day" class="form_input t_padding form-control mb-1">
                    <option value="0">Không áp dụng</option>
                    <option value="1">Ngày lẻ</option>
                    <option value="2">Ngày chẵn</option>
                </select>
                <i class="text-danger gender_error"></i>
            </div>
            <div class="d-flex mb-3 thu_box">
                <label for="exampleInputEmail1" class="d-flex col-xl-3">Theo thứ</label>
                <select name="thu" id="thu" class="form_input t_padding form-control mb-1" multiple>
                    <option value="1">Thứ 2</option>
                    <option value="2">Thứ 3</option>
                    <option value="3">Thứ 4</option>
                    <option value="4">Thứ 5</option>
                    <option value="5">Thứ 6</option>
                    <option value="6">Thứ 7</option>
                    <option value="0">Chủ nhật</option>
                </select>
                <i class="text-danger gender_error"></i>
            </div>
            <div class="d-flex mb-3 ngay_box">
                <label for="exampleInputEmail1" class="d-flex col-xl-3">Theo ngày</label>
                <select name="ngay" id="ngay" class="form_input t_padding form-control mb-1" multiple>

                    <?php for ($i = 1; $i <= 31; $i++) {
                        echo '<option value="' . $i . '">' . $i . '</option>';
                    } ?>
                </select>
                <i class="text-danger gender_error"></i>
            </div>
            <div class="d-flex mb-3 thang_box">
                <label for="exampleInputEmail1" class="d-flex col-xl-3">Theo tháng</label>
                <select name="thang" id="thang" class="form_input t_padding form-control mb-1" multiple>
                <?php for ($i = 1; $i <= 12; $i++) {
                        echo '<option value="' . $i . '">' . $i . '</option>';
                    } ?>
                </select>
                <i class="text-danger gender_error"></i>
            </div>
            <div class="d-flex mb-3">
                <label for="exampleInputEmail1" class="d-flex col-xl-3">Thời gian bắt đầu<span class="text-danger ml-1">*</span></label>
                <div class="w-100 text-right">
                    <input type="time" class="form-control col-xl-12 mb-1" placeholder="Thời gian bắt đầu" name="start_time" id="start_time">
                    <i class="text-danger start_time_error"></i>
                </div>
            </div>
            <div class="d-flex mb-3">
                <label for="exampleInputEmail1" class="d-flex col-xl-3">Thời gian kết thúc<span class="text-danger ml-1">*</span></label>
                <div class="w-100 text-right">
                    <input type="time" class="form-control col-xl-12 mb-1" placeholder="Thời gian kết thúc" name="time_end" id="time_end">
                    <i class="text-danger time_end_error"></i>
                </div>
            </div>
            <div class="d-flex mb-3">
                <label for="exampleInputEmail1" class="d-flex col-xl-3">Ngày bắt đầu<span class="text-danger ml-1">*</span></label>
                <div class="w-100 text-right">
                    <input type="date" class="form-control col-xl-12 mb-1" placeholder="Ngày bắt đầu" name="start_day" id="start_day">
                    <i class="text-danger start_day_error"></i>
                </div>
            </div>
            <div class="d-flex mb-3">
                <label for="exampleInputEmail1" class="d-flex col-xl-3">Ngày kết thúc<span class="text-danger ml-1">*</span></label>
                <div class="w-100 text-right">
                <!-- datetime-local -->
                    <input type="date" class="form-control col-xl-12 mb-1" placeholder="Ngày kết thúc" name="end_date" id="end_date">
                    <i class="text-danger end_date_error"></i>
                </div>
            </div>
            <div class="text-center mx-auto mt-4">
                <a href="/admin/voucher" class="btn btn-outline-secondary w-25 mr-4">Hủy</a>
                <button type="submit" class="btn btn-primary w-25 add_voucher">Thêm</button>
            </div>
        </form>
    </div>
</div>