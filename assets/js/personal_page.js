var contact = [{
    "image": "/assets/images/sdt.png",
    "title": "Số điện thoại",
    "title1": "Thêm số điện thoại",
    "title2": "Số điện thoại"
}, {
    "image": "/assets/images/email.png",
    "title": "Email",
    "title1": "Thêm tài khoản Email",
    "title2": "Email"
}, {
    "image": "/assets/images/dc.png",
    "title": "Địa chỉ",
    "title1": "Thêm địa chỉ",
    "title2": "Link địa chỉ"
}, {
    "image": "/assets/images/skype.png",
    "title": "Skype",
    "title1": "Thêm tài khoản Skype",
    "title2": "Link Skype"
}, {
    "image": "/assets/images/fb.png",
    "title": "Facebook",
    "title1": "Thêm tài khoản Facebook",
    "title2": "Link Facebook cá nhân"
}, {
    "image": "/assets/images/insta.png",
    "title": "Instagram",
    "title1": "Thêm tài khoản Instagram",
    "title2": "Link Instagram"
}, {
    "image": "/assets/images/twitter.png",
    "title": "Twitter",
    "title1": "Thêm tài khoản Twitter",
    "title2": "Link Twitter"
}, {
    "image": "/assets/images/tiktok.png",
    "title": "Tiktok",
    "title1": "Thêm tài khoản Tiktok",
    "title2": "Link Tiktok"
}, {
    "image": "/assets/images/zalo.png",
    "title": "Zalo",
    "title1": "Thêm tài khoản Zalo",
    "title2": "Nhập số điện thoại đăng ký Zalo"
}, {
    "image": "/assets/images/ytb.png",
    "title": "Youtube",
    "title1": "Thêm tài khoản Youtube",
    "title2": "Link Youtube"
}, {
    "image": "/assets/images/snap.png",
    "title": "Snapchat",
    "title1": "Thêm tài khoản Snapchat",
    "title2": "Link Snapchat"
}, {
    "image": "/assets/images/in.png",
    "title": "LinkedIn",
    "title1": "Thêm tài khoản LinkedIn",
    "title2": "Link LinkedIn"
}, {
    "image": "/assets/images/pin.png",
    "title": "Pinterest",
    "title1": "Thêm tài khoản Pinterest",
    "title2": "Link Pinterest"
}, {
    "image": "/assets/images/be.png",
    "title": "Behance",
    "title1": "Thêm tài khoản Behance",
    "title2": "Link Behance"
}, {
    "image": "/assets/images/momo.png",
    "title": "Ví momo",
    "title1": "Thêm tài khoản Ví momo",
    "title2": "Nhập số điện thoại đăng ký Momo"
}, {
    "image": "/assets/images/pay.png",
    "title": "Paypal",
    "title1": "Thêm tài khoản Paypal",
    "title2": "Link Paypal"
}, {
    "image": "/assets/images/tknh.png",
    "title": "Tài khoản ngân hàng",
    "title1": "Thêm tài khoản ngân hàng"
}, {
    "image": "/assets/images/dd.png",
    "title": "Đường dẫn",
    "title1": "Thêm đường dẫn",
    "title2": "Link đường dẫn"
}];
var bank = ['Agribank', 'BIDV', 'Vietcombank', 'Vietinbank', 'OCB', 'ACB', 'TP Bank', 'Maritime Bank', 'Sacombank', 'DongA Bank', 'Eximbank', 'Nam A Bank', 'Saigon Bank', 'VP Bank', 'Techcombank', 'MB Bank', 'Bac A Bank', 'VIB', 'SeA Bank'];
var data_link = [];
var addCont = [];

function nl2br(str, is_xhtml) {
    if (typeof str === 'undefined' || str === null) {
        return '';
    }
    var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';
    return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
}

function get_list_user_detail() {
    $.ajax({
        url: '/Handles/PersonalPageController/get_list_user_detail',
        data: {},
        type: 'post',
        dataType: "JSON",
        success: function(response) {
            html = '';
            response.forEach(user_detail => {
                html += `<div class="k_ttcn_b u_ttcn" data-id="${user_detail['id']}" >
				<p class="k_block ttcn_t1">${user_detail['title']}</p>
				<p class="k_block ttcn_t2">${user_detail['content']}</p>
				<input type="text" class="k_none ttcn_t1 title" placeholder="Nhập nội dung" value="${user_detail['title']}">
				<input type="text" class="k_none ttcn_t3 content" placeholder="Nhập nội dung" value="${user_detail['content']}">
				<button class="k_none btn_t dlt_k_ttcn"><img src="/assets/images/dlt.svg" alt="Xóa" class="icon_dlt1"></button>
			  </div>`;
            })
            $('#user_detail').html(html);
        }
    });
}

