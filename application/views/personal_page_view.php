<div class="personal_page">
  <div class="cover_image">
    <img src="/assets/cover_user//<?= ($prof->cover != '') ? "$prof->cover" : "bia.png" ?>" alt="Ảnh bìa"  class="icon_bia">
    <!-- <button class="select_bia"><img src="/assets/images/edit.svg" alt="Chỉnh sửa" class="icon_edit"></button> -->
    <input type="file" class="hidden upload_bia" accept=".png, .jpg, .jpeg" id="upload_bia">
    <div class="k_absolute">
      <div class="k_bia">
			<div class="img_frame">
        <img src="/assets/avata_user/<?= ($prof->avatar != '') ? "$prof->avatar" : "user.png" ?>" alt="Ảnh đại diện" class="img_avata" id="avata_img">
				</div>
        <!-- <button class="select_avata"><img src="/assets/images/edit.svg" alt="Chỉnh sửa" class="icon_edit"></button> -->
        <input type="file" class="hidden upload_avata" name="avata" accept=".png, .jpg, .jpeg" id="update_avatar">
      </div>
    </div>
    <!-- <div class="k_username res_none">
            <div class="user_name1">Pengu cụt cánh</div>
            <input type="text" class="user_name" value="Pengu cụt cánh">
            <button class="btn_none edit_name"></button>
            <div class="cn_username">
                <button type="button" class="color_d btn_none cn_h">Huỷ</button>
                <button type="button" class="color_x btn_none cn_l">Lưu</button>
            </div>
        </div> -->
    <!-- <button class="ml-auto btn_lk res_none" data-toggle="modal" data-target="#modal_link">Liên kết thẻ mới</button> -->
  </div>
  <div class="ctn_page">
    <div class="k_username">
      <div class="user_name1"><?= $prof->user_name ?></div>
      <input type="text" class="user_name" id="user_name" value="<?= $prof->user_name ?>">
      <!-- <button class="btn_none edit_name"></button> -->
      <div class="cn_username">
        <button type="button" class="color_d btn_none cn_h">Huỷ</button>
        <button type="button" class="color_x btn_none cn_l">Lưu</button>
      </div>
    </div>
    
    <div class="tcn_l">
      <button class="btn_x btn_ltt">Lưu thông tin</button>
      <div class="k_ttcn">
        <p class="ttcn_title">Thông tin cá nhân</p>
        <div class="ctn_ttcn">
          <div class="k_ttcn_b">
            <p class="ttcn_t1">Họ tên</p>
            <p class="k_block ttcn_t2 full_name"><?= $prof->full_name ?> </p>
            <input type="text" class="k_none ttcn_t3" placeholder="Nhập nội dung" id="full_name" value="<?= $prof->full_name ?>">
          </div>
          <div class="k_ttcn_b">
            <p class="ttcn_t1">Ngày sinh</p>
            <p class="k_block ttcn_t2 date_birth"><?= $prof->date_birth != 0 ?  date('d/m/Y', $prof->date_birth) : "" ?> </p>
            <input type="date" class="k_none ttcn_t3" id="date_birth" value="<?= date('Y-m-d', $prof->date_birth); ?>">
          </div>
          <div class="k_ttcn_b">
            <p class="ttcn_t1">Công ty</p>
            <p class="k_block ttcn_t2 company"><?= $prof->company ?></p>
            <input type="text" class="k_none ttcn_t3" id="company" placeholder="Nhập nội dung" value="<?= $prof->company ?>">
          </div>
          <div class="k_ttcn_b">
            <p class="ttcn_t1">Chức vụ</p>
            <p class="k_block ttcn_t2 position"><?= $prof->position ?> </p>
            <input type="text" class="k_none ttcn_t3" placeholder="Nhập nội dung" id="position" value="<?= $prof->position ?>">
          </div>

          <?php
          foreach ($details as $items) {
            $title = explode(',', $items['title']);
            $content = explode(',', $items['content']);

            foreach (array_combine($title, $content) as $tit => $ct) {
              echo '<div class="k_ttcn_b u_ttcn" data-id="' . $items['id'] . '" >
                <p class="k_block ttcn_t1">' . $tit . '</p>
                <p class="k_block ttcn_t2">' . $ct . '</p>
                <input type="text" class="k_none ttcn_t1 title" placeholder="Nhập nội dung" value="' . $tit . '">
                <input type="text" class="k_none ttcn_t3 content" placeholder="Nhập nội dung" value="' . $ct . '">
                <button class="k_none btn_t dlt_k_ttcn" onclick="delUserDetails()"><img src="/assets/images/dlt.svg" alt="Xóa" class="icon_dlt1"></button>
              </div>';
            }
          }
          ?>
          <!-- <div class="k_ttcn_b">
                        <input type="text" class="k_none ttcn_t1 ttcn_t3" placeholder="Nhập tiêu đề"> 
                        <input type="text" class="k_none ttcn_t3" placeholder="Nhập nội dung"> 
                        <button class="k_none btn_t dlt_k_ttcn"><img src="/assets/images/dlt.svg" alt="Xóa" class="icon_dlt1"></button>
                    </div> -->
        </div>
        <button type="button" class="k_none btn_none add_ttcn">+</button>
      </div>
      <div class="k_mt">
        <p class="ttcn_title">Mô tả</p>
        <p class="k_block text_mt descrip"><?= $prof->descrip ?></p>
        <div class="k_none k_text_mt">
          <textarea class="textarea_mt" rows="7" id="descrip"><?= $prof->descrip ?></textarea>
        </div>
      </div>
    </div>
    <div class="tcn_r">
      <ul class="nav nav_tcn">
        <li class="nav-item">
          <a class="nav-link nav_tab1 active" id="personal-infor-tab1" data-toggle="pill" href="#infor-1" role="tab" aria-controls="infor-1" aria-selected="true"></a>
        </li>
        <li class="nav-item">
          <a class="nav-link nav_tab2" id="personal-infor-tab2" data-toggle="pill" href="#infor-2" role="tab" aria-controls="infor-2" aria-selected="false"></a>
        </li>
        <!-- <button class="ml-auto btn_x k_block btn_edit_info res_none">Chỉnh sửa thông tin</button> -->
      </ul>
      <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active dt_descrip" id="infor-1" role="tabpanel" aria-labelledby="personal-infor-tab1">
          <!-- <a href="<?php
                        if ($type == 0) {
                          echo "tel:";
                        } else if ($type == 1) {
                          echo "mailto:";
                        } else if ($type == 8) {
                          echo "zalo.me/";
                        } else if ($type == 14) {
                          echo "nhantien.momo.vn/";
                        } ?>"></a> -->
          <?php
          foreach ($contact as $item) {
            $img = $contacts[$item['type']]['image'];
            $title = $contacts[$item['type']]['title'];
            $type = $item['type'];
            $checkLink = '';
            $checkBank = '';
            $linkBank = '';
            //check link
            if ($type == 0) {
              $checkLink =  "tel:";
            } else if ($type == 1) {
              $checkLink = "mailto:";
            } else if ($type == 8) {
              $checkLink = "zalo.me/";
            } else if ($type == 14) {
              $checkLink = "nhantien.momo.vn/";
            }else if($type == 16){
              $checkLink = "javascript:void(0)";
            }
            // tên ngân hàng
            if ($type == 16) {
              $checkBank = $bank[$item['subtitle']];
              $linkBank = '<a href="' . $checkLink . '" class="k_link bankPopup">';
            } else if($type != 16) {
              $checkBank = $item['subtitle'];
              $linkBank = '<a href="' . $checkLink . '' . $item['content'] . '" class="k_link" target="_blank">';
            }
            echo '<div class="k_tab1 d-flex align-items-center justify-content-between contact" data-id="' . $item['id'] . '" data-link-id="' . $item['type'] . '">
                <div class="k_ttlh_l d-flex align-items-center">
                    <button type="button" class="btn_none menu_tt"><img src="/assets/images/menu1.svg" alt="Menu" class="icon_menu1"></button>
                        '. $linkBank .'
                        <img src="' . $img . '" alt="' . $title . '" class="icon_ttlh">
                        <div class="ttlh">
                            <p class="t_tdc">' . $title . '</p>
                            <p class="t_nd">' . $checkBank . '</p>
                        </div>
                    </a>
                </div>
                <div class="btn_hide k_none btn_cn">
                      <button class="btn_none edit_ttcn"><img src="/assets/images/edit_2.svg" alt="Chỉnh sửa" class="icon_edit_2"></button>
                      <button class="btn_none dlt_ttcn btn_dlt2" onclick="delContact()"><img src="/assets/images/dlt.svg" alt="Xóa" class="icon_delCont"></button>
                  </div>
                </div>';
          }
          ?>

          <button type="button" class="btn_none k_none tab1_add add1" data-toggle="modal" data-target="#modal_add_contact">+</button>
          <!-- <button type="button" class="btn_none k_block tab1_add k_info1 ">Thêm thông tin</button> -->
        </div>
        <div class="tab-pane fade dt_evaluate" id="infor-2" role="tabpanel" aria-labelledby="personal-infor-tab2">
          <div class="ctn_tab2">
            <?php
            foreach ($contact as $item) {
              $img = $contacts[$item['type']]['image'];
            $title = $contacts[$item['type']]['title'];
            $type = $item['type'];
            $checkLink = '';
            $checkBank = '';
            $linkBank = '';
            //check link
            if ($type == 0) {
              $checkLink =  "tel:";
            } else if ($type == 1) {
              $checkLink = "mailto:";
            } else if ($type == 8) {
              $checkLink = "zalo.me/";
            } else if ($type == 14) {
              $checkLink = "nhantien.momo.vn/";
            }else if($type == 16){
              $checkLink = "javascript:void(0)";
            }
            // tên ngân hàng
            if ($type == 16) {
              $checkBank = $bank[$item['subtitle']];
            } else {
              $checkBank = $item['subtitle'];
            }
            if($type == 16){
              $linkBank = '<a href="' . $checkLink . '" class="k_link1 bankPopup" >';
            }else{
              $linkBank = '<a href="' . $checkLink . '' . $item['content'] . '" class="k_link1" target="_blank">';
            }
              echo '<div class="k_tab2" data-id="' . $item['id'] . '" >
              <div class="ttlh1" >
                '. $linkBank.'
                  <img src="' . $img . '" alt="' . $title . '" class="icon_ttlh1">
                  <p class="t_tdc">' . $title . '</p>
                </a>
                <button class="k_none btn_edit3"><img src="/assets/images/edit_3.svg" alt="Chỉnh sửa" class="icon_edit"></button>
                <button class="k_none btn_dlt1"><img src="/assets/images/dlt.svg" alt="Chỉnh sửa" class="icon_edit"></button>
              </div>
            </div>';
            }
            ?>
            <!-- <div class="k_tab2">
                            <div class="ttlh1">
                                <a href="tel:0388493160" class="k_link1" target="_blank">
                                    <img src="/assets/images/fb.png" alt="Facebook" class="icon_ttlh1">
                                    <p class="t_tdc">Facebook</p>
                                </a>
                                <button class="k_none btn_edit3"><img src="/assets/images/edit_3.svg" alt="Chỉnh sửa" class="icon_edit"></button>
                                <button class="k_none btn_dlt1"><img src="/assets/images/dlt.svg" alt="Chỉnh sửa" class="icon_edit"></button>
                            </div>
                        </div>
                        <div class="k_tab2">
                            <div class="ttlh1">
                                <a href="tel:0388493160" class="k_link1" target="_blank">
                                    <img src="/assets/images/tknh.png" alt="Tài khoản ngân hàng" class="icon_ttlh1">
                                    <p class="t_tdc">Tài khoản ngân hàng</p>
                                </a>
                                <button class="k_none btn_edit3"><img src="/assets/images/edit_3.svg" alt="Chỉnh sửa" class="icon_edit"></button>
                                <button class="k_none btn_dlt1"><img src="/assets/images/dlt.svg" alt="Chỉnh sửa" class="icon_edit"></button>
                            </div>
                        </div>
                        <div class="k_tab2">
                            <div class="ttlh1">
                                <a href="tel:0388493160" class="k_link1" target="_blank">
                                    <img src="/assets/images/tiktok.png" alt="Tiktok" class="icon_ttlh1">
                                    <p class="t_tdc">Tiktok</p>
                                </a>
                                <button class="k_none btn_edit3"><img src="/assets/images/edit_3.svg" alt="Chỉnh sửa" class="icon_edit"></button>
                                <button class="k_none btn_dlt1"><img src="/assets/images/dlt.svg" alt="Chỉnh sửa" class="icon_edit"></button>
                            </div>
                        </div>
                        <div class="k_tab2">
                            <div class="ttlh1">
                                <a href="tel:0388493160" class="k_link1" target="_blank">
                                    <img src="/assets/images/insta.png" alt="Instagram" class="icon_ttlh1">
                                    <p class="t_tdc">Instagram</p>
                                </a>
                                <button class="k_none btn_edit3"><img src="/assets/images/edit_3.svg" alt="Chỉnh sửa" class="icon_edit"></button>
                                <button class="k_none btn_dlt1"><img src="/assets/images/dlt.svg" alt="Chỉnh sửa" class="icon_edit"></button>
                            </div>
                        </div> -->
            <div class="k_tab2 k_tab2_n">
              <!-- <button type="button" class="btn_none tab2_add" data-toggle="modal" data-target="#modal_add_contact">+</button> -->
            </div>
            <!-- <div class="k_block k_info2">
              <button type="button" class="btn_none tab2_add">+</button>
              <p class="t_tdc">Thêm thông tin</p>
            </div> -->
          </div>
        </div>
      </div>
      <div class="k_cn_b k_none">
        <button type="button" class="btn_none color_d btn_hb">Huỷ bỏ</button>
        <button type="button" class="btn_x btn_ltd">Lưu thay đổi</button>
      </div>
    </div>
  </div>

