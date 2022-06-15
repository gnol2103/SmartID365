// function valBirthday(){
//     var birthday = $('#birthday').val()
//     if (birthday != '') {
//         var birthday = birthday.split('-');
//         birthday = Date.parse(birthday.join('/'));
//         var today = new Date();
//         today.setHours(0, 0, 0, 0);
//         today = Date.parse(today);
//         if (birthday > today) {
//             $("#birthday").addClass("error");
//             $('.error_birth').text("Ngày sinh không hợp lệ");
//             check = false;
//         } else {
//             $("#birthday").removeClass("error");
//             $('.error_birth').text("");
//         }
//     }
// }

function birthdayTest(birthday) {
    timenow = Date.parse(new Date());
    timeBirthday = Date.parse(birthday);
    if (parseInt(timenow) <= parseInt(timeBirthday)) {
        return false;
    } else return true;
}
$(document).ready(function() {
    $(".checkbox_input").click(function() {
        var elm = $(this);
        var value = elm.is(':checked');
        var err = elm.parent().parent().find(".err-red");
        $(".checkbox_none").prop("checked", value);
        if (value) {
            err.css('display', 'none');
        } else {
            err.css('display', 'block');
        }
    });
    $.validator.addMethod("validatePassword", function(value, element) {
        return this.optional(element) || /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d@$!%*#?&]{6,}$/.test(value);
    }, "Mật khẩu tối thiểu 6 ký tự gồm chữ, số, không chứa dấu cách!");

    $.validator.addMethod("validateBirthday", function(value, element) {
        return this.optional(element) || birthdayTest(value);
    }, "Ngày sinh không hợp lệ");

    $("#form_reg").validate({
        errorPlacement: function(error, element) {
            error.insertAfter(element);
            error.wrap("<div class='err-red'>");
        },
        rules: {
            email: {
                required: true,
                email: true
            },
            user_name: "required",
            password: {
                required: true,
                validatePassword: true,
            },
            res_password: {
                equalTo: "#password",
                required: true,
            },
            name_login: {
                equalTo: "#name_login",
                required: true,
            },
            birthday: {
                equalTo: "#birthday",
                required: true,
                validateBirthday: true
            },
            gender: {
                equalTo: "#gender",
                required: true,
            },
            agree: "required",
        },
        messages: {
            email: {
                required: "Email không được để trống",
                email: "Nhập đúng định dạng email"
            },
            user_name: "Tên hiển thị không được để trống",
            password: {
                required: "Mật khẩu không được để trống",
            },
            res_password: {
                equalTo: "Nhập lại mật khẩu không đúng",
                required: "Nhập lại mật khẩu không được để trống",
            },
            name_login: {
                required: "Tên truy cập không được để trống",
            },
            birthday: {
                required: "Ngày sinh không được để trống",
            },
            gender: {
                required: "Giới tính không được để trống",
            },
            agree: "Chọn đồng ý",
        },

        submitHandler: function(form) {
            var email = $.trim($('#email').val());
            var user_name = $.trim($('#user_name').val());
            var password = $.trim($('#password').val());
            var birthday = $.trim($('#birthday').val());
            var gender = $.trim($('#gender').val());
            $.ajax({
                type: "POST",
                url: "/Handles/RegistrationController/registrationAccount",
                data: {
                    email: email,
                    user_name: user_name,
                    password: password,
                    birthday: birthday,
                    gender: gender,
                },
                dataType: "json",
                success: function(response) {
                    check = response.result;
                    if (check == true) {
                        $.ajax({
                            type: "POST",
                            url: "/Handles/EmailSend/send",
                            data: {
                                email: email,
                                password: password,
                            },
                            dataType: "json",
                        });
                        window.location.href = '/xac-thuc-tai-khoan.html';
                    } else {
                        $('#error_email').html(response.message);
                    }
                },
            });


        }

    });
    var see_log = $('.see_log');
    var see_log_res = $('.see_log_res');
    see_pw(see_log);
    see_pw(see_log_res);

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