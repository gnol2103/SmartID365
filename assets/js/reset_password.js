$(document).ready(function() {
    var see_log = $('.see_log');
    var see_log_res = $('.see_log_res');
    see_pw(see_log);
    see_pw(see_log_res);

    $.validator.addMethod("validatePassword", function(value, element) {
        return this.optional(element) || /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d@$!%*#?&]{6,}$/.test(value);
    }, "Mật khẩu tối thiểu 6 ký tự gồm chữ, số, không chứa dấu cách!");

    $("#form_reset_pass").validate({
        errorPlacement: function(error, element) {
            error.insertAfter(element);
            error.wrap("<div class='err-red'>");
        },
        rules: {
            password: {
                required: true,
                validatePassword: true,
            },
            res_password: {
                equalTo: "#password",
                required: true,
            }
        },
        messages: {
            email: {
                required: "Email không được để trống",
                email: "Nhập đúng định dạng email"
            },
            password: {
                required: "Mật khẩu không được để trống",
            },
            res_password: {
                equalTo: "Nhập lại mật khẩu không đúng",
                required: "Nhập lại mật khẩu không được để trống",
            }
        },
        submitHandler: function() {
            var email = $.trim($('#email').val());
            var pass = $('#password').val();
            var repass = $('#re_password').val();
            $.ajax({
                type: "POST",
                url: "/Handles/ResetPassWordController/reset",
                data: {
                    email: email,
                    password: pass,
                    repassword: repass,
                },
                dataType: "json",
                success: function() {
                    $('#modal_reset_pass').modal('show');
                    return false;
                },
            });
            return false;
        }
    });

});

function see_pw(btn) {
    btn.click(function() {
        var elm = $(this);
        if (elm.hasClass("no_see_log")) {
            elm.removeClass("no_see_log");
            elm.next().attr('type', 'password');
        } else {
            elm.addClass("no_see_log");
            elm.next().attr('type', 'text');
        }
    });
}