</div>











<!-- Modal Lưu thay đổi -->
<div id="modal_save" class="modal fade modal_type1" role="dialog">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title color_x">Lưu thay đổi</h4>
        <button type="button" class="btn_t btn_close" data-dismiss="modal"><img src="/assets/images/x_x.svg" alt="Close" class="icon_close"></button>
      </div>
      <div class="modal-body">
        <p class="modal_text">Bạn có chắc muốn lưu thay đổi?</p>
      </div>
      <div class="modal_footer d-flex justify-content-center">
        <button type="button" class="btn_huy color_d" data-dismiss="modal">Hủy</button>
        <button type="button" class="btn_luu btn_x">Lưu</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Huỷ thay đổi -->
<div id="modal_cancel" class="modal fade modal_type1" role="dialog">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title color_x">Huỷ thay đổi</h4>
        <button type="button" class="btn_t btn_close" data-dismiss="modal"><img src="/assets/images/x_x.svg" alt="Close" class="icon_close"></button>
      </div>
      <div class="modal-body">
        <p class="modal_text">Bạn có chắc muốn huỷ thay đổi?</p>
      </div>
      <div class="modal_footer d-flex justify-content-center">
        <button type="button" class="btn_huy color_d" data-dismiss="modal">Không</button>
        <button type="button" class="btn_luu btn_x">Có</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Liên kết thẻ mới -->
