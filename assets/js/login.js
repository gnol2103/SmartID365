$(document).ready(function() {
    var see_log = $('.see_log');
    see_log.click(function() {
        var elm = $(this);
        if (elm.hasClass("no_see_log")) {
            elm.removeClass("no_see_log");
            elm.next().attr('type', 'password');
        } else {
            elm.addClass("no_see_log");
            elm.next().attr('type', 'text');
        }
    });
    $.validator.addMethod("validatePassword", function(value, element) {
        return this.optional(element) || /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d@$!%*#?&]{6,}$/.test(value);
    }, "Mật khẩu tối thiểu 6 ký tự gồm chữ, số, không chứa dấu cách!");

    $("#form_login").validate({
        errorPlacement: function(error, element) {
            error.insertAfter(element);
            error.wrap("<div class='err-red'>");
        },
        rules: {
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                validatePassword: true,
                minlength: 5
            }
        },
        messages: {
            email: {
                required: "Email không được để trống",
                email: "Nhập đúng định dạng email"
            },
            password: {
                required: "Mật khẩu không được để trống",
                minlength: "Mật khẩu phải dài ít nhất 5 ký tự"
            }
        },

        submitHandler: function(form) {
            var email = $('#email').val();
            var password = $('#password').val();
            $.ajax({
                type: "POST",
                url: "/LoginController/login",
                data: {
                    email: email,
                    password: password,
                },
                dataType: "json",
                success: function(response) {
                    check = response.result;
                    if (check == true) {
                        if (response['active'] == 1) {
                            window.location.href = '/trang-ca-nhan-tk' + response['user_id'] + '.html';
                        } else {
                            window.location.href = 'xac-thuc-tai-khoan.html';
                        }
                    } else {
                        alert(response.message);
                    }
                },
            });
        }
    });
});