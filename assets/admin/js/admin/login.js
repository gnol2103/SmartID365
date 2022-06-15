$(document).ready(function() {
    $("#admin_form_login").validate({
        onfocusout: false,
        onkeyup: true,
        onclick: true,
        focusInvalid: true,
        rules: {
            username: { required: true },
            password: { 
                required: true
            }
        },
        messages: {
            username: {
                required: "Tên tài khoản không được để trống"
            },
            password: {
                required: "Mật khẩu không được để trống"
            }
        },
        errorPlacement: function(error,element){
            alert(error.html());
           },
        submitHandler: function(form) {
            var username = $('#username').val();
            var password = $('#password').val();
            $.ajax({
                type: "POST",
                url: "/Admin/Handles/Login/login",
                data: {
                    username: username,
                    password: password,
                },
                dataType: "json",
                success: function(response) {
                    check = response.result;
                    alert(response.message);
                    if (check == true) {
                        window.location.href = '/admin';
                    } 
                },
            });
            return false;
        }
     });
});