function get_list_contact() {
    $.ajax({
        url: '/Handles/PersonalPageController/get_list_contact',
        data: {},
        type: 'post',
        dataType: "JSON",
        success: function(response) {
            html = '';
            html2 = '';
            response.forEach(item => {
                subtitleView = item['subtitle'];
                checkLink = '';
                if (item['type'] == 0) {
                    checkLink = "tel:";
                } else if (item['type'] == 1) {
                    checkLink = "mailto:";
                } else if (item['type'] == 8) {
                    checkLink = "http://zalo.me/";
                } else if (item['type'] == 14) {
                    checkLink = "nhantien.momo.vn/";
                } else if (item['type'] == 16) {
                    checkLink = "javascript:void(0)";
                    subtitleView = bank[id_lh];
                }
                html += `<div class="k_tab1 d-flex align-items-center justify-content-between contact" data-type="${item['type']}" data-id="${item['id']}">
				<div type="button" class="btn_none menu_tt"><img src="/assets/images/menu1.svg" alt="Menu" class="icon_menu1"></div>
				<a class='k_link' target='_blank' href="${checkLink+item['content']}">
				<div class="k_ttlh_l d-flex align-items-center">
								<div class="text_box">
				<img src="${contact[item['type']]['image']}" alt="${contact[item['type']]['title']}" class="icon_ttlh">
				<div class="ttlh">
					<p class="t_tdc">${contact[item['type']]['title']}</p>
					<p class="t_nd">${subtitleView}</p>
					<p class="t_st none">${item['subtitle']}</p>
					<p class="t_ct none">${item['content']}</p>
				</div>
										</div>
										<img src="/assets/images/mt.svg" alt="Mũi tên" class="k_block icon_mt ' . $popupBank . '">
				</div>
						</a>
				<div class="btn_hide k_none btn_cn">
				<button class="btn_none edit_ttcn"><img src="/assets/images/edit_2.svg" alt="Chỉnh sửa" class="icon_edit_2"></button>
				<button class="btn_none dlt_ttcn btn_dlt2"><img src="/assets/images/dlt.svg" alt="Xóa" class="icon_delCont"></button>
				</div>
				</div>`;


                html2 += `<div class="k_tab2" data-type="${item['type']}" data-id="${item['id']}">
				<div class="ttlh1" >
				<a class='k_link1' target='_blank' href="${checkLink+item['content']}">
				<img src="${contact[item['type']]['image']}" alt="${contact[item['type']]['title']}" class="icon_ttlh1">
				<p class="t_tdc">${contact[item['type']]['title']}</p>
				<p class="t_nd2 none">${subtitleView}</p>
				<p class="t_ct2 none">${item['content']}</p>
				</a>
				<button class="k_none btn_edit3"><img src="/assets/images/edit_3.svg" alt="Chỉnh sửa" class="icon_edit"></button>
				<button class="k_none btn_dlt1"><img src="/assets/images/dlt.svg" alt="Chỉnh sửa" class="icon_edit"></button>
				</div>
				</div>`;

            })
            html += `<button type="button" class="btn_none k_none tab1_add add1 " data-toggle="modal" data-target="#modal_add_contact">+</button>
			<button type="button" class="btn_none k_block tab1_add k_info1 ">Thêm thông tin</button>`;
            html2 += `<div class="k_tab2 k_tab2_n">
			<button type="button" class="btn_none tab2_add" data-toggle="modal" data-target="#modal_add_contact">+</button>
			</div>
			<div class="k_block k_info2">
				  <button type="button" class="btn_none tab2_add">+</button>
				  <p class="t_tdc">Thêm thông tin</p>
			</div>`
            $('#infor-1').html(html);
            $('.ctn_tab2').html(html2);
            if (response.length > 0) {
                $('.btn_edit_info').removeClass('none');
                $('#infor-1 .k_info1').addClass('none');
            } else {
                $('.btn_edit_info').addClass('none');
                $('#infor-1 .k_info1').removeClass('none');
            }
        }
    });
}
$(document).ready(function() {

    $('.back').click(function() {
        $('#modal_edit_link').modal('hide');
        $('#modal_info_bank').modal('hide');
    })

    var k_username = $('.k_username');
    var ctn_page = $('.ctn_page');
    //chỉnh sửa tên
    $('.edit_name').click(function() {
        k_username.addClass('edit_username');
    });
    //hủy lưu tên
    $('.cn_h').click(function() {
        k_username.removeClass('edit_username');
        $('#user_name').val($('.user_name1').text());
    });
    //lưu tên
    $('.cn_l').click(function() {
        $('.user_name1').text($('#user_name').val());
        var username = $('#user_name').val();
        $.ajax({
            type: 'POST',
            url: "/Handles/PersonalPageController/edit_user_name",
            data: {
                user_name: username,
                check: true
            },
            success: function(data) {
                // alert("Thêm được rồi nhé");
            },
        });
        k_username.removeClass('edit_username');
    });
    //nút chỉnh sửa thông tin(thêm css vào ctn_page để hiển thị các nút chỉnh sửa, xóa thông tin liên hệ)
    $('.btn_edit_info').click(function() {
        ctn_page.addClass('edit_info');
    });
    // $('.btn_huy').click(function () {
    //     ctn_page.removeClass('edit_info');
    // });
    $(document).on('click', '.k_info1', function() {
        ctn_page.addClass('edit_info');
    });
    $(document).on('click', '.k_info2', function() {
        ctn_page.addClass('edit_info');
    });
    $('.btn_hb').click(function() {
        // location.reload();
        $('#modal_cancel').modal('show');
    });

    $('#modal_cancel .btn_x').click(function() {
        ctn_page.removeClass('edit_info');
        addCont = [];
        UpCont = [];
        delIdCont = [];
        addTTCN = [];
        upTTCN = [];
        delIdTTCN = [];
        get_list_contact();
        get_list_user_detail();
        $('#modal_cancel').modal('hide');
    })



    $.each(contact, function(index, value) {
        //chia từ 1-4 thông tin liên hệ, 3-14: mạng xã hội, 9-17: tài chính (để append html theo bên views đã chia)
        var khoi = $('.ctn_k');
        if (index < 4) {
            khoi = $('.ctn_ttlh');
        } else if (index > 3 && index < 14) {
            khoi = $('.ctn_mxh');
        } else if (index > 13 && index < 17) {
            khoi = $('.ctn_tc');
        }
        //append html theo view
        khoi.append(`<div class="k_tlh_t d-flex align-items-center">
            <img src="` + value.image + `" alt="` + value.title + `" class="icon_tlh">
            <p class="text_tlh1">` + value.title + `</p>
            <button type="button" class="btn_t ml-auto btn_tlh" data-id="` + index + `">+</button>
          </div>`);
    });
    var id_lh = 0;
    //nut thêm liên hệ trong popup thêm liên hệ
    $('.btn_tlh').click(function() {
        var elm = $(this);
        var id = elm.attr('data-id'); //lấy id của loại liên hệ để thêm vào base
        id_lh = id; //
        var image = contact[id].image; //lấy ảnh liên hệ
        var title = contact[id].title; //tiêu đề liên hệ (vd momo...)
        var title1 = contact[id].title1; //tiêu đề phụ (vd thêm sđt, thêm tài khoản ngân hàng...)
        var title2 = contact[id].title2; //tiêu đề thanh nhập nội dung
        $('#modal_add_contact').modal('hide'); //ẩn modal chọn loại thông tin
        $('#modal_add_link').modal('show'); //hiện modal nhập thông tin
        $('.icon_ttlh2').attr('src', image); //ảnh liên hệ(vd: logo momo...)
        var htmlAdd = '';
        if (id == 16) { //thêm tài khoản ngân hàng
            var option = '';
            $.each(bank, function(index, value) {
                option += '<option value=' + index + '>' + value + '</option>';
            });
            htmlAdd = `<div class="k_td d-flex" data-id="` + id + `">
                    <img src="` + image + `" alt="` + title + `" class="icon_ttlh2" >
                    <div class="add_tknh">
                    <div class="mb_20">
                    <select class="select_bank subtitleCont">
                    <option value=''>Chọn ngân hàng</option>
                        ` + option + `
                    </select>
                    <p id="validate1_error" class="error_vld"></p>
                    </div>
                    <input type="text" class="text_td4 contentCont" placeholder="Số tài khoản"> 
                    <p id="validate2_error" class="error_vld"></p>
                    </div>
                </div>`;
        } else { //thêm các loại liên hệ khác
            var text = '';
            if (id == 0) { text = 'text_td5'; }
            htmlAdd = `<div class="k_td d-flex" data-id="` + id + `">
                    <img src="` + image + `" alt="` + title + `" class="icon_ttlh2" >
                    <div class="k_td_r">
                        <input type="text" class="text_td1 " value="` + title + `" readonly> 
                        <input type="text"  class="text_td2 subtitleCont" placeholder="Tiêu đề phụ (chỉ hiển thị ở dạng xem danh sách)"> 
                        <p id="validate1_error" class="error_vld"></p>
                    </div>
                </div>
                <input type="text" class="text_td3 contentCont ` + text + `" placeholder="` + title2 + `">
                <p id="validate2_error" class="error_vld"></p> `;
            if (id == 8) { text = 'text_td5'; }
            htmlAdd = `<div class="k_td d-flex" data-id="` + id + `">
                    <img src="` + image + `" alt="` + title + `" class="icon_ttlh2">
                    <div class="k_td_r">
                        <input type="text" class="text_td1 " value="` + title + `" readonly> 
                        <input type="text" class="text_td2 subtitleCont" placeholder="Tiêu đề phụ (chỉ hiển thị ở dạng xem danh sách)"> 
                        <p id="validate1_error" class="error_vld"></p>
                    </div>
                </div>
                <input type="text" class="text_td3 contentCont ` + text + `" placeholder="` + title2 + `">
                <p id="validate2_error" class="error_vld"></p> `;
            if (id == 14) { text = 'text_td5'; }
            htmlAdd = `<div class="k_td d-flex" data-id="` + id + `">
                    <img src="` + image + `" alt="` + title + `" class="icon_ttlh2">
                    <div class="k_td_r">
                        <input type="text" class="text_td1 " value="` + title + `" readonly> 
                        <input type="text" id="" class="text_td2 subtitleCont" placeholder="Tiêu đề phụ (chỉ hiển thị ở dạng xem danh sách)"> 
                        <p id="validate1_error" class="error_vld"></p>
                    </div>
                </div>
                <input type="text" class="text_td3 contentCont ` + text + `" placeholder="` + title2 + `">
                <p id="validate2_error" class="error_vld"></p> `;
        }

        $('#modal_add_link .modal-body').html(htmlAdd);
        $('#modal_add_link .modal-title').text(title1);
        $('.select_bank').select2({
            width: "100%",
            placeholder: "Chọn ngân hàng",
        });
    });

    //nút lưu, hiển thị thông tin
    $('#modal_add_link .btn_luu').click(function() {
        var flag = true;
        var subtitle = $('.subtitleCont').val();
        var content = $('.contentCont').val();


        var validate1 = $('#validate1_error');
        var validate2 = $('#validate2_error');
        var image = contact[id_lh].image;
        var title = contact[id_lh].title;
        var title1 = contact[id_lh].title1;
        var title2 = contact[id_lh].title2;
        if (id_lh == 16) {
            var text_td2 = $('.select_bank').val();
            var text_td3 = $.trim($('.text_td4').val());
            var tdp = bank[text_td2];
            var tdp4 = text_td3;
            if (text_td2 == '') {
                validate1.text('Chọn ngân hàng');
                flag = false;
            } else {
                validate1.text('');
            }
            if (text_td3 == '') {
                validate2.text('Không được để trống');
                flag = false;
            } else {
                validate2.text('');
                addCont.push([id_lh, $('.select_bank').val(), content]);
            }
            change_input($('.select_bank'), validate1);
            change_input($('.text_td4'), validate2);
        } else {
            var text_td2 = $.trim($('#modal_add_link .text_td2').val()); //tiêu đề phụ
            var text_td3 = $.trim($('#modal_add_link .text_td3').val()); //nội dung
            var tdp = text_td2;
            var tdp2 = text_td3

            if (id_lh == 1) {
                if (text_td3 == '') {
                    validate2.text('Email không được để trống');
                    flag = false;
                } else if (!isEmail(text_td3)) {
                    validate2.text('Nhập đúng định dạng email');
                    flag = false;
                } else {
                    validate2.text('');
                    addCont.push([id_lh, subtitle, content]);
                }
            } else if (id_lh == 0) {
                if (text_td3 == '') {
                    validate2.text('Số điện thoại không được để trống');
                    flag = false;
                } else if (!isPhone(text_td3)) {
                    validate2.text('Nhập đúng định dạng số điện thoại');
                    flag = false;
                } else {
                    validate2.text('');
                    addCont.push([id_lh, subtitle, content]);
                }
            } else if (id_lh == 8) {
                if (text_td3 == '') {
                    validate2.text('Số điện thoại không được để trống');
                    flag = false;
                } else if (!isPhone(text_td3)) {
                    validate2.text('Nhập đúng định dạng số điện thoại');
                    flag = false;
                } else {
                    addCont.push([id_lh, subtitle, content]);
                    validate2.text('');
                }
            } else if (id_lh == 14) {
                if (text_td3 == '') {
                    validate2.text('Số điện thoại không được để trống');
                    flag = false;
                } else if (!isPhone(text_td3)) {
                    validate2.text('Nhập đúng định dạng số điện thoại');
                    flag = false;
                } else {
                    validate2.text('');
                    addCont.push([id_lh, subtitle, content]);
                }
            } else {

                if (text_td3 == '') {
                    validate2.text('Không được để trống');
                    flag = false;
                } else {
                    validate2.text('');
                    addCont.push([id_lh, subtitle, content]);
                }
            }
            change_input($('.text_td2'), validate1);
            change_input($('.text_td3'), validate2);
        }

        if (flag) {
            $('#modal_add_link').modal('hide');
            var data_id = data_link.length;
            var data_add_id = addCont.length - 1;
            subtitleView = subtitle
            checkLink = '';
            if (id_lh == 0) {
                checkLink = "tel:";
            } else if (id_lh == 1) {
                checkLink = "mailto:";
            } else if (id_lh == 8) {
                checkLink = "http://zalo.me/";
            } else if (id_lh == 14) {
                checkLink = "nhantien.momo.vn/";
            } else if (id_lh == 16) {
                checkLink = "javascript:void(0)";
                subtitleView = bank[id_lh];
            }
            html = '';
            html += `<div class="k_tab1 d-flex align-items-center justify-content-between contact" data-type="${id_lh}" data-add-id="${data_add_id}">
			<div type="button" class="btn_none menu_tt"><img src="/assets/images/menu1.svg" alt="Menu" class="icon_menu1"></div>
			<a class='k_link' target='_blank' href="${checkLink+content}">
			<div class="k_ttlh_l d-flex align-items-center">
							<div class="text_box">
			<img src="${image}" alt="${title}" class="icon_ttlh">
			<div class="ttlh">
				<p class="t_tdc">${title}</p>
				<p class="t_nd">${subtitleView}</p>
				<p class="t_st none">${subtitle}</p>
				<p class="t_ct none">${content}</p>
			</div>
									</div>
									<img src="/assets/images/mt.svg" alt="Mũi tên" class="k_block icon_mt ' . $popupBank . '">
			</div>
					</a>
			<div class="btn_hide k_none btn_cn">
			<button class="btn_none edit_ttcn"><img src="/assets/images/edit_2.svg" alt="Chỉnh sửa" class="icon_edit_2"></button>
			<button class="btn_none dlt_ttcn btn_dlt2"><img src="/assets/images/dlt.svg" alt="Xóa" class="icon_delCont"></button>
			</div>
			</div>`;
            $(html).insertBefore('.add1');

            html2 = '';
            html2 += `<div class="k_tab2" data-type="${id_lh}" data-add-id="${data_add_id}">
			<div class="ttlh1" >
			<a class='k_link1' target='_blank' href="${checkLink+content}">
			<img src="${image}" alt="${title}" class="icon_ttlh1">
			<p class="t_tdc">${title}</p>
			<p class="t_nd2 none">${subtitleView}</p>
			<p class="t_ct2 none">${content}</p>
			</a>
			<button class="k_none btn_edit3"><img src="/assets/images/edit_3.svg" alt="Chỉnh sửa" class="icon_edit"></button>
			<button class="k_none btn_dlt1"><img src="/assets/images/dlt.svg" alt="Chỉnh sửa" class="icon_edit"></button>
			</div>
			</div>`;
            $(html2).insertBefore('.k_tab2_n');
            // data_link.push({
            //     "link_id": id_lh,
            //     "image": image,
            //     "title": title,
            //     "title1": title1,
            //     "title2": title2,
            //     "text_td2": text_td2,
            //     "text_td3": text_td3
            // });
        }
    });


    //upload_image

    function uploadImg(uploadimg, select, img) {
        select.click(function() {
            uploadimg.click();
        });
        // uploadimg.on('change', function(event) {
        //     var x = URL.createObjectURL(event.target.files[0]);
        //     img.attr('src', x);
        // });
    }


    var upload_avata = $('.upload_avata');
    var select_avata = $('.select_avata');
    var img_avata = $('.img_avata');
    var upload_bia = $('.upload_bia');
    var select_bia = $('.select_bia');
    var icon_bia = $('.icon_bia');

    uploadImg(upload_avata, select_avata, img_avata);
    uploadImg(upload_bia, select_bia, icon_bia);

    $('.add_ttcn').click(function() {
        $('#user_detail').append(`<div class="k_ttcn_b inp_add_ttcn">
            <input type="text" class="k_none ttcn_t1 ttcn_t3 title_prof"  placeholder="Nhập tiêu đề"> 
            <input type="text" class="k_none ttcn_t3 content_prof" placeholder="Nhập nội dung"> 
            <button class="k_none btn_t dlt_k_ttcn"><img src="/assets/images/dlt.svg" alt="Xóa" class="icon_dlt1"></button>
        </div>`);
    });
    //chinh sua lien he
    edit_link(bank);

    // cập nhật ảnh đại diện, ảnh bìa
    const change_avata = document.querySelector('#update_avatar');
    const change_cover = document.querySelector('#upload_bia');
    const validImageTypes = ['image/gif', 'image/jpeg', 'image/png'];

    change_avata.addEventListener('change', function(e) {
        const files = e.target.files
        const file = files[0]
        const fileType = file['type']
        const filesize = 8388608
        if (!validImageTypes.includes(fileType)) {
            alert('Ảnh không đúng định dạng')
            return
        }
        if (file.size > filesize) {
            alert('Kích cỡ ảnh quá lớn!')
            document.getElementById('change_avata').value = '';
            return
        }
        var file_data = $('#update_avatar').prop('files')[0];
        var form_data = new FormData();
        form_data.append('avata', file_data);

        $.ajax({
            url: '/Handles/PersonalPageController/upload_avata',
            dataType: 'text',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function() {
                alert('Cập nhật ảnh thành công!')
                const fileReader = new FileReader()
                fileReader.readAsDataURL(file)
                fileReader.onload = function() {
                    const url = fileReader.result;
                    document.getElementById('avata_img').setAttribute('src', url);

                }
            }
        });

    })

    change_cover.addEventListener('change', function(e) {
            const files = e.target.files
            const file = files[0]
            const fileType = file['type']
            const filesize = 8388608
            if (!validImageTypes.includes(fileType)) {
                alert('Ảnh không đúng định dạng')
                return
            }
            if (file.size > filesize) {
                alert('Kích cỡ ảnh quá lớn!')
                document.getElementById('change_avata').value = '';
                return
            }
            var file_data = $('#upload_bia').prop('files')[0];
            var formData = new FormData();
            formData.append('cover', file_data);

            $.ajax({
                url: '/Handles/PersonalPageController/upload_cover',
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                type: 'post',
                success: function() {
                    alert('Cập nhật ảnh bìa thành công!')
                    const fileReader = new FileReader()
                    fileReader.readAsDataURL(file)
                    fileReader.onload = function() {
                        const url = fileReader.result;
                        document.getElementById('cover_img').setAttribute('src', url);
                    }
                }
            });

        })
        // Hết cập nhật ảnh đại diện, ảnh bìa

    $('.btn_ltd').click(function() {
        $('#modal_save').modal('show');
    });
    ////liên kết thẻ
    $('.btn-the').click(function() {
        var the = $('.the-val').val();
        $.ajax({
            url: '/Handles/PersonalPageController/the',
            dataType: 'text',
            data: { the: the },
            type: 'post',
            dataType: "JSON",
            success: function(response) {
                if (response.result == true) {
                    alert(response.message)
                } else {
                    alert(response.message)
                }
            }
        });
        location.reload();

    });



    // Lưu thay đổi
    $('#modal_save .btn_luu').click(function() {
        // chỉnh sửa thông tin cá nhân
        var date = new Date($('#date_birth').val());
        var day = date.getDate();
        var month = date.getMonth() + 1;
        var year = date.getFullYear();
        datebirthVal = [day, month, year].join('/');
        $('.full_name').text($('#full_name').val());
        $('.date_birth').text(datebirthVal);
        $('.company').text($('#company').val());
        $('.position').text($('#position').val());
        $('.descrip').html(nl2br($('#descrip').val()));

        var fullname = $('#full_name').val();
        var datebirth = $('#date_birth').val();
        var company = $('#company').val();
        var position = $('#position').val();
        var descrip = $('#descrip').val();
        var flagTTCN = true;

        sort_contact();

        $.ajax({
            type: 'POST',
            url: "/Handles/PersonalPageController/edit_personal_page",
            data: {
                full_name: fullname,
                date_birth: datebirth,
                company: company,
                position: position,
                descrip: descrip,
            },
            success: function() {},
        });
        ctn_page.removeClass('edit_info');
        if ($('.k_tab1').length > 0) {
            $('.k_info1').css('display', 'none');
            $('.k_info2').css('display', 'none');
        }

        // thêm thông tin cá nhân   
        var addUserDetailData = new FormData();
        user_detail = [];
        $('.inp_add_ttcn').each(function() {
            add_error = false;
            if ($(this).find('.content_prof').val() != '' && $(this).find('.title_prof').val() == '') {
                add_error = true;
            } else if ($(this).find('.content_prof').val() == '' && $(this).find('.title_prof').val() != '') {
                add_error = true;
            }
            if (add_error) {
                alert('Bạn phải điền đầy đủ thông tin cá nhân');
                $('.ctn_page').addClass('edit_info')
                $('#modal_save').modal('hide');
            } else {
                if ($(this).find('.content_prof').val() != '' && $(this).find('.title_prof').val() != '') {
                    row = {
                        title: $(this).find('.title_prof').val(),
                        content: $(this).find('.content_prof').val()
                    }
                    user_detail.push(row);
                }
            }
        });
        addUserDetailData.append('user_detail', JSON.stringify(user_detail));
        if (addUserDetailData != '') {
            $.ajax({
                type: 'POST',
                url: "/Handles/PersonalPageController/create_user_details",
                data: addUserDetailData,
                processData: false,
                contentType: false,
                dataType: "JSON",
                success: function() {
                    addUserDetailData.delete('user_detail');
                }
            });
        }

        // update user details
        var updateUserDetailData = new FormData();
        user_detail = [];
        $('.u_ttcn').each(function() {
            row = {};
            row['id'] = $(this).data("id");
            row['title'] = $(this).find('.title').val();
            row['content'] = $(this).find('.content').val();
            user_detail.push(row);
            updateUserDetailData.append('user_detail', JSON.stringify(user_detail));
        });
        // $('.title').each(function() {
        //     title.push($(this).val());
        // });
        // $('.content').each(function() {
        //     content.push($(this).val());
        // });
        $.ajax({
            type: 'POST',
            url: "/Handles/PersonalPageController/update_user_details",
            data: updateUserDetailData,
            processData: false,
            contentType: false,
        });

        //update thứ tự liên hệ


        // thêm thông tin liên hệ
        var addTTCN = new FormData();
        addTTCN.append('addCont', JSON.stringify(addCont));
        $.ajax({
            type: 'POST',
            url: "/Handles/PersonalPageController/create_contact",
            data: addTTCN,
            processData: false,
            contentType: false,
            async: !1,
            success: function() {
                addTTCN.delete('addCont');
                addCont.splice(0, addCont.length);
            }
        });

        // update thông tin liên hệ
        var upTTCN = new FormData();
        if (UpCont != '') {
            upTTCN.append('upCont', JSON.stringify(UpCont));
        } else if (UpBank != '') {
            upTTCN.append('upBank', JSON.stringify(UpBank));
        }

        $.ajax({
            type: 'POST',
            url: "/Handles/PersonalPageController/update_contact",
            data: upTTCN,
            processData: false,
            contentType: false,
            async: !1,
            success: function() {
                upTTCN.delete('addCont');
                UpCont = [];
            }
        });

        // xoá thông tin cá nhân
        $.ajax({
            type: "POST",
            url: "/Handles/PersonalPageController/delete_user_details",
            data: {
                id: delIdTTCN,
            },
            success: function() {
                delIdTTCN = [];
            }
        });
        // xoá thông tin liên hệ
        $.ajax({
            type: "POST",
            url: "/Handles/PersonalPageController/delete_contact",
            async: !1,
            data: {
                id: delIdCont,
            },
            success: function() {
                delIdCont = [];
            }
        });


        // location.reload();
        $('#modal_save').modal('hide');
        //đổ lại dữ liệu cho thông tin cá nhân
        get_list_user_detail();
        //đổ lại dữ liệu danh sách liên hệ
        get_list_contact();

    });

});
var delIdTTCN = [];
var delIdCont = [];
var UpCont = [];
var UpBank = [];

