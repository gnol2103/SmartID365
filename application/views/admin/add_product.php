<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Thêm sản phẩm</h1>
    <div class="card shadow mb-4 px-5 py-4">
    <form method="post" id="form_add_product" enctype="multipart/form-data">
        <div class="d-flex mb-3">
            <label for="exampleInputEmail1" class="d-flex col-xl-3">Tên sản phẩm<span class="text-danger ml-1">*</span></label> 
            <div class="w-100 text-right">
                <input type="text" class="form-control col-xl-12 mb-1" placeholder="Tên sản phẩm" name="name" id="name">
                <i class="text-danger name_error"></i>
            </div>
        </div>
        <div class="d-flex mb-3">
            <label for="exampleInputEmail1" class="d-flex col-xl-3">Màu sắc<span class="text-danger ml-1">*</span></label> 
            <div class="w-100 text-right">
                <select class="form-control mb-1" name="color" id="color">
                    <option value="">Chọn màu sắc</option>
                    <option value="0">Màu Đen</option>
                    <option value="1">Màu Trắng</option>
                </select>
                <i class="text-danger color_error"></i>
            </div>
        </div>
        <div class="d-flex mb-3">
            <label for="exampleInputEmail1" class="d-flex col-xl-3">Số lượng<span class="text-danger ml-1">*</span></label> 
            <div class="w-100 text-right">
                <input type="number" class="form-control col-xl-12 mb-1" placeholder="Số lượng" name="amount" id="amount">
                <i class="text-danger amount_error"></i>
            </div>
        </div>
        <div class="d-flex mb-3">
            <label for="exampleInputEmail1" class="d-flex col-xl-3">Giá sản phẩm<span class="text-danger ml-1">*</span></label> 
            <div class="w-100 text-right">
                <input type="number" class="form-control col-xl-12 mb-1" placeholder="Giá sản phẩm" name="price" id="price">
                <i class="text-danger price_error"></i>
            </div>
        </div>
        <div class="d-flex mb-3">
            <label for="exampleInputEmail1" class="d-flex col-xl-3">Loại giảm giá</label> 
            <select class="form-control type_sale" name="type_sale" id="type_sale">
                <option value="0">Chọn loại giảm giá</option>
                <option value="1">Giảm theo %</option>
                <option value="2">Giảm theo số tiền</option>
            </select>
        </div>
        <div class="d-flex mb-3 k_sale hidden">
            <label for="exampleInputEmail1" class="d-flex col-xl-3"></label> 
            <div class="w-100 text-right">
                <input type="number" class="form-control col-xl-12 mb-1" placeholder="Giảm giá" name="sale" id="sale">
                <i class="text-danger sale_error"></i>
            </div>
        </div>
        <div class="d-flex mb-3">
            <label for="exampleInputEmail1" class="d-flex col-xl-3">Sản phẩm HOT</label> 
            <select class="form-control" name="hot" id="hot">
                <option value="0">Không</option>
                <option value="1">Hot</option>
            </select>
        </div>
        <div class="d-flex mb-3">
            <label for="exampleInputEmail1" class="d-flex col-xl-3">Chọn ảnh<span class="text-danger ml-1">*</span></label> 
            <div class="w-100">
                <div class="d-flex mb-1">
                    <button type="button" class="btn btn-primary btn_choose_img mr-3">Chọn ảnh</button>
                    <input type="file" class="form-control-file hide" id="image" name="image" accept=".png, .jpg, .jpeg">
                    <div class="show_img"></div>
                </div>
                <i class="text-danger image_error pt-2"></i>
            </div>
        </div>
        <div class="d-flex mb-3">
            <label for="exampleInputEmail1" class="d-flex col-xl-3">Giới thiệu sản phẩm<span class="text-danger ml-1">*</span></label> 
            <div class="w-100 text-right">
                <textarea class="form-control mb-1" rows="5" placeholder="Giới thiệu sản phẩm" name="introduce" id="introduce"></textarea>
                <i class="text-danger introduce_error"></i>
            </div>
        </div>
        <div class="d-flex mb-3">
            <label for="exampleInputEmail1" class="d-flex col-xl-3">Mô tả<span class="text-danger ml-1">*</span></label> 
            <div class="w-100 text-right">
                <textarea class="form-control mb-1" rows="10" placeholder="Mô tả" name="description" id="description"></textarea>
                <i class="text-danger description_error"></i>
            </div>
        </div>
        <div class="text-center mx-auto mt-4">   
            <a href="/admin/product" class="btn btn-outline-secondary w-25 mr-4">Hủy</a> 
            <button type="submit" class="btn btn-primary w-25 add_product">Thêm</button>
        </div>
        </form>
    </div>
</div>