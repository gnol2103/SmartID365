    <div class="registration">
        <div class="reg_left">
            <img src="/assets/images/logo_trang.png" alt="Logo" class="logo_trang">
        </div>
        <form method="GET" role="form" action="/xac-thuc-tai-khoan.html" enctype="multipart/form-data" id="form_reg">
            <div class="reg_right">
                <div class="hd_left">
                    <img src="/assets/images/logo.svg" alt="smartID 365" class="logo_site">
                </div>
                <h1 class="bn_t1">Đăng ký <span class="bn_t1 color_x">SMARTID365</span></h1>
                <div class="mb_20">
                    <label class="form_label">Địa chỉ email</label><br>
                    <input type="text" class="form_input" name="email" id="email" placeholder="Địa chỉ email">
					<p class="warning" id="error_email"></p>
                </div>
                <div class="mb_20">
                    <label class="form_label">Tên hiển thị</label><br>
                    <input type="text" class="form_input" name="user_name" id="user_name" placeholder="Tên hiển thị">
                </div>
                <div class="mb_20 form_birthday">
                    <div class="control_input">
                        <label class="form_label">Ngày sinh</label>
                        <input type="text" placeholder="dd/mm/yyy"
                    onfocus="(this.type='date')" id="birthday" name="birthday" class="form_input t_padding">
                        <div class='noti-error error_birth'></div>
                    </div>
                    <div class="control_input">
                        <label class="form_label">Giới tính</label>
                        <select id="gender" name="gender" class="form_input t_padding">
                            <option value="">Giới tính</option>
                            <option value="0">Nam</option>
                            <option value="1">Nữ</option>
                            <option value="2">Khác</option>
                        </select>
                    </div>
                </div>
                <div class="mb_20">
                    <label class="form_label">Mật khẩu</label><br>
                    <span class="see_log"></span>
                    <input type="password" class="form_input" name="password" id="password" placeholder="Mật khẩu">
                </div>
                <div class="mb_20">
                    <label class="form_label">Nhập lại mật khẩu</label><br>
                    <span class="see_log_res"></span>
                    <input type="password" class="form_input res_password" name="res_password" placeholder="Nhập lại mật khẩu">
                </div>
                <div class="mb_20">
                    <div class="form_checkbox">
                        <input type="checkbox" class="checkbox_input">
                        <label for="agree" class="form_label">Tôi đồng ý với <span class="color_x">Điều khoản Dịch vụ</span> và <span class="color_x">Chính sách bảo mật</span> của SmartID365</label>
                    </div>
                    <input type="checkbox" class="checkbox_none" name="agree">
                </div>
                <button type="submit" class="btn_x btn_reg">Đăng ký</button>
                <p class="form_p">Đã có tài khoản? <a href="/dang-nhap.html" class="color_x">Đăng nhập</a></p>
            </div>
        </form>
    </div>
