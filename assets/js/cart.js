var check_coupon = []
$(document).ready(function() {
    $(".select_payment").select2({
        width: "100%",
    });
    $("#city").select2({
        width: "100%",
        placeholder: "Chọn tỉnh / thành phố",
    });
    $("#district").select2({
        width: "100%",
        placeholder: "Chọn quận / huyện",
    });
    var payment = $(".btn_payment");
    var valPayment = $(".payment");
    payment.click(function() {
        $('.ctn_cart').addClass('payment_show');
    });
    if (valPayment.val()) {
        payment.click();
    }
    $('#city').change(function() {
        var city = $(this).val();
        $.ajax({
            type: "POST",
            url: "/Handles/BillInforController/district",
            dataType: "JSON",
            data: { city: city },
            success: function(response) {
                data = response.data;
                // console.log(data);
                if (response.result == true) {
                    htmlDis = '';
                    $.each(data, function(index, item) {
                        htmlDis += '<option value="" ></option>';
                        htmlDis += '<option value="' + data[index].dis_id + ' "> ' + data[index].dis_name + '</option>';
                    });
                    $('#district').html(htmlDis);
                }
            }
        });
    })
    var phoneformat = /((0)+([0-9]{9,})\b)/;

    function removeAscent(str) {
        if (str === null || str === undefined) return str;
        str = str.toLowerCase();
        str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, "a");
        str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g, "e");
        str = str.replace(/ì|í|ị|ỉ|ĩ/g, "i");
        str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, "o");
        str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g, "u");
        str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g, "y");
        str = str.replace(/đ/g, "d");
        str = str.replace(/ /g, "");
        return str;
    }
    var nameformat = /^[a-zA-Z]{1,}$/;
    $.validator.addMethod("validatePhone", function(value, element) {
        return this.optional(element) || phoneformat.test(value);
    }, "Số điên thoại không đúng định dạng!");
    $.validator.addMethod("validateName", function(value, element) {
        return this.optional(element) || nameformat.test(removeAscent(value));
    }, "Họ tên không đúng định dạng!");
    $("#form_payment").validate({
        errorPlacement: function(error, element) {
            error.insertAfter(element);
            error.wrap("<div class='err-red'>");
        },
        rules: {
            user_name: {
                required: true,
                validateName: true
            },
            phone: {
                required: true,
                validatePhone: true
            },
            city: {
                required: true,
            },
            district: {
                required: true,
            },
            address: {
                required: true,
            }
        },
        messages: {
            user_name: {
                required: "Họ và tên không được để trống",
            },
            phone: {
                required: "Số điện thoại không được để trống",
            },
            city: {
                required: "Chọn tỉnh / thành phố",
            },
            district: {
                required: "Chọn quận / huyện",
            },
            address: {
                required: "Địa chỉ không được để trống",
            }
        },
        submitHandler: function(form) {
            var formBills = new FormData();
            var list_product = [];
            var product_id = [];
            var amount = [];
            $('.idCart').each(function() {
                    product_id.push($(this).attr('data-cart-id'));
                })
                // $('.price_product').each(function() {
                //     moneyCart.push($(this).text().replace(',', ''));
                // })
            $('.amount').each(function() {
                amount.push($(this).val());
            })
            for (i = 0; i < product_id.length; i++) {
                list_product.push({
                    id: product_id[i],
                    amount: amount[i]
                });
            }
            // console.log(addIdCart);

            formBills.append('user_name', $('.user_name').val());
            formBills.append('user_phone', $('.user_phone').val());
            formBills.append('city', $('#city').val());
            formBills.append('district', $('#district').val());
            formBills.append('user_address', $('.user_address').val());
            formBills.append('user_card', $('.user_card').val());
            formBills.append('user_note', $('.user_note').val());
            if (Object.values(check_coupon).length) {
                voucher = check_coupon['id'];
            } else {
                voucher = ''
            }
            formBills.append('voucher', voucher);
            formBills.append('trans_fee', parseInt($('.h_trans_fee').html().replace(',', '')));
            formBills.append('list_product', JSON.stringify(list_product));
            $.ajax({
                type: "POST",
                url: "/Handles/BillInforController/pay",
                dataType: "JSON",
                data: formBills,
                processData: false,
                contentType: false,
                success: function(response) {
                    alert(response.result);
                    if (response.result == "true") {
                        alert(response.msg)
                        window.location.href = "/thong-tin-thanh-toan.html";
                    } else {
                        alert(response.msg)
                    }
                }
            });
        }
    });



    $.ajax({
        type: "POST",
        url: "/ProductDetailsController/infoProductInCart",
        dataType: "json",
        success: function(response) {
            check = response.result;
            if (check == true) {
                var cart = response.data;
                if (cart.length > 0) {
                    var htmlCart = '';
                    $.each(cart, function(index, value) {
                        htmlCart += `<div class="k_sp d-flex mb_20 main_cart1 idCart" data-cart-id="` + value.id + `">
                            <button class="btn_t color_d btn_dlt_pro">Xóa</button>
                            <div class="k_card">
                                <img src="` + value.image + `" alt="` + value.name + `" class="img_card" >
                            </div>
                            <div class="ctn_card d-flex flex-column justify-content-center">
                                <p class="cart_t1">` + value.name + `</p>
                                <p class="cart_t2"><span class="cart_t2 price_pro price_product">` + value.price + `</span> VNĐ</p>
                                <div class="ctn_card_k1 d-flex justify-content-between">
                                    <div class="tang_giam">
                                        <button class="tg_tru btn_down">-</button>
                                        <input type="text" class="tg_value value_amount amount" value="` + value.amount + `">
                                        <button class="tg_cong btn_up">+</button>
                                    </div>
                                    <p class="cart_t3"><span class="cart_t3 total_money"></span> VNĐ</p>
                                </div>
                            </div>
                        </div>`;
                    });
                    $('.cart_l').html(htmlCart);
                    total();
                }
            }
        },
    });
    $('.btn_km').click(function() {
        if ($('#vou_coupon').val() != '') {
            var coupon = $.trim($('#vou_coupon').val());
            check_coupon = []
            $.ajax({
                type: "POST",
                url: "/Handles/BillInforController/check_coupon",
                dataType: "json",
                data: { coupon: coupon },
                success: function(response) {
                    check = response.result;
                    data = response.data;
                    console.log(response.data);
                    if (coupon != '') {
                        if (response.result == true) {
                            alert(response.message);
                            check_coupon = response.data;
                            $('.btn_km').addClass('coupon');
                            if ($('.btn_km').hasClass('coupon') == true) {
                                htmlVou = '';
                                htmlVouTotal = '';
                                var arrTotal = $('.valSum').text().split(',');
                                var strTotal = arrTotal.join('');
                                var arrValSum = $('.valSum').text().split(',');
                                var strValSum = arrValSum.join('');

                                if (data['vou_condition'] == 1) {
                                    htmlVou += '<p class="ml-auto order_r tienKM"><span class="h_voucher_fee">' + data['discount'].replace(/\B(?=(\d{3})+(?!\d))/g, ',') + '</span> VNĐ</p>';
                                    tongTien = strTotal - data['discount'];
                                    htmlVouTotal += ' <p class="ml-auto order_r total_money color_x"><span class="order_r total_money color_x value_sum h_total_fee" >' + tongTien.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',') + '</span> VNĐ</p>';
                                } else if (data['vou_condition'] == 2) {
                                    htmlVou += '<p class="ml-auto order_r tienKM"><span class="h_voucher_fee">' + data['discount'] + '</span> %</p>';
                                    tongTien = strTotal - (strValSum / data['discount']);
                                    htmlVouTotal += ' <p class="ml-auto order_r  total_money color_x"><span class="order_r total_money color_x value_sum h_total_fee" >' + tongTien.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',') + '</span> VNĐ</p>';
                                }
                                $('.tienKM').html(htmlVou);
                                $('.tongTien').html(htmlVouTotal);
                                if (data['id'] != '') {
                                    $('#vou_coupon').html('<input type="hidden" class="idVoucher" value="' + data['id'] + '"/>');
                                } else if (data['id'] == undefined) {
                                    $('#vou_coupon').html('<input type="hidden" class="idVoucher" value=""/>');
                                }
                            }
                        } else {
                            alert(response.message);
                            $('.tienKM').html('<span class="h_voucher_fee">0</span> VNĐ');
                            $('.h_total_fee').html($('.valSum').html());
                        }
                    }
                }
            });
        }


    })
});
