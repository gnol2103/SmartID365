$(document).ready(function() {
    $('.resend').attr('disabled', 'true');
    var sec = 60;
    var timer = setInterval(function() {
        $('#hideMsg span').text(sec--);
        if (sec == -1) {
            clearInterval(timer);
            $('.resend').removeAttr('disabled');
        }
    }, 1000);
    // if($('#hideMsg span').text(sec--) == 0){
    $('.resend').click(function(e) {
        e.preventDefault();
        $('.resend').attr('disabled', 'true');
        var sec = 60;
        var timer = setInterval(function() {
            $('#hideMsg span').text(sec--);
            if (sec == -1) {
                clearInterval(timer);
                $('.resend').removeAttr('disabled');
            }
        }, 1000);
        var email = $.trim($('#email').val());
        $.ajax({
            type: "POST",
            url: "/Handles/EmailSend/forgotPass",
            data: {
                email: email,
            },
            dataType: "json",
        });
        return false;
    });
    // }

})