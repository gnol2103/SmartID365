$(document).ready(function () {
    $('#form_edit_voucher').submit(function (e) {
        e.preventDefault();
        var id = $.trim($('#id').val());
        var vou_name = $.trim($('#vou_name').val());
        var vou_coupon = $.trim($('#vou_coupon').val())
        var vou_condition = $.trim($('#vou_condition').val());
        var discount = $.trim($('#discount').val());
        var ticket_number = $.trim($('#ticket_number').val());
        var remaining_tickets = $.trim($('#remaining_tickets').val());
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
        // điều kiện
        if (vou_condition == '') {
            $('.vou_condition_error').text('Điều kiện không được để trống');
            flag = false;
        } else {
            $('.vou_condition_error').text('');
        }
        // chiết khấu
        if (discount == '' ) {
            $('.discount_error').text('Chiết khẩu không được để trống');
            flag = false;
        } else {
            $('.discount_percent_error').text('');
        }
        // số lượng vé
        if (ticket_number == '') {
            $('.ticket_number_error').text('Số lượng vé không được để trống');
            flag = false;
        } else {
            $('.ticket_number_error').text('');
        }
        var editVoucher = new FormData();
        editVoucher.append('id', id);
        editVoucher.append('vou_name', vou_name);
        editVoucher.append('vou_coupon', vou_coupon);
        editVoucher.append('vou_condition', vou_condition);
        editVoucher.append('discount', discount);
        editVoucher.append('ticket_number', ticket_number);
        editVoucher.append('remaining_tickets', remaining_tickets);
        editVoucher.append('gender', gender);
        editVoucher.append('birthday', birthday);
        editVoucher.append('start_time', start_time);
        editVoucher.append('time_end', time_end);
        editVoucher.append('start_day', start_day);
        editVoucher.append('end_date', end_date);
        editVoucher.append('vou_day', vou_day);
        editVoucher.append('thu_select', thu_select);
        editVoucher.append('month_select', month_select);
        editVoucher.append('day_select', day_select);
        if (flag) {
            $.ajax({
                url: "/Admin/Handles/Voucher/edit_voucher",
                type: "POST",
                data: editVoucher,
                processData: false,
                contentType: false,
                dataType: "json",
                success: function (response) {
                    console.log(response);
                    check = response.result;
                    alert(response.message);
                    if (check == true) {
                        window.location.href = '/admin/voucher';
                    }
                },
            });
        }
    });

});