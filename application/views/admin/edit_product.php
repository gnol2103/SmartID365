<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Chỉnh sửa sản phẩm</h1>
    <div class="card shadow mb-4 px-5 py-4">
    <form method="post" id="form_edit_product" enctype="multipart/form-data" name="form_edit_product">
        <div class="d-flex mb-3">
            <label for="exampleInputEmail1" class="d-flex col-xl-3">Tên sản phẩm<span class="text-danger ml-1">*</span></label> 
            <div class="w-100 text-right">
                <input type="text" class="form-control col-xl-12 mb-1" placeholder="Tên sản phẩm" name="name" id="name" value="<?=$info_pro['name']?>">
                <i class="text-danger name_error"></i>
                <input type="text" class="hide" name="id" value="<?=$info_pro['id']?>">
            </div>
        </div>
        <div class="d-flex mb-3">
            <label for="exampleInputEmail1" class="d-flex col-xl-3">Màu sắc<span class="text-danger ml-1">*</span></label> 
            <div class="w-100 text-right">
                <select class="form-control mb-1" name="color" id="color">
                    <option value="">Chọn màu sắc</option>
                    <? foreach(arrayColor() as $key => $val) { ?>
                        <option value="<?=$key?>" <?=$info_pro['color']==$key?'selected':''?>><?=$val?></option>
                    <? } ?>
                </select>
                <i class="text-danger color_error"></i>
            </div>
        </div>
        <div class="d-flex mb-3">
            <label for="exampleInputEmail1" class="d-flex col-xl-3">Số lượng<span class="text-danger ml-1">*</span></label> 
            <div class="w-100 text-right">
                <input type="number" class="form-control col-xl-12 mb-1" placeholder="Số lượng" name="amount" id="amount" value="<?=$info_pro['amount']?>">
                <i class="text-danger amount_error"></i>
            </div>
        </div>
        <div class="d-flex mb-3">
            <label for="exampleInputEmail1" class="d-flex col-xl-3">Giá sản phẩm<span class="text-danger ml-1">*</span></label> 
            <div class="w-100 text-right">
                <input type="number" class="form-control col-xl-12 mb-1" placeholder="Giá sản phẩm" name="price" id="price" value="<?=$info_pro['price']?>">
                <i class="text-danger price_error"></i>
            </div>
        </div>
        <div class="d-flex mb-3">
            <label for="exampleInputEmail1" class="d-flex col-xl-3">Loại giảm giá</label> 
            <select class="form-control type_sale" name="type_sale" id="type_sale">
                <? foreach(arrayTypeSale() as $key => $val) { ?>
                    <option value="<?=$key?>" <?=$info_pro['type_sale']==$key?'selected':''?>><?=$val?></option>
                <? } ?>
            </select>
        </div>
        <div class="d-flex mb-3 k_sale">
            <label for="exampleInputEmail1" class="d-flex col-xl-3"></label> 
            <div class="w-100 text-right">
                <input type="number" class="form-control col-xl-12 mb-1" placeholder="Giảm giá" name="sale" id="sale" value="<?=$info_pro['sale']?>">
            </div>
        </div>
        <div class="d-flex mb-3">
            <label for="exampleInputEmail1" class="d-flex col-xl-3">Sản phẩm HOT</label> 
            <select class="form-control" name="hot" id="hot">
                <? foreach(arrayHot() as $key => $val) { ?>
                    <option value="<?=$key?>" <?=$info_pro['hot']==$key?'selected':''?>><?=$val?></option>
                <? } ?>
            </select>
        </div>
        <div class="d-flex mb-3">
            <label for="exampleInputEmail1" class="d-flex col-xl-3">Chọn ảnh<span class="text-danger ml-1">*</span></label> 
            <div class="w-100">
                <div class="d-flex mb-1">
                    <button type="button" class="btn btn-primary btn_choose_img mr-3">Chọn ảnh</button>
                    <input type="file" class="form-control-file hide" id="image" name="image" accept=".png, .jpg, .jpeg">
                    <div class="show_img"><img src="/assets/product_image/<?=$info_pro['image']?>" class="img_product"></div>
                </div>
                <i class="text-danger image_error pt-2"></i>
            </div>
        </div>
        <div class="d-flex mb-3">
            <label for="exampleInputEmail1" class="d-flex col-xl-3">Giới thiệu sản phẩm<span class="text-danger ml-1">*</span></label> 
            <div class="w-100 text-right">
                <textarea class="form-control" rows="5" placeholder="Giới thiệu sản phẩm" name="introduce" id="introduce"><?=$info_pro['introduce']?></textarea>
                <i class="text-danger introduce_error"></i>
            </div>
        </div>
        <div class="d-flex mb-3">
            <label for="exampleInputEmail1" class="d-flex col-xl-3">Mô tả<span class="text-danger ml-1">*</span></label> 
            <div class="w-100 text-right">
                <textarea class="form-control" rows="10" placeholder="Mô tả" name="description" id="description"><?=$info_pro['description']?></textarea>
                <i class="text-danger description_error"></i>
            </div>
        </div>
        <div class="text-center mt-4 mx-auto">      
            <a href="/admin/product" class="btn btn-outline-secondary w-25 mr-4">Hủy</a>
            <button type="submit" class="btn btn-primary w-25 add_product">Lưu</button>
        </div>
        </form>
    </div>
</div>
<!-- /.container-fluid -->