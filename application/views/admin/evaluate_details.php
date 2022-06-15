<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Chi tiết đánh giá </h1>
    <div class="card shadow mb-4 px-5 py-4">
        <h1>Đánh giá</h1>
        <div class="d-flex mb-3">
            <label for="exampleInputEmail1" class="d-flex col-xl-3">ID</label>
            <div class="w-100 text-right">
                <input type="text" class="form-control col-xl-12 mb-1" disabled value="<?= $details[0]['id'] ?>">
            </div>
        </div>
        <div class="d-flex mb-3">
            <label for="exampleInputEmail1" class="d-flex col-xl-3">Email</label>
            <div class="w-100 text-right">
                <input type="text" class="form-control col-xl-12 mb-1" disabled value="<?= $details[0]['email'] ?>">
            </div>
        </div>
        <div class="d-flex mb-3">
            <label for="exampleInputEmail1" class="d-flex col-xl-3">Tên hiển thị</label>
            <div class="w-100 text-right">
                <input type="text" class="form-control col-xl-12 mb-1" disabled value="<?= $details[0]['name_eva'] ?>">
            </div>
        </div>
        <div class="d-flex mb-3">
            <label for="exampleInputEmail1" class="d-flex col-xl-3">Số sao</label>
            <div class="w-100 text-right">
                <input type="text" class="form-control col-xl-12 mb-1" disabled value="<?= $details[0]['star'] ?>">
            </div>
        </div>
        <div class="d-flex mb-3">
            <label for="exampleInputEmail1" class="d-flex col-xl-3">Nội dung</label>
            <div class="w-100 text-right">
                <input type="text" class="form-control col-xl-12 mb-1" disabled value="<?= $details[0]['content'] ?>">
            </div>
        </div>
        <div class="d-flex mb-3">
            <label for="exampleInputEmail1" class="d-flex col-xl-3">Ảnh</label>
            <?php $img = explode(',', $details[0]['image']);
            foreach ($img as $val) { ?>
                <div class="k_card">
                    <img src="/assets/images/evaluate/<?= $val ?>" alt="Thẻ SmartID365" class="img_card" style="width:45px;height:45px;margin-right:10px;">
                </div>
            <?php } ?>
        </div>
        <h1>Sản phẩm</h1>
        <div class="d-flex mb-3">
            <label for="exampleInputEmail1" class="d-flex col-xl-3">ID</label>
            <div class="w-100 text-right">
                <input type="text" class="form-control col-xl-12 mb-1" disabled value="<?= $details[0]['product_id'] ?>">
            </div>
        </div>
        <div class="d-flex mb-3">
            <label for="exampleInputEmail1" class="d-flex col-xl-3">Tên sản phẩm</label>
            <div class="w-100 text-right">
                <input type="text" class="form-control col-xl-12 mb-1" disabled value="<?= $details[0]['name'] ?>">
            </div>
        </div>
        <div class="d-flex mb-3">
            <label for="exampleInputEmail1" class="d-flex col-xl-3">Giá</label>
            <div class="w-100 text-right">
                <input type="text" class="form-control col-xl-12 mb-1" disabled value="<?= number_format($details[0]['price'], 0, ',', ',') ?> VNĐ">
            </div>
        </div>
        <?php if ($details[0]['user_name'] != NULL && $details[0]['gender'] != null) { ?>
            <h1>User</h1>
            <div class="d-flex mb-3">
                <label for="exampleInputEmail1" class="d-flex col-xl-3">ID</label>
                <div class="w-100 text-right">
                    <input type="text" class="form-control col-xl-12 mb-1" disabled value="<?= $details[0]['user_id'] ?>">
                </div>
            </div>
            <div class="d-flex mb-3">
                <label for="exampleInputEmail1" class="d-flex col-xl-3">Email</label>
                <div class="w-100 text-right">
                    <input type="text" class="form-control col-xl-12 mb-1" disabled value="<?= $details[0]['email'] ?>">
                </div>
            </div>
            <div class=" d-flex mb-3">
                <label for="exampleInputEmail1" class="d-flex col-xl-3">Tên hiển thị</label>
                <div class="w-100 text-right">
                    <input type="text" class="form-control col-xl-12 mb-1" disabled value="<?= $details[0]['user_name'] ?>">
                </div>
            </div>
            <div class="d-flex mb-3">
                <label for="exampleInputEmail1" class="d-flex col-xl-3">Tên đầy đủ</label>
                <div class="w-100 text-right">
                    <input type="text" class="form-control col-xl-12 mb-1" disabled value="<?= $details[0]['full_name'] ?>">
                </div>
            </div>
            <div class="d-flex mb-3">
                <label for="exampleInputEmail1" class="d-flex col-xl-3">Ngày sinh</label>
                <div class="w-100 text-right">
                    <input type="date" class="form-control col-xl-12 mb-1" disabled value="<?= date('Y-m-d', $details[0]['date_birth']) ?>">
                </div>
            </div>
            <div class="d-flex mb-3">
                <label for="exampleInputEmail1" class="d-flex col-xl-3">Giới Tính</label>
                <div class="w-100 text-right">
                    <input type="text" class="form-control col-xl-12 mb-1" disabled value="<?= ($details[0]['gender'] == 0) ? " Nam" : "Nữ" ?>">
                </div>
            </div>
        <?php } ?>

    </div>
</div>