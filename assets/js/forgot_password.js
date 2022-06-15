$(document).ready(function() {
    $("#form_forgot_pass").validate({
        errorPlacement: function(error, element) {
            error.insertAfter(element);
            error.wrap("<div class='err-red'>");
        },
        rules: {
            email: {
                required: true,
                email: true
            }
        },
        messages: {
            email: {
                required: "Email không được để trống",
                email: "Nhập đúng định dạng email"
            }
        },

        submitHandler: function(form) {
            var email = $.trim($('#email').val());
            $.ajax({
                type: "POST",
                url: "/Handles/EmailSend/forgotPass",
                data: {
                    email: email,
                },
                dataType: "JSON",
                success: function(response) {
                    check = response.result;
                    if (check == true) {
                        window.location.href = '/xac-thuc-email.html';
                    } else {
                        alert(response.message);
                    }
                },
            });

        }
    });
});