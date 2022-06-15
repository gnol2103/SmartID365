function sort_contact() {
    arr_id = [];
    order = 0;
    $('.k_tab1').each(function() {
        if ($(this).attr('data-id')) {
            item_sort = [$(this).attr('data-id'), order];
            arr_id.push(item_sort);
            order++;
        }
        if ($(this).attr('data-add-id')) {
            add_id = $(this).attr('data-add-id');
            addCont[add_id].push(order);
            order++;
        }
    })
    $.ajax({
        type: 'POST',
        url: "/Handles/PersonalPageController/sort_contact",
        data: {
            arr_id: JSON.stringify(arr_id)
        },
        success: function() {}
    })
}

$("#infor-1").sortable({
    items: "div.k_tab1",
    axis: "y",
    placeholder: "k_tab1_placeholder",
    out: function() {
        sort_contact();
        dump_minimalist_contact();
    }
});
// $("#infor-1").disableSelection();

$(".ctn_tab2").sortable({
    placeholder: "k_tab2",
    item: "div:not(.k_tab2_n)",
    scroll: false,
    out: function() {
        sort_contact();
        dump_list_contact();
    }
});
// $(".ctn_tab2").disableSelection();

function dump_list_contact() {
    list_contact = [];
    $('.k_tab2').each(function() {
        if ($(this).attr('data-type')) {
            if ($(this).attr('data-id')) {
                data_id = $(this).attr('data-id');
                data_new = 0;
                data_elm = $('.contact[data-id="' + data_id + '"]');
            }
            if ($(this).attr('data-add-id')) {
                data_id = $(this).attr('data-add-id');
                data_new = 1;
                data_elm = $('.contact[data-add-id="' + data_id + '"]');
            }
            data_type = $(this).attr('data-type');
            subtitle = data_elm.find('.t_st').html();
            subtitleView = data_elm.find('.t_nd').html();
            content = data_elm.find('.t_ct').html();
            link = data_elm.find('.k_link').attr('href');
            list_contact.push({
                link: link,
                data_id: data_id,
                data_new: data_new,
                data_type: data_type,
                subtitle: subtitle,
                subtitleView: subtitleView,
                content: content
            });
        }
    });
    html = '';
    list_contact.forEach(item => {
        $('.k_tab1').remove();
        if (item.data_new == 0) {
            html += `<div class="k_tab1 d-flex align-items-center justify-content-between contact" data-type="${item.data_type}" data-id="${item.data_id}">
			<div type="button" class="btn_none menu_tt"><img src="/assets/images/menu1.svg" alt="Menu" class="icon_menu1"></div>
			<a class='k_link' target='_blank' href="${link}">
			<div class="k_ttlh_l d-flex align-items-center">
							<div class="text_box">
			<img src="${contact[item.data_type].image}" alt="${contact[item.data_type].title}" class="icon_ttlh">
			<div class="ttlh">
				<p class="t_tdc">${contact[item.data_type].title}</p>
				<p class="t_nd">${item.subtitleView}</p>
				<p class="t_st none">${item.subtitle}</p>
				<p class="t_ct none">${item.content}</p>
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
        } else {
            html += `<div class="k_tab1 d-flex align-items-center justify-content-between contact" data-type="${item.data_type}" data-add-id="${item.data_id}">
			<button type="button" class="btn_none menu_tt"><img src="/assets/images/menu1.svg" alt="Menu" class="icon_menu1"></button>
			<a class='k_link' target='_blank' href="${link}">
			<div class="k_ttlh_l d-flex align-items-center">
							<div class="text_box">
			<img src="${contact[item.data_type].image}" alt="${contact[item.data_type].title}" class="icon_ttlh">
			<div class="ttlh">
				<p class="t_tdc">${contact[item.data_type].title}</p>
				<p class="t_nd">${item.subtitleView}</p>
				<p class="t_st none">${item.subtitle}</p>
				<p class="t_ct none">${item.content}</p>
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
        }
    });
    html += `<button type="button" class="btn_none k_none tab1_add add1 " data-toggle="modal" data-target="#modal_add_contact">+</button>
			<button type="button" class="btn_none k_block tab1_add k_info1 ">Thêm thông tin</button>`;
    $('#infor-1').html(html);
}

function dump_minimalist_contact() {
    list_contact = [];
    $('.k_tab1').each(function() {
        if ($(this).attr('data-type')) {
            if ($(this).attr('data-id')) {
                data_id = $(this).attr('data-id');
                data_new = 0;
            }
            if ($(this).attr('data-add-id')) {
                data_id = $(this).attr('data-add-id');
                data_new = 1;
            }
            data_type = $(this).attr('data-type');
            subtitle = $(this).find('.t_st').html();
            subtitleView = $(this).find('.t_nd').html();
            content = $(this).find('.t_ct').html();
            link = $(this).find('.k_link').attr('href');
            list_contact.push({
                link: link,
                data_id: data_id,
                data_new: data_new,
                data_type: data_type,
                subtitle: subtitle,
                subtitleView: subtitleView,
                content: content
            });
        }
        html = '';
        list_contact.forEach(item => {
            html += `<div class="k_tab2" data-type="${item.data_type}" data-id="${item.data_id}">
				<div class="ttlh1" >
				<a class='k_link1' target='_blank' href="${item.link}">
				<img src="${contact[item.data_type].image}" alt="${contact[item.data_type].title}" class="icon_ttlh1">
				<p class="t_tdc">${contact[item.data_type].title}</p>
				<p class="t_nd2 none">${item.subtitleView}</p>
				<p class="t_ct2 none">${item.content}</p>
				</a>
				<button class="k_none btn_edit3"><img src="/assets/images/edit_3.svg" alt="Chỉnh sửa" class="icon_edit"></button>
				<button class="k_none btn_dlt1"><img src="/assets/images/dlt.svg" alt="Chỉnh sửa" class="icon_edit"></button>
				</div>
				</div>`;
        })
        html += `<div class="k_tab2 k_tab2_n">
			<button type="button" class="btn_none tab2_add" data-toggle="modal" data-target="#modal_add_contact">+</button>
			</div>
			<div class="k_block k_info2">
				  <button type="button" class="btn_none tab2_add">+</button>
				  <p class="t_tdc">Thêm thông tin</p>
			</div>`;
        $('.ctn_tab2').html(html);
    });
}