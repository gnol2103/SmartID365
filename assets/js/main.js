$(document).ready(function() {
    var cart = $('.icon_cart');
    var infoCart = $('.cart_top');
    var dltCart = $('.icon_dlt');
    hide_cart(cart, infoCart);
    hide_cart(dltCart, infoCart);

    htmlCart();

    //chỉ cho phép nhập số (0-9)
    (function($) {
        $.fn.inputFilter = function(inputFilter) {
            return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function() {
                if (inputFilter(this.value)) {
                    this.oldValue = this.value;
                    this.oldSelectionStart = this.selectionStart;
                    this.oldSelectionEnd = this.selectionEnd;
                } else if (this.hasOwnProperty("oldValue")) {
                    this.value = this.oldValue;
                    this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
                } else {
                    this.value = "";
                }
            });
        };
    }(jQuery));
    $(".tg_value").inputFilter(function(value) {
        return /^\d*$/.test(value);
    });
});

function hide_cart(btn, infoCart) {
    btn.click(function() {
        if (infoCart.hasClass("show")) {
            infoCart.removeClass("show");
        } else {
            infoCart.addClass("show");
        }
    });
}

$(document).on("change", ".value_amount", function() {
    var elm = $(this);
    var sum_pro = elm.val();
    var id = elm.parent().parent().parent().parent().attr('data-cart-id');
    if (sum_pro === "" || sum_pro === '0') {
        sum_pro = 1;
        elm.val(sum_pro);
    }
    $('.main_cart1[data-cart-id="' + id + '"]').find('.value_amount').val(sum_pro);
    total();
    addProductToCart(elm, parseInt(elm.val()));
});
$(document).on("click", ".btn_down", function() {
    var elm = $(this);
    var tg_value = elm.next();
    var sum_pro = parseInt(tg_value.val());
    var id = elm.parent().parent().parent().parent().attr('data-cart-id');
    if (sum_pro != 1) {
        sum_pro -= 1;
        tg_value.val(sum_pro);
        $('.main_cart1[data-cart-id="' + id + '"]').find('.value_amount').val(sum_pro);
        total();
        addProductToCart(elm, sum_pro);
    }
});
$(document).on("click", ".btn_up", function() {
    var elm = $(this);
    var tg_value = elm.prev();
    var sum_pro = parseInt(tg_value.val());
    var id = elm.parent().parent().parent().parent().attr('data-cart-id');
    sum_pro += 1;
    tg_value.val(sum_pro);
    $('.main_cart1[data-cart-id="' + id + '"]').find('.value_amount').val(sum_pro);
    total();
    addProductToCart(elm, sum_pro);
});

$(document).on("click", ".btn_dlt_pro", function() {
    var id = $(this).parent().attr("data-cart-id");
    $('.main_cart1[data-cart-id="' + id + '"]').remove();
    $.ajax({
        type: 'POST',
        url: "/ProductDetailsController/deleteProductInCart",
        data: {
            id: id
        }
    });
    total();
    if ($('.main_cart').length == 0) {
        $('.no_pro').css('display', 'flex');
        $('.block_cart').html('');
        $('.ctn_cart').remove();
    }
});

function total() {
    var card = $('.main_cart1');
    var total = 0;
    var sum_amount = 0;
    var trans = 0;
    card.each(function() {

        var elm = $(this);
        // var id = elm.attr('data-cart-id');
        var price = elm.find('.price_pro').text().replace(/,/g, "");
        price = parseInt(price);
        var amount = elm.find('.value_amount').val();
        amount = parseInt(amount);
        var count = price * amount;
        var trans = $('.h_trans_fee').text().replace(/,/g, "");
        if (elm.hasClass('main_cart')) {
            totalTT = total + count;
            total = total + count;
            sum_amount = sum_amount + amount;
        }
        elm.find('.total_money').text(numberWithCommas(count));
    });
    if (Object.values(check_coupon).length) {
        console.log(check_coupon.discount);
        if (check_coupon['vou_condition'] == 2) {
            total = total - Number(check_coupon['discount'] / 100) * total;
        } else {
            total = total - Number(check_coupon['discount']);
        }
    }
    total = total + Number(trans);
    $('.value_sum').text(numberWithCommas(totalTT));
    $('.h_total_fee').text(numberWithCommas(total));
    $('.sum_sp').text(sum_amount);
}

function addProductToCart(elm, amount) {
    var elm = elm.parent().parent().parent().parent();
    var id = elm.attr('data-cart-id');
    var name = elm.find('.cart_t1').text();
    var image = elm.find('.img_card').attr('src');
    var price = elm.find('.price_pro').text();
    $.ajax({
        type: 'POST',
        url: "/ProductDetailsController/addProductToCart",
        data: {
            id: id,
            name: name,
            image: image,
            amount: amount,
            price: price,
        }
    });
}

function htmlCart() {
    $.ajax({
        type: 'POST',
        url: "/ProductDetailsController/infoProductInCart",
        dataType: "json",
        success: function(response) {
            check = response.result;
            if (check == true) {
                var cart = response.data;
                if (cart.length > 0) {
                    $('.no_pro').css('display', 'none');
                    $('.block_cart').html(`<div class="block_cart">
                        <div class="scoll_cart">
                        </div>
                        <div class="cart_tong d-flex justify-content-between">
                            <p class="cart_t1">Tổng thanh toán:</p>
                            <p class="cart_t1 color_x"><span class="color_x value_sum">0</span> VNĐ</p> 
                        </div>
                        <div class="cart_tt d-flex align-items-center justify-content-center">
                            <a href="/gio-hang.html" class="color_x cart_gh">Xem giỏ hàng</a>
                            <a href="/gio-hang.html?payment=1" class="btn_x cart_tt1">Thanh toán</a>
                        </div>
                    </div>`);
                }
                var htmlCart = '';
                $.each(cart, function(index, value) {
                    htmlCart += `<div class="main_cart d-flex main_cart1" data-cart-id="` + value.id + `">
                        <button class="btn_t color_d btn_dlt_pro">Xóa</button>
                        <div class="k_card">
                            <img src="` + value.image + `" alt="` + value.name + `" class="img_card" >
                        </div>
                        <div class="ctn_card">
                            <p class="cart_t1">` + value.name + `</p>
                            <p class="cart_t2"><span class="cart_t2 price_pro">` + value.price + `</span> VNĐ</p> 
                            <div class="ctn_card_k1 d-flex justify-content-between align-items-center">
                                <div class="tang_giam">
                                    <button class="tg_tru btn_down">-</button>
                                    <!-- <span class="tg_value">45</span> -->
                                    <input type="text" class="tg_value value_amount" value="` + value.amount + `">
                                    <button class="tg_cong btn_up">+</button>
                                </div>
                                <p class="cart_t3"><span class="cart_t3 total_money"></span> VNĐ</p> 
                            </div>
                        </div>
                    </div>`;
                    // total();
                });
                $('.scoll_cart').html(htmlCart);
                total();
            }
        }
    });
}

//số có dấu phảy
function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

// đăng xuất 
$('.item_logout').click(function() {
    if (confirm('Bạn có muốn đăng xuất?')) {
        window.location.href = '/ManagerController/logout';
    }
})