function edit_link(bank) {
    var id = 0;
    // var id = 8;
    // var id = 14;
    var link_id = 0;
    $(document).on("click", ".btn_edit3", function() {
        $('#modal_edit_link').modal('show');
        var elm = $(this);
        id = elm.parent().parent().attr('data-type');
        data_id = elm.parent().parent().attr('data-id');
        link_id = id;
        $('#modal_edit_link').attr('data-type', link_id);
        var image = contact[id].image;
        var title = contact[id].title;
        var title2 = contact[id].title2;
        if (elm.parent().parent().attr('data-add-id')) {
            add_id = elm.parent().parent().attr('data-add-id');
            dataElm = $('.contact[data-add-id="' + add_id + '"]');
            $('#modal_edit_link').attr('data-add-id', add_id);
        } else {
            data_id = elm.parent().parent().attr('data-id');
            dataElm = $('.contact[data-id="' + data_id + '"]');
            $('#modal_edit_link').attr('data-id', data_id);
        }
        var text_td2 = dataElm.find('.t_st').html();
        var text_td3 = dataElm.find('.t_ct').html();
        var htmlAdd = '';
        var option = '';
        if (link_id == 16) {
            $.each(bank, function(index, value) {
                var selectedBank = '';
                if (text_td2 == index) {
                    selectedBank = 'selected';
                }
                option += '<option value=' + index + ' ' + selectedBank + '>' + value + '</option>';
            });
            htmlAdd = ` < div class = "k_td d-flex" >
                                            <
                                            img src = "` + image + `"
                                        alt = "` + title + `"
                                        class = "icon_ttlh2" >
                                            <
                                            div class = "add_tknh" >
                                            <
                                            div class = "mb_20" >
                                            <
                                            select class = "select_bank" >
                                            <
                                            option value = '' > Chọn ngân hàng < /option>
                                        ` + option + ` <
                                        /select> <
                                        p id = "validate1_error"
                                        class = "error_vld" > < /p> < /
                                        div > <
                                            input type = "text"
                                        class = "text_td4"
                                        placeholder = "Số tài khoản"
                                        value = "` + text_td3 + `" >
                                            <
                                            p id = "validate2_error"
                                        class = "error_vld" > < /p> < /
                                        div > <
                                            /div>`;
        } else {
            var text = '';
            if (id == 0) { text = 'text_td5'; }
            htmlAdd = `<div class="k_td d-flex">
                    <img src="` + image + `" alt="` + title + `" class="icon_ttlh2">
                    <div class="k_td_r">
                        <input type="text" class="text_td1 " value="` + title + `" readonly> 
                        <input type="text" class="text_td2 subtitleCont" placeholder="Tiêu đề phụ (chỉ hiển thị ở dạng xem danh sách)" value="` + text_td2 + `"> 
                        <p id="validate1_error" class="error_vld"></p>
                    </div>
                </div>
                <input type="text" class="text_td3 contentCont ` + text + `" placeholder="` + title2 + `" value="` + text_td3 + `">
                <p id="validate2_error" class="error_vld"></p> `;
            if (id == 8) { text = 'text_td5'; }
            htmlAdd = `<div class="k_td d-flex">
                    <img src="` + image + `" alt="` + title + `" class="icon_ttlh2">
                    <div class="k_td_r">
                        <input type="text" class="text_td1 " value="` + title + `" readonly> 
                        <input type="text" class="text_td2 subtitleCont" placeholder="Tiêu đề phụ (chỉ hiển thị ở dạng xem danh sách)" value="` + text_td2 + `"> 
                        <p id="validate1_error" class="error_vld"></p>
                    </div>
                </div>
                <input type="text" class="text_td3 contentCont ` + text + `" placeholder="` + title2 + `" value="` + text_td3 + `">
                <p id="validate2_error" class="error_vld"></p> `;
            if (id == 14) { text = 'text_td5'; }
            htmlAdd = `<div class="k_td d-flex">
                    <img src="` + image + `" alt="` + title + `" class="icon_ttlh2">
                    <div class="k_td_r">
                        <input type="text" class="text_td1 " value="` + title + `" readonly> 
                        <input type="text" class="text_td2 subtitleCont" placeholder="Tiêu đề phụ (chỉ hiển thị ở dạng xem danh sách)" value="` + text_td2 + `"> 
                        <p id="validate1_error" class="error_vld"></p>
                    </div>
                </div>
                <input type="text" class="text_td3 contentCont ` + text + `" placeholder="` + title2 + `" value="` + text_td3 + `">
                <p id="validate2_error" class="error_vld"></p> `;
        }
        $('#modal_edit_link .modal-body').html(htmlAdd);
        $('.select_bank').select2({
            width: "100%",
            placeholder: "Chọn ngân hàng",
        });
    });
    $(document).on("click", ".edit_ttcn", function() {
        $('#modal_edit_link').modal('show');
        var formIndexCont = new FormData();
        var elm = $(this);
        var idIndexCont = [];
        idCont = elm.parent().parent().attr('data-id');
        add_id = elm.parent().parent().attr('data-add-id');
        subtitle = elm.parent().parent();
        // link_id = idCont;
        idIndexCont.push(idCont);
        formIndexCont.append('id', idIndexCont);

        // đổ dữ liệu thông tin liên hệ
        data_id = elm.parent().parent().attr('data-id');
        // id = elm.parent().parent().attr('data-link-id');
        link_id = elm.parent().parent().attr('data-type');
        var image = contact[link_id].image;
        var title = contact[link_id].title;
        var title2 = contact[link_id].title2;
        var text_td2 = elm.parent().parent().find('.t_st').html();
        var text_td3 = elm.parent().parent().find('.t_ct').html();
        var htmlAdd = '';
        var option = '';
        if (link_id == 16) {
            $.each(bank, function(index, value) {
                var selectedBank = '';
                if (text_td2 == index) {
                    selectedBank = 'selected';
                }
                option += '<option value=' + index + ' ' + selectedBank + '>' + value + '</option>';
            });
            htmlAdd = `<div class="k_td d-flex">
                    <img src="` + image + `" alt="` + title + `" class="icon_ttlh2">
                    <div class="add_tknh">
                    <div class="mb_20">
                    <select class="select_bank">
                    <option value=''>Chọn ngân hàng</option>
                        ` + option + `
                    </select>
                    <p id="validate1_error" class="error_vld"></p>
                    </div>
                    <input type="text" class="text_td4" placeholder="Số tài khoản" value="` + text_td3 + `"> 
                    <p id="validate2_error" class="error_vld"></p>
                    </div>
                </div>`;
        } else {
            var text = '';
            if (link_id == 0) { text = 'text_td5'; }
            htmlAdd = `<div class="k_td d-flex">
                    <img src="` + image + `" alt="` + title + `" class="icon_ttlh2">
                    <div class="k_td_r">
                        <input type="text" class="text_td1 " value="` + title + `" readonly> 
                        <input type="text" class="text_td2 subtitleCont" placeholder="Tiêu đề phụ (chỉ hiển thị ở dạng xem danh sách)" value="` + text_td2 + `"> 
                        <p id="validate1_error" class="error_vld"></p>
                    </div>
                </div>
                <input type="text" class="text_td3 contentCont ` + text + `" placeholder="` + title2 + `" value="` + text_td3 + `">
                <p id="validate2_error" class="error_vld"></p> `;
            if (link_id == 8) { text = 'text_td5'; }
            htmlAdd = `<div class="k_td d-flex">
                    <img src="` + image + `" alt="` + title + `" class="icon_ttlh2">
                    <div class="k_td_r">
                        <input type="text" class="text_td1 " value="` + title + `" readonly> 
                        <input type="text" class="text_td2 subtitleCont" placeholder="Tiêu đề phụ (chỉ hiển thị ở dạng xem danh sách)" value="` + text_td2 + `"> 
                        <p id="validate1_error" class="error_vld"></p>
                    </div>
                </div>
                <input type="text" class="text_td3 contentCont ` + text + `" placeholder="` + title2 + `" value="` + text_td3 + `">
                <p id="validate2_error" class="error_vld"></p> `;
            if (link_id == 14) { text = 'text_td5'; }
            htmlAdd = `<div class="k_td d-flex">
                    <img src="` + image + `" alt="` + title + `" class="icon_ttlh2">
                    <div class="k_td_r">
                        <input type="text" class="text_td1 " value="` + title + `" readonly> 
                        <input type="text" class="text_td2 subtitleCont" placeholder="Tiêu đề phụ (chỉ hiển thị ở dạng xem danh sách)" value="` + text_td2 + `"> 
                        <p id="validate1_error" class="error_vld"></p>
                    </div>
                </div>
                <input type="text" class="text_td3 contentCont ` + text + `" placeholder="` + title2 + `" value="` + text_td3 + `">
                <p id="validate2_error" class="error_vld"></p> `;
        }
        $('#modal_edit_link').attr('data-id', data_id);
        $('#modal_edit_link').attr('data-type', link_id);
        $('#modal_edit_link').attr('data-add-id', add_id);
        $('#modal_edit_link .modal-body').html(htmlAdd);
        $('.select_bank').select2({
            width: "100%",
            placeholder: "Chọn ngân hàng",
        });
    });

    $('#modal_edit_link .btn_luu').click(function() {
        var flag = true;
        var validate1 = $('#validate1_error');
        var validate2 = $('#validate2_error');
        link_id = $('#modal_edit_link').attr('data-type');
        if (link_id == 16) {
            var text_td2 = $('#modal_edit_link .select_bank').val().trim();
            var text_td3 = $.trim($('#modal_edit_link .text_td4').val());

            tdp1 = text_td2;
            tdp2 = text_td3;
            if (text_td2 == '') {
                validate1.text('Chọn ngân hàng');
                flag = false;
            } else {
                validate1.text('');
            }
            if (text_td3 == '') {
                validate2.text('Không được để trống');
                flag = false;
            } else {
                validate2.text('');
            }
            change_input($('.select_bank'), validate1);
            change_input($('.text_td4'), validate2);
        } else if (link_id != 16) {
            var text_td3 = $.trim($('#modal_edit_link .text_td3').val());
            var text_td2 = $.trim($('#modal_edit_link .text_td2 ').val());
            tdp3 = text_td2;
            tdp4 = text_td3;
            if (link_id == 1) {
                if (text_td3 == '') {
                    validate2.text('Email không được để trống');
                    flag = false;
                } else if (!isEmail(text_td3)) {
                    validate2.text('Nhập đúng định dạng email');
                    flag = false;
                } else {
                    validate2.text('');
                }
            }
            if (link_id == 0) {
                if (text_td3 == '') {
                    validate2.text('Số điện thoại không được để trống');
                    flag = false;
                } else if (!isPhone(text_td3)) {
                    validate2.text('Nhập đúng định dạng số điện thoại');
                    flag = false;
                } else {
                    validate2.text('');
                }
            }
            if (link_id == 8) {
                if (text_td3 == '') {
                    validate2.text('Số điện thoại không được để trống');
                    flag = false;
                } else if (!isPhone(text_td3)) {
                    validate2.text('Nhập đúng định dạng số điện thoại');
                    flag = false;
                } else {
                    validate2.text('');
                }
            }
            if (link_id == 14) {
                if (text_td3 == '') {
                    validate2.text('Số điện thoại không được để trống');
                    flag = false;
                } else if (!isPhone(text_td3)) {
                    validate2.text('Nhập đúng định dạng số điện thoại');
                    flag = false;
                } else {
                    validate2.text('');
                }
            }

            if (text_td3 == '') {
                validate2.text('Không được để trống');
                flag = false;
            } else {
                validate1.text('');
            }
            change_input($('.text_td2'), validate1);
            change_input($('.text_td3'), validate2);
        }
        if (flag) {
            var link = '';
            $('#modal_edit_link').modal('hide');

            if ($('[data-link-id="' + id + '"]') == 0) {
                link = 'tel:';
            } else if ($('[data-link-id="' + id + '"]') == 1) {
                link = 'mailto:'
            } else if ($('[data-link-id="' + id + '"]') == 8) {
                link = 'zalo.me/:'
            } else if ($('[data-link-id="' + id + '"]') == 14) {
                link = 'nhantien.momo.vn/'
            } else if ($('[data-link-id="' + id + '"]') == 16) {
                link = 'javascript:void(0)'
            }
            checkLink = '';
            subtitle = text_td2;
            if (link_id == 0) {
                checkLink = "tel:";
            } else if (link_id == 1) {
                checkLink = "mailto:";
            } else if (link_id == 8) {
                checkLink = "http://zalo.me/";
            } else if (link_id == 14) {
                checkLink = "nhantien.momo.vn/";
            } else if (link_id == 16) {
                checkLink = "javascript:void(0)";
                subtitle = bank[link_id];
            }
            html = '';
            html += `<div type="button" class="btn_none menu_tt"><img src="/assets/images/menu1.svg" alt="Menu" class="icon_menu1"></div>
			<a class='k_link' target='_blank' href="${checkLink+text_td3}">
			<div class="k_ttlh_l d-flex align-items-center">
							<div class="text_box">
			<img src="${contact[link_id]['image']}" alt="${contact[link_id]['title']}" class="icon_ttlh">
			<div class="ttlh">
				<p class="t_tdc">${contact[link_id]['title']}</p>
				<p class="t_nd">${subtitle}</p>
				<p class="t_st none">${text_td2}</p>
				<p class="t_ct none">${text_td3}</p>
			</div>
									</div>
									<img src="/assets/images/mt.svg" alt="Mũi tên" class="k_block icon_mt ' . $popupBank . '">
			</div>
					</a>
			<div class="btn_hide k_none btn_cn">
			<button class="btn_none edit_ttcn"><img src="/assets/images/edit_2.svg" alt="Chỉnh sửa" class="icon_edit_2"></button>
			<button class="btn_none dlt_ttcn btn_dlt2"><img src="/assets/images/dlt.svg" alt="Xóa" class="icon_delCont"></button>
			</div>`;
            if ($('#modal_edit_link').attr('data-add-id')) {
                add_id = parseInt($('#modal_edit_link').attr('data-add-id'));
                addCont[add_id] = [link_id, text_td2, text_td3];
                $('.contact[data-add-id="' + add_id + '"]').html(html);
            } else {
                data_id = $('#modal_edit_link').attr('data-id');
                UpCont.push([data_id, link_id, text_td2, text_td3]); //lưu thông tin cá nhân chỉnh sửa vào mảng
                $('.contact[data-id="' + data_id + '"]').html(html);
            }
        }
    })

}

