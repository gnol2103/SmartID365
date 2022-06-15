var page = 1;

function get_product() {
    $.ajax({
        url: "/ProductController/infoProduct",
        type: "GET",
        data: {
            page: page,
        },
        dataType: "json",
        success: function(response) {
            var products = response.data;
            var html = '';
            var star = '';
            if (products) {
                $.each(products, function(index, value) {
                    htmlEvents = '';
                    if (value['amount'] == 0) {
                        htmlEvents = `<p class="sp_sale nen_g">Hết hàng</p>`;
                    } else if (value['hot'] == 1) {
                        htmlEvents = `<p class="sp_sale nen_d">HOT</p>`;
                    } else if (value['type_sale'] != 0) {
                        htmlEvents = `<p class="sp_sale nen_x_l">SALE</p>`;
                    }
                    var show_class = 'detail_sp';
                    // if (index > 5) {
                    //     show_class = 'detail_sp hide_pro';
                    // }
                    var htmlpPrice = '';
                    if (value['type_sale'] != 0) {
                        htmlpPrice = '<p class="sp_k4_r">' + value['price'] + ' VNĐ</p>';
                    }
                    if (value['star'].avg != null) {
                        star = parseFloat(value['star'].avg).toFixed(1) / 5 * 100;
                    } else if (value['star'].avg == null) {
                        star = 0;
                    }
                    html += `<div class="` + show_class + `">
                        ` + htmlEvents + `
                        <div class="sp_k1">
                        <a href="` + value['url'] + `"><img src="/assets/product_image/` + value['image'] + `" alt="Cart" class="cart_white"></a>
                        </div>
                        <div class="sp_main">
                            <a href="` + value['url'] + `" class="sp_k2 btn_t">` + value['name'] + `</a>
                            <div class="sp_k3">
                                <div class="star-rating">
                                    <div class="back-stars">
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        
                                        <div class="front-stars" style="width: ` + star + `%">
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>    
                            </div>
                            <div class="sp_k4 d-flex">
                                <p class="sp_k4_l">` + value['price_product'] + ` VNĐ</p>
                                ` + htmlpPrice + `
                            </div>
                        </div>
                    </div>`;
                });
            }
            $('.ctn_product').append(html);
            if (response.end) {
                $('.sp_them').css('display', 'none');
            }
        },
    });
    page++;
    if ($('.detail_sp') == 0) {
        $('.sp_them').css('display', 'none');
    }
}
$(document).ready(function() {
    get_product();
    $('.sp_them').click(function() {
        get_product();
    });
});