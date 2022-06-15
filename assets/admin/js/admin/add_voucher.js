$(document).ready(function () {
    $('#vou_day').change(function () {
        // var optionSelected = $("option:selected", this);
        var valueSelected = this.value;
        if (valueSelected == 3) {
            $('.thu_box').addClass('block');
            $('.thu_box').removeClass('none');
        } else if (valueSelected == 4) {
            $('.ngay_box').addClass('block');
            $('.ngay_box').removeClass('none');
        } else if (valueSelected == 5) {
            $('.thang_box').addClass('block');
            $('.thang_box').removeClass('none');
        }
    })

    $('#form_add_voucher').submit(function (e) {
        e.preventDefault();
        var vou_name = $.trim($('#vou_name').val());
        var vou_coupon = $.trim($('#vou_coupon').val())
        var vou_condition = $.trim($('#vou_condition').val());
        var discount = $.trim($('#discount').val());
        var ticket_number = $.trim($('#ticket_number').val());
        var gender = $.trim($('#gender').val());
        var birthday = $.trim($('#birthday').val());
        vou_day = [];
        vou_day.push($.trim($('#vou_day').val()));
        var thu_select = [];
        thu_select.push($.trim($('#thu').val()));
        var day_select = [];
        day_select.push($.trim($('#ngay').val()));
        var month_select = [];
        month_select.push($.trim($('#thang').val()));

        // giờ bắt đầu
        var start_time = $.trim($('#start_time').val());
        //giờ kết thúc
        var time_end = $.trim($('#time_end').val());
        // ngày bắt đầu
        var start_day = $.trim($('#start_day').val());
        // ngày kết thúc
        var end_date = $.trim($('#end_date').val());

        var flag = true;
        //name
        if (vou_name == '') {
            $('.vou_name_error').text('Tên voucher không được để trống');
            flag = false;
        } else {
            $('.vou_name_error').text('');
        }
        //mã giảm
        if (vou_coupon == '') {
            $('.vou_coupon_error').text('Mã giảm giá không được để trống');
            flag = false;
        } else {
            $('.vou_coupon_error').text('');
        }
        // điều kiện
        if (vou_condition == '') {
            $('.vou_condition_error').text('Điều kiện không được để trống');
            flag = false;
        } else {
            $('.vou_condition_error').text('');
        }
        // chiết khấu
        if (discount == '') {
            $('.discount_error').text('Chiết khẩu không được để trống');
            flag = false;
        } else {
            $('.discount_error').text('');
        }
        // số lượng vé
        if (ticket_number == '') {
            $('.ticket_number_error').text('Số lượng vé không được để trống');
            flag = false;
        } else {
            $('.ticket_number_error').text('');
        }
        var addVoucher = new FormData();
        addVoucher.append('vou_name', vou_name);
        addVoucher.append('vou_coupon', vou_coupon);
        addVoucher.append('vou_condition', vou_condition);
        addVoucher.append('discount', discount);
        addVoucher.append('ticket_number', ticket_number);
        addVoucher.append('gender', gender);
        addVoucher.append('birthday', birthday);
        addVoucher.append('start_time', start_time);
        addVoucher.append('time_end', time_end);
        addVoucher.append('start_day', start_day);
        addVoucher.append('end_date', end_date);
        addVoucher.append('vou_day', vou_day);
        addVoucher.append('thu_select', thu_select);
        addVoucher.append('month_select', month_select);
        addVoucher.append('day_select', day_select);
        if (flag) {
            $.ajax({
                url: "/Admin/Handles/Voucher/add_voucher",
                type: "POST",
                data: addVoucher,
                processData: false,
                contentType: false,
                dataType: "json",
                success: function (response) {
                    check = response.result;
                    console.log(check);
                    alert(response.message);
                    if (check == true) {
                        window.location.href = '/admin/voucher';
                    }
                },
            });
        }
    })
});