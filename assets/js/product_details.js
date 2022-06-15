var image_arr = [];
var file_arr = [];
var uploadimg = $('#uploadimg');

function del_img(e) {
    let parent = $(e).parent();
    let img_index = $(e).data('id');
    parent.remove();
    $.each(image_arr, function(i, value) {
        if (value.index == img_index) {
            image_arr.splice(i, 1);
        }
    });
    if (image_arr.length == 0) {
        uploadimg.val(null)
    }
}

function date_to_dmy(date) {
    const yyyy = date.getFullYear();
    let mm = date.getMonth() + 1; // Months start at 0!
    let dd = date.getDate();

    if (dd < 10) dd = '0' + dd;
    if (mm < 10) mm = '0' + mm;

    date_dmy = dd + ' tháng ' + mm + ' năm ' + yyyy;
    return date_dmy;
}

function get_list_eva() {
    product_id = $('.pro_id').val();
    $.ajax({
        url: '/ProductDetailsController/get_list_evaluate',
        data: {
            product_id: product_id
        },
        type: 'post',
        dataType: 'JSON',
        success: function(response) {
            html = '';
            response.forEach(eva => {
                html += `<div class="dg_user">
				<div class="dg_user_k1 d-flex justify-content-between">
					<div class="dg_user_l">
						<p class="dg_username">${eva['name_eva']}</p>
						<div class="star-rating">
							<div class="back-stars">
								<i class="fa fa-star" aria-hidden="true"></i>
								<i class="fa fa-star" aria-hidden="true"></i>
								<i class="fa fa-star" aria-hidden="true"></i>
								<i class="fa fa-star" aria-hidden="true"></i>
								<i class="fa fa-star" aria-hidden="true"></i>

								<div class="front-stars" style="width: ${Number(eva['star'])/5*100}%">
									<i class="fa fa-star" aria-hidden="true"></i>
									<i class="fa fa-star" aria-hidden="true"></i>
									<i class="fa fa-star" aria-hidden="true"></i>
									<i class="fa fa-star" aria-hidden="true"></i>
									<i class="fa fa-star" aria-hidden="true"></i>
								</div>
							</div>
						</div>
					</div>
					<div class="dg_user_r d-flex">`
                img = eva['image'].split(',');
                img.forEach(img_item => {
                    html += `<div class="k_card">
								<img src="/assets/images/evaluate/${img_item}" alt="Thẻ SmartID365" class="img_card">
							</div>`;
                })
                html += `</div>
				</div>
				<p class="dg_ctn">${eva['content']}</p>
				<p class="dg_time">`;
                created_at = date_to_dmy(new Date(Number(eva['created_at']) * 1000));
                create_before = (new Date().getTime() - (Number(eva['created_at']) * 1000)) / 1000;
                if (create_before > 86400) {
                    html += created_at;
                } else if (create_before / 3600 > 1) {
                    html += Math.floor(create_before / 3600) + ' giờ trước';
                } else if (Math.floor(create_before / 60) > 1) {
                    html += Math.floor(create_before / 60) + ' phút trước';
                } else {
                    html += 'Vừa xong'
                }
                html += `</p>
			</div>`;
            });
            $('.dg_k2_r').html(html);
        }
    });
}


$(document).ready(function() {
    // zoom ảnh 
    $('.dt_img_card').click(function() {
        var img = $(this).attr('src');
        var zoomImg = $('#img_product .img_sp').attr('src', img);
    });
    $('.img_card').click(function() {
        $('#img_product').modal('show');
        var img = $(this).attr('src');
        var zoomImg = $('#img_product .img_sp').attr('src', img);
    });
    var star = $('.hide_star');

    // đánh giá của bạn
    $('#stars li').on('mouseover', function() {
        var onStar = parseInt($(this).data('value'), 10);
        $(this).parent().children('li.star').each(function(e) {
            if (e < onStar) {
                $(this).addClass('hover');
            } else {
                $(this).removeClass('hover');
            }
        });
    }).on('mouseout', function() {
        $(this).parent().children('li.star').each(function(e) {
            $(this).removeClass('hover');
        });
    });
    $('#stars li').on('click', function() {
        var onStar = parseInt($(this).data('value'), 10); // The star currently selected
        var stars = $(this).parent().children('li.star');
        for (i = 0; i < stars.length; i++) {
            $(stars[i]).removeClass('selected');
        }
        for (i = 0; i < onStar; i++) {
            $(stars[i]).addClass('selected');
        }
        star.val(onStar);
        star.next().css("display", "none");
    });
    /* ***************************** */

    //upload_image
    $(".select_img").click(function() {
        // uploadimg.next().css("display", "block");
        uploadimg.click();
    });
    // if(!uploadimg.val()) {
    //     uploadimg.next().css("display", "block");
    // }
    var imagesPreview = function(input, placeToInsertImagePreview) {
        image_arr = [];
        $('.file-img').remove();
        if (input.files) {
            var filesAmount = input.files.length;
            for (let i = 0; i < filesAmount; i++) {
                if (i <= 2) {
                    image_arr[i] = {
                        'index': i,
                        'file': input.files[i]
                    }
                    var reader = new FileReader();
                    reader.onload = function(event) {
                        $($.parseHTML(`<div class="file-img">
                        <img class="img_card" src="` + event.target.result + `">
                        <div class="delete-img"></div>
                        <div class="file_close" onclick="del_img(this)" data-id="` + i + `">+</div></div>`)).appendTo(placeToInsertImagePreview);
                    }
                    reader.readAsDataURL(input.files[i]);
                }
            }
            // uploadimg.next().css("display", "none");
        }
        // else {
        //     uploadimg.next().css("display", "block");
        // }
    };
    uploadimg.on('change', function() {
        imagesPreview(this, 'div.d-show-file');
    });
    var imagesUpload = function(input, placeToInsertImagePreview) {
        if (input.files) {
            var filesAmount = input.files.length;
            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();
                reader.onload = function(event) {
                    $($.parseHTML(`<div class="rep-file-img">
                    <img class="img_card" src="` + event.target.result + `">
                    <div class="delete-img"></div>
                    <div class="file_close" onclick="delete_img(this)">+</div></div>`)).appendTo(placeToInsertImagePreview);
                }
                reader.readAsDataURL(input.files[i]);
            }
        }
    };
    $('#reuploadimg').on('change', function() {
        imagesUpload(this, 'div.d-show-files');
    });
    /* ***************************** */
    function validateImg(element) {
        if ($('#uploadimg').prop('files').length == 0) {
            $('.validate_img').css('color', 'red').text('Chọn ảnh');
            return false
        } else {
            return true
        }
    }
    $.validator.addMethod("validateImage", function(value, element) {
        return this.optional(element) || validateImg(element);
    }, "Họ tên không đúng định dạng!");
    $("#form_evaluate").validate({
        errorPlacement: function(error, element) {
            error.insertAfter(element);
            error.wrap("<div class='err-red'>");
        },
        rules: {
            email: {
                required: true,
                email: true
            },
            display_name: {
                required: true
            },
            star: {
                required: true
            },
            uploadimg: {
                required: true,
                validateImage: true
            },
            evaluate: {
                required: true
            },
        },
        messages: {
            email: {
                required: "Địa chỉ email không được để trống",
                email: "Nhập đúng định dạng email"
            },
            display_name: {
                required: "Tên hiển thị không được để trống"
            },
            star: {
                required: "Chọn đánh giá"
            },
            uploadimg: {
                required: "Chọn ảnh"
            },
            evaluate: {
                required: "Đánh giá không được để trống"
            },
        },

        submitHandler: function(form) {
            // if ($('#uploadimg').prop('files').length == 0) {
            // 	$('.validate_img').css('color', 'red').text('Chọn ảnh');
            // } else {
            // 	$('.validate_img').text('');
            // }
            var formDanhGia = new FormData();
            formDanhGia.append('id', $('.pro_id').val());
            formDanhGia.append('email', $('#email').val());
            formDanhGia.append('name', $('#display_name').val());
            formDanhGia.append('star', $('#star').val());
            var totalfiles = $('#uploadimg').prop('files').length;
            for (var index = 0; index < totalfiles; index++) {
                formDanhGia.append("uploadimg[]", $('#uploadimg').prop('files')[index]);
            }
            formDanhGia.append('evaluate', $('#evaluate').val());
            $.ajax({
                url: '/ProductDetailsController/create_evaluate',
                contentType: false,
                processData: false,
                data: formDanhGia,
                type: 'post',
                dataType: 'JSON',
                success: function(response) {
                    check = response.result;
                    if (check == true) {
                        alert(response.message);
                        form.reset();
                        $('#uploadimg').val('');
                        $('.d-show-file .file-img').remove();
                        $('#stars .star').removeClass('selected');
                        get_list_eva();
                    } else {
                        alert(response.message);
                    }
                }
            });
        }
    });

    var add_pro = $('.btn_cart1');
    var buy_now = $('#buy_now');
    add_pro.click(function() {
        var card_id = add_pro.attr('data-id');
        var amount = parseInt($('.amount').val());
        var name_pro = $('.dt_text1').text();
        var price = $('.price').text();
        var url_img = $('.dt_img_card').attr('src');
        var has_cart = true;
        if ($('.main_cart').length == 0) {
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
        } else {
            $('.main_cart').each(function() {
                var elm = $(this);
                var id = elm.attr('data-cart-id');
                if (card_id == id) {
                    var sl = parseInt(elm.find('.tg_value').val()) + amount;
                    elm.find('.value_amount').val(sl);
                    has_cart = false;
                }
            });
        }
        if (has_cart) {
            $('.scoll_cart').prepend(`<div class="main_cart d-flex main_cart1" data-cart-id="` + card_id + `">
                <button class="btn_t color_d btn_dlt_pro">Xóa</button>
                <div class="k_card">
                    <img src="` + url_img + `" alt="` + name_pro + `" class="img_card" >
                </div>
                <div class="ctn_card">
                    <p class="cart_t1">` + name_pro + `</p>
                    <p class="cart_t2"><span class="cart_t2 price_pro">` + price + `</span> VNĐ</p> 
                    <div class="ctn_card_k1 d-flex justify-content-between align-items-center">
                        <button type="button" class="tang_giam">
                            <span class="tg_tru btn_down">-</span>
                            <!-- <span class="tg_value">45</span> -->
                            <input type="text" class="tg_value value_amount" value="` + amount + `">
                            <span class="tg_cong btn_up">+</span>
                        </button>
                        <p class="cart_t3"><span class="cart_t3 total_money"></span> VNĐ</p> 
                    </div>
                </div>
            </div>`);
        }
        total();
        $.ajax({
            type: 'POST',
            url: "/ProductDetailsController/addProductToCart",
            data: {
                id: card_id,
                name: name_pro,
                image: url_img,
                amount: amount,
                price: price,
                check: true //+ sl sp nếu có trong giỏ hàng
            }
        });
    });

    buy_now.click(function() {
        var card_id = add_pro.attr('data-id');
        var amount = parseInt($('.amount').val());
        var name_pro = $('.dt_text1').text();
        var price = $('.price').text();
        var url_img = $('.dt_img_card').attr('src');
        $.ajax({
            type: 'POST',
            url: "/ProductDetailsController/addProductToCart",
            data: {
                id: card_id,
                name: name_pro,
                image: url_img,
                amount: amount,
                price: price,
                check: true,
            }
        });
    });

    // danh sach san pham lien quan
    var id = $('.pro_id').val();
    var color = $('.color').val();
    $.ajax({
        type: 'POST',
        url: "/ProductDetailsController/involveProduct",
        data: {
            id: id,
            color: color
        },
        dataType: "json",
        success: function(response) {
            var products = response.data;
            var html = '';
            var star = '';
            if (products) {
                $.each(products, function(index, value) {
                    var htmlEvents = '';
                    if (value['amount'] == 0) {
                        htmlEvents = `<p class="sp_sale nen_g">Hết hàng</p>`;
                    } else if (value['hot'] == 1) {
                        htmlEvents = `<p class="sp_sale nen_d">HOT</p>`;
                    } else if (value['type_sale'] != 0) {
                        htmlEvents = `<p class="sp_sale nen_x_l">SALE</p>`;
                    }
                    var htmlpPrice = '';
                    if (value['type_sale'] != 0) {
                        htmlpPrice = '<p class="sp_k4_r">' + value['price'] + ' VNĐ</p>';
                    }
                    var htmlpHide = '';
                    if (index == 3) {
                        htmlpHide = 'sp_none';
                    }
                    if (value['star'].avg != null) {
                        star = parseFloat(value['star'].avg).toFixed(1) / 5 * 100;
                    } else if (value['star'].avg == null) {
                        star = 0;
                    }
                    html += `<div class="detail_sp ` + htmlpHide + `">
                        ` + htmlEvents + `
                        <div class="sp_k1">
                            <a href="/chi-tiet-san-pham-c` + value['id'] + `.html"><img src="/assets/product_image/` + value['image'] + `" alt="Cart" class="cart_white"></a>
                        </div>
                        <div class="sp_main">
                            <a href="/chi-tiet-san-pham-c` + value['id'] + `.html"class="sp_k2 btn_t">` + value['name'] + `</a>
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
            $('.ctn_product').html(html);
        },
    });

    //tăng, giảm sản phẩm
    var tg_value = $('.amount');
    var tg_tru = $('.btn_tru');
    var tg_cong = $('.btn_cong');
    tg_value.change(function() {
        var elm = $(this);
        if (elm.val() === "" || elm.val() === '0') {
            elm.val('1');
        }
    });
    tg_tru.click(function() {
        var elm = $(this);
        var tg_value = elm.next();
        var sum = parseInt(tg_value.val());
        if (sum != 1) {
            sum -= 1;
            tg_value.val(sum);
        }
    });
    tg_cong.click(function() {
        var elm = $(this);
        var tg_value = elm.prev();
        var sum = parseInt(tg_value.val());
        sum += 1;
        tg_value.val(sum);
    });
    // mua hàng
    $('.btn-order').click(function() {

    })

    $id = $('.pro_id').val();
    // $.ajax({
    //     url: '/ProductDetailsController/pagination',
    //     data: { id: id },
    //     type: 'post',
    //     dataType: 'JSON',
    //     success: function (response) {
    //         data = response.data;
    //         check = response.result;
    //         if (check == true) {
    //             $(function () {
    //                 (function (name) {

    //                     var container = $('#pagination-' + name);
    //                     var sources = function () {
    //                         var result = [];

    //                         for (var i = 1; i < 20; i++) {
    //                             result.push(i);
    //                         }

    //                         return result;
    //                     }();

    //                     var options = {
    //                         dataSource: sources,
    //                         pageSize: 2,
    //                         callback: function (response, pagination) {
    //                             window.console && console.log(response, pagination);

    //                             var dataHtml = '';

    //                             $.each(data, function (index, item) {
    //                                 dataHtml += '<div>';

    //                                 dataHtml += '<div class="dg_user">'
    //                                 dataHtml += '<div class="dg_user_k1 d-flex justify-content-between">'
    //                                 dataHtml += '<div class="dg_user_l">'
    //                                 dataHtml += '<p class="dg_username">' + index + '</p>'
    //                                 dataHtml += '<div class="star-rating"></div>';
    //                                 dataHtml += '</div>';

    //                             });

    //                             $('.dg_k2_r').html(dataHtml);
    //                             container.prev().html(dataHtml);
    //                         }
    //                     };

    //                     //$.pagination(container, options);

    //                     container.addHook('beforeInit', function () {
    //                         window.console && console.log('beforeInit...');
    //                     });
    //                     container.pagination(options);

    //                     container.addHook('beforePageOnClick', function () {
    //                         window.console && console.log('beforePageOnClick...');
    //                         //return false
    //                     });
    //                 })('demo1');

    //             })
    //         } else {
    //             alert(response.message);
    //         }
    //     }
    // });


});
//số có dấu phảy
function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function responseMessage(msg) {
    $('.success-box').fadeIn(200);
    $('.success-box div.text-message').html("<span>" + msg + "</span>");
}

function add_product_to_cart() {

}