function change_input(value, text) {
    value.change(function() {
        if ($(this).val() != '') {
            text.text("");
        }
    });
}

function validateNumber(elm) {
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
    elm.inputFilter(function(value) {
        return /^\d*$/.test(value);
    });
}
$(document).on("click", ".text_td4", function() {
    validateNumber($('.text_td4'));
});
$(document).on("click", ".text_td5", function() {
    validateNumber($('.text_td5'));
});


$(document).on("click", ".bankPopup", function() {
    $('#modal_info_bank').modal('show');
    idCont = $(this).find('.contact').attr('data-id');
    // đổ dữ liệu thông tin liên hệ
    var htmlPop = '';
    htmlPop += '<div class="ctn_info_b">';
    htmlPop += '<img src="/assets/images/tknh.png" alt="Tài khoản ngân hàng" class="icon_ttlh2">';
    // bank[data.subtitle]
    htmlPop += '<p class="text_tknh1">' + $('.tab-pane [data-id="' + idCont + '"]').find('.t_nd').text() + '</p>';
    htmlPop += '<p class="text_tknh2">' + $('.tab-pane [data-id="' + idCont + '"]').find('.t_ct').text() + '</p>';
    htmlPop += '</div>';
    $('#modal_info_bank .modal-body').html(htmlPop);


});
$(document).on("click", ".bankPopup2", function() {
    $('#modal_info_bank').modal('show');
    idCont = $(this).parent().parent().attr('data-id');
    // đổ dữ liệu thông tin liên hệ
    var htmlPop = '';
    htmlPop += '<div class="ctn_info_b">';
    htmlPop += '<img src="/assets/images/tknh.png" alt="Tài khoản ngân hàng" class="icon_ttlh2">';
    // bank[data.subtitle]
    htmlPop += '<p class="text_tknh1">' + $('.ctn_tab2 [data-id="' + idCont + '"]').find('.t_nd2').text() + '</p>';
    htmlPop += '<p class="text_tknh2">' + $('.ctn_tab2 [data-id="' + idCont + '"]').find('.t_ct2').text() + '</p>';
    htmlPop += '</div>';
    $('#modal_info_bank .modal-body').html(htmlPop);
});
// nút xoá user details
$(document).on("click", ".dlt_k_ttcn", function() {
    let text = "Bạn có đồng ý xoá thông tin này không ?";
    if (confirm(text) == true) {
        $(this).parent().remove();
        var id = $(this).parent().data('id');
        if (id) { delIdTTCN.push(id) }
    }
})

