$(document).ready(function() {
    var k_sale = $('.k_sale');
    $('.type_sale').change(function(){
        var elm = $(this);
        if(elm.val()==0) {
            k_sale.addClass('hidden');
            k_sale.removeClass('show_flex');
        } else {
            k_sale.removeClass('hidden');
            k_sale.addClass('show_flex');
        }
    });

    var add_image = $('#image');
    $('.btn_choose_img').click(function(){
        add_image.click();
    });
    add_image.change(function(event){
        var file = URL.createObjectURL(event.target.files[0]);
        $('.show_img').html(`<img src="`+file+`" class="img_product">`);
    });
    
    $('#form_add_product').submit(function(e){
        e.preventDefault();
        var name        = $.trim($('#name').val());
        var color       = $.trim($('#color').val());
        var amount      = $.trim($('#amount').val());
        var price       = $.trim($('#price').val());
        var type_sale   = $.trim($('#type_sale').val());
        var sale        = $.trim($('#sale').val());
        // var hot         = $.trim($('#hot').val());
        var image       = $.trim($('#image').val());
        var introduce   = $.trim($('#introduce').val());
        var description   = $.trim($('#description').val());
        var flag = true;
        if (name == ''){
            $('.name_error').text('Tên đăng nhập không được để trống');
            flag = false;
        } else{
            $('.name_error').text('');
        }
        if (color == ''){
            $('.color_error').text('Chọn màu sắc');
            flag = false;
        } else{
            $('.color_error').text('');
        }
        if (amount == ''){
            $('.amount_error').text('Số lượng không được để trống');
            flag = false;
        } else{
            $('.amount_error').text('');
        }
        if (price == ''){
            $('.price_error').text('Giá không được để trống');
            flag = false;
        } else{
            $('.price_error').text('');
        }
        if(type_sale !== '0') {
            if (sale == ''){
                $('.sale_error').text('Không được để trống');
                flag = false;
            } else{
                $('.sale_error').text('');
            }
        }
        if (image == ''){
            $('.image_error').text('Chọn ảnh');
            flag = false;
        } else{
            $('.image_error').text('');
        }
        if (introduce == ''){
            $('.introduce_error').text('Giới thiệu không được để trống');
            flag = false;
        } else{
            $('.introduce_error').text('');
        }
        if (description == ''){
            $('.description_error').text('Mô tả không được để trống');
            flag = false;
        } else{
            $('.description_error').text('');
        }
        if (flag) {
            $.ajax({
                url: "/Admin/Handles/Product/add_product",
                type: "POST",
                data: new FormData(this),
                processData: false,
                contentType: false,
                cache: false,
                async: false,
                dataType: "json",
                success: function(response) {
                    check = response.result;
                    alert(response.message);
                    if (check == true) {
                        window.location.href = '/admin/product';
                    } 
                },
            });
        }
    });
    

});