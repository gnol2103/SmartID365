<div class="registration login">
    <div class="reg_left">
        <img src="/assets/images/logo_trang.png" alt="Logo" class="logo_trang">
    </div>
    <form method="POST" role="form" enctype="multipart/form-data" id="form_reset_pass" class="k_form">
        <div class="reg_right">
            <div class="hd_left">
                <img src="/assets/images/logo.svg" alt="smartID 365" class="logo_site">
            </div>
            <h1 class="bn_t1">Đặt lại mật khẩu</h1>
            <div class="mb_20">
                <label class="form_label">Mật khẩu mới</label><br>
                <span class="see_log"></span>
                <input type="password" class="form_input" name="password" id="password" placeholder="Mật khẩu mới">
            </div>
            <div class="mb_20">
                <label class="form_label">Nhập lại mật khẩu mới</label><br>
                <span class="see_log_res"></span>
                <input type="password" class="form_input res_password" name="res_password" id="re_password" placeholder="Nhập lại mật khẩu mới">
            </div>
            <input hidden value="<?= $email ?>" name="email" id="email"/>
            <button type="submit" class="btn_x btn_reg">Đổi mật khẩu</button>
        </div>
    </form>
</div>
<!-- modal -->
<div class="modal" id="modal_reset_pass">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header justify-content-center">
        <h4 class="modal-title">Đặt lại mật khẩu thành công</h4>
      </div>
      <div class="modal-footer justify-content-center">
        <a href="/" class="btn_x link_home">Về trang chủ</a>
        <a href="/dang-nhap.html" class="btn_x link_login">Đăng nhập</a>
      </div>
    </div>
  </div>
</div>