<div id="modal_link" class="modal fade modal_type1" role="dialog">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title color_x">Liên kết thẻ mới</h4>
        <button type="button" class="btn_t btn_close" data-dismiss="modal"><img src="/assets/images/x_x.svg" alt="Close" class="icon_close"></button>
      </div>
      <div class="modal-body">
        <input type="text" class="text_lk" placeholder="Nhập mã số thẻ SmartID365 được đính kèm trong bì thư gửi thẻ">
      </div>
      <div class="modal_footer d-flex justify-content-center">
        <button type="button" class="btn_huy color_d" data-dismiss="modal">Hủy</button>
        <button type="button" class="btn_luu btn_x">Lưu</button>
      </div>
    </div>
  </div>
</div>


<!-- Thêm liên hệ -->
<div id="modal_add_link" class="modal fade modal_type1" role="dialog" data-id="">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title color_x">Thêm tài khoản Facebook</h4>
        <button type="button" class="btn_t btn_close" data-dismiss="modal"><img src="/assets/images/x_x.svg" alt="Close" class="icon_close"></button>
      </div>
      <div class="modal-body k_tlk">
        <!-- <div class="k_td d-flex">
                <img src="/assets/images/fb.png" alt="Facebook" class="icon_ttlh2">
                <div class="k_td_r">
                    <input type="text" class="text_td1" value="Facebook"> 
                    <input type="text" class="text_td2" placeholder="Tiêu đề phụ (chỉ hiển thị ở dạng xem danh sách)"> 
                </div>
                <div class="add_tknh">
                  <select class="select_bank">
                      <option value=""></option>
                  </select>
                  <input type="text" class="text_td4" placeholder="Số tài khoản"> 
                </div>
            </div>
            <input type="text" class="text_td3" placeholder="Link Facebook cá nhân">  -->
      </div>
      <div class="modal_footer d-flex justify-content-center">
        <button type="button" class="btn_huy color_d" data-dismiss="modal">Hủy</button>
        <button type="button" class="btn_luu btn_x">Lưu</button>
      </div>
    </div>
  </div>
