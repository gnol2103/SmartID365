<div class="registration login">
    <div class="reg_left">
        <img src="/assets/images/logo_trang.png" alt="Logo" class="logo_trang">
    </div>
    <form method="POST" role="form" action="" enctype="multipart/form-data" id="form_forgot_pass" class="k_form">
        <div class="reg_right">
            <div class="hd_left">
                <img src="/assets/images/logo.svg" alt="smartID 365" class="logo_site">
            </div>
            <h1 class="bn_t1">Kiểm tra Email của bạn</h1>
            <div class="title-mail">
                <?=$page_content?>
            </div>
            <div class="resend-mail">
                Không nhận được Email?
            </div>
            <input hidden type="text" value="<?= $_SESSION['email']?>" name="email" id="email"> 
            <div class="modal-footer">
                <button type='submit' class="btn-resend btn_x resend " id="hideMsg">Gửi lại (<span class="hideMsg">60</span>s)</button>
            </div>
        </div>
    </form>
</div>
<!-- modal -->
<div class="modal" id="modal_send_mail">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header justify-content-center">
                <h4 class="modal-title">Đăng ký tài khoản thành công</h4>
            </div>
            <div class="modal-footer justify-content-center">
                <a href="/" class="btn_x link_home">Về trang chủ</a>
                <a href="/dang-nhap.html" class="btn_x link_login">Đăng nhập</a>
            </div>
        </div>
    </div>
</div>