// xóa thông tin liên hệ
$(document).on("click", ".btn_dlt2", function() {
    if (confirm('Bạn có đồng ý xoá thông tin này không ?') == true) {
        if ($(this).parent().parent().attr('data-add-id')) {
            add_id = $(this).parent().parent().attr('data-add-id');
            addCont.splice(add_id, 1);
            $('.k_tab2[data-add-id="' + add_id + '"]').remove();
        } else {
            var id = $(this).parent().parent().attr('data-id');
            delIdCont.push(id);
            $('.k_tab2[data-id="' + id + '"]').remove();
        }
        $(this).parent().parent().remove();
    }
});

$(document).on("click", ".btn_dlt1", function() {
    if (confirm('Bạn có đồng ý xoá thông tin này không ?') == true) {
        if ($(this).parent().parent().attr('data-add-id')) {
            add_id = $(this).parent().parent().attr('data-add-id');
            addCont.splice(add_id, 1);
            $('.contact[data-add-id="' + add_id + '"]').remove();
        } else {
            var id = $(this).parent().parent().attr('data-id');
            delIdCont.push(id);
            $('.contact[data-id="' + id + '"]').remove();
        }
        $(this).parent().parent().remove();
    }
});

function isPhone(r) {
    return /^(84|0[3|5|7|8|9])+([0-9]{8})+$/.test(r);
}