</div>

<!-- Chỉnh sửa liên hệ -->
<div id="modal_edit_link" class="modal fade modal_type1" role="dialog">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title color_x">Chỉnh sửa thông tin</h4>
        <button type="button" class="btn_t btn_close" data-dismiss="modal"><img src="/assets/images/x_x.svg" alt="Close" class="icon_close"></button>
      </div>
      <div class="modal-body k_tlk">
        <?php
        // foreach ($contact as $item) {  
        //     $img = $contacts[$item['type']]['image'];
        //     $title = $contacts[$item['type']]['title'];
        //     echo '<div class="k_td d-flex">
        //     <img src="'. $img .'" alt="'. $title .'" class="icon_ttlh2">
        //     <div class="k_td_r">
        //         <input type="text" class="text_td1" value="'.$title .'" readonly> 
        //         <input type="text" class="text_td2" placeholder="Tiêu đề phụ (chỉ hiển thị ở dạng xem danh sách)" value="'.$item['subtitle'] .'"> 
        //     </div>
        //     <div class="add_tknh">
        //       <select class="select_bank">
        //           <option value="">Chọn ngân hàng</option>
        //           <option value=' + $item['type'] + ' ' + $bank + '>' + $bank + '</option>
        //       </select>
        //       <input type="text" class="text_td4" placeholder="Số tài khoản"> 
        //     </div>
        // </div>
        // <input type="text" class="text_td3" placeholder="Link Facebook cá nhân" value="'. $item['content'] .'">';
        // }
        // 
        ?>
        <!-- <div class="k_td d-flex">
                <img src="/assets/images/fb.png" alt="Facebook" class="icon_ttlh2">
                <div class="k_td_r">
                    <input type="text" class="text_td1" value="Facebook"> 
                    <input type="text" class="text_td2" placeholder="Tiêu đề phụ (chỉ hiển thị ở dạng xem danh sách)"> 
                </div>
                <div class="add_tknh">
                  <select class="select_bank">
                      <option value=""></option>
                  </select>
                  <input type="text" class="text_td4" placeholder="Số tài khoản"> 
                </div>
            </div>
            <input type="text" class="text_td3" placeholder="Link Facebook cá nhân">  -->
      </div>
      <div class="modal_footer d-flex justify-content-center">
        <button type="button" class="btn_huy color_d" data-dismiss="modal">Hủy</button>
        <button type="button" class="btn_luu btn_x">Lưu</button>
      </div>
    </div>
  </div>
</div>


<!-- Thông tin tài khoản ngân hàng -->
<div id="modal_info_bank" class="modal fade modal_type1" role="dialog">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title color_x">Tài khoản ngân hàng</h4>
        <button type="button" class="btn_t btn_close" data-dismiss="modal"><img src="/assets/images/x_x.svg" alt="Close" class="icon_close"></button>
      </div>
      <div class="modal-body">
        <!-- <div class="ctn_info_b">
          <img src="/assets/images/tknh.png" alt="Tài khoản ngân hàng" class="icon_ttlh2">
          <p class="text_tknh1">Ngân hàng TMCP Tiên Phong</p>
          <p class="text_tknh2">23465345235235</p>
        </div>-->
      </div> 
      <div class="modal_footer d-flex justify-content-center">
        <button type="button" class="btn_luu btn_x" data-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>


<!-- Thêm liên hệ / mạng xã hội -->
<div id="modal_add_contact" class="modal fade modal_add_contact" role="dialog">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title color_x">Thêm liên hệ / mạng xã hội</h4>
        <button type="button" class="btn_t btn_close" data-dismiss="modal"><img src="/assets/images/x_x.svg" alt="Close" class="icon_close"></button>
      </div>
      <div class="modal-body">
        <div class="scroll_tl">
          <p class="text_tlh">Thông tin liên hệ</p>
          <div class="k_tlh ctn_ttlh"></div>
          <p class="text_tlh">Mạng xã hội</p>
          <div class="k_tlh ctn_mxh"></div>
          <p class="text_tlh">Tài chính</p>
          <div class="k_tlh ctn_tc"></div>
          <p class="text_tlh">Khác</p>
          <div class="k_tlh ctn_k"></div>
        </div>
      </div>
    </div>
  </div>
</div>