function isEmail(emailStr) {
    var emailPat = /^(.+)@(.+)$/
    var specialChars = "\\(\\)<>@,;:\\\\\\\"\\.\\[\\]"
    var validChars = "\[^\\s" + specialChars + "\]"
    var quotedUser = "(\"[^\"]*\")"
    var ipDomainPat = /^\[(\d{1,3})\.(\d{1,3})\.(\d{1,3})\.(\d{1,3})\]$/
    var atom = validChars + '+'
    var word = "(" + atom + "|" + quotedUser + ")"
    var userPat = new RegExp("^" + word + "(\\." + word + ")*$")
    var domainPat = new RegExp("^" + atom + "(\\." + atom + ")*$")
    var matchArray = emailStr.match(emailPat)
    if (matchArray == null) {
        return false
    }
    var user = matchArray[1]
    var domain = matchArray[2]

    // See if "user" is valid
    if (user.match(userPat) == null) {
        return false
    }
    var IPArray = domain.match(ipDomainPat)
    if (IPArray != null) {
        // this is an IP address
        for (var i = 1; i <= 4; i++) {
            if (IPArray[i] > 255) {
                return false
            }
        }
        return true
    }
    var domainArray = domain.match(domainPat)
    if (domainArray == null) {
        return false
    }

    var atomPat = new RegExp(atom, "g")
    var domArr = domain.match(atomPat)
    var len = domArr.length

    if (domArr[domArr.length - 1].length < 2 ||
        domArr[domArr.length - 1].length > 3) {
        return false
    }

    if (len < 2) {
        return false
    }

    return true;
}

$('#search_contact').keyup(function() {
    // alert($(this).val());
    key_word = $(this).val();
    ttlh = '';
    mxh = '';
    tc = '';
    k = '';
    for (i = 0; i < contact.length; i++) {
        if (contact[i]['title'].toLocaleLowerCase().includes(key_word.toLocaleLowerCase())) {
            if (i < 4) {
                ttlh += `<div class="k_tlh_t d-flex align-items-center">
				<img src="${contact[i]['image']}" alt="${contact[i]['title']}" class="icon_tlh">
				<p class="text_tlh1">${contact[i]['title']}</p>
				<button type="button" class="btn_t ml-auto btn_tlh" data-id="${i}">+</button>
			  </div>`
            }
            if (i > 3 && i < 14) {
                mxh += `<div class="k_tlh_t d-flex align-items-center">
				<img src="${contact[i]['image']}" alt="${contact[i]['title']}" class="icon_tlh">
				<p class="text_tlh1">${contact[i]['title']}</p>
				<button type="button" class="btn_t ml-auto btn_tlh" data-id="${i}">+</button>
			  </div>`
            }
            if (i > 13 && i < 17) {
                tc += `<div class="k_tlh_t d-flex align-items-center">
				<img src="${contact[i]['image']}" alt="${contact[i]['title']}" class="icon_tlh">
				<p class="text_tlh1">${contact[i]['title']}</p>
				<button type="button" class="btn_t ml-auto btn_tlh" data-id="${i}">+</button>
			  </div>`
            }

            if (i == 17) {
                k += `<div class="k_tlh_t d-flex align-items-center">
				<img src="${contact[i]['image']}" alt="${contact[i]['title']}" class="icon_tlh">
				<p class="text_tlh1">${contact[i]['title']}</p>
				<button type="button" class="btn_t ml-auto btn_tlh" data-id="${i}">+</button>
			  </div>`
            }
        }
    }
    $('.modal_add_contact .ctn_ttlh').html(ttlh);
    $('.modal_add_contact .ctn_mxh').html(mxh);
    $('.modal_add_contact .ctn_tc').html(tc);
    $('.modal_add_contact .ctn_k').html(k);

})