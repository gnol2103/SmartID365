<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Chi tiết khách hàng</h1>
    <div class="card shadow mb-4 px-5 py-4">
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
                <input type="text" class="form-control col-xl-12 mb-1" disabled value="<?= $details[0]['user_name'] ?>">
            </div>
        </div>
        <div class="d-flex mb-3">
            <label for="exampleInputEmail1" class="d-flex col-xl-3">Họ và tên</label>
            <div class="w-100 text-right">
                <input type="text" class="form-control col-xl-12 mb-1" disabled value="<?= $details[0]['full_name'] ?>">
            </div>
        </div>
        <div class="d-flex mb-3">
            <label for="exampleInputEmail1" class="d-flex col-xl-3">Ngày sinh</label>
            <div class="w-100 text-right">
                <input type="date" class="form-control col-xl-12 mb-1" disabled value="<?= $details[0]['date_birth'] != 0? date('Y-m-d', $details[0]['date_birth']) : ""?>">
            </div>
        </div>
        <div class="d-flex mb-3">
            <label for="exampleInputEmail1" class="d-flex col-xl-3">Giới Tính</label>
            <div class="w-100 text-right">
                <input type="text" class="form-control col-xl-12 mb-1" disabled value="<?= ($details[0]['gender'] == 0) ? "Nam" : "Nữ" ?>">
            </div>
        </div>
        <div class="d-flex mb-3">
            <label for="exampleInputEmail1" class="d-flex col-xl-3">Công ty</label>
            <div class="w-100 text-right">
                <input type="text" class="form-control col-xl-12 mb-1" disabled value="<?= $details[0]['company'] ?>">
            </div>
        </div>
        <div class="d-flex mb-3">
            <label for="exampleInputEmail1" class="d-flex col-xl-3">Chức vụ</label>
            <div class="w-100 text-right">
                <input type="text" class="form-control col-xl-12 mb-1" disabled value="<?= $details[0]['position'] ?>">
            </div>
        </div>
        <div class="d-flex mb-3">
            <label for="exampleInputEmail1" class="d-flex col-xl-3">Mô tả</label>
            <div class="w-100 text-right">
                <input type="text" class="form-control col-xl-12 mb-1" disabled value="<?= $details[0]['descrip'] ?>">
            </div>
        </div>
        <div class="d-flex mb-3">
            <label for="exampleInputEmail1" class="d-flex col-xl-3">Trạng thái</label>
            <div class="w-100 text-right">
                <input type="text" class="form-control col-xl-12 mb-1" disabled value="<?= ($details[0]['status'] == 0) ? "Chưa xác thực" : "Đã xác thực" ?>">
            </div>
        </div>

        <?php
        foreach ($details as $key => $value) {
            if ($value['title'] != NULL && $value['content'] != NULL) {
                echo '<div class="d-flex mb-3">
                <label for="exampleInputEmail1" class="d-flex col-xl-3">' . $value['title'] . '</label>
                <div class="w-100 text-right">
                    <input type="text" class="form-control col-xl-12 mb-1" disabled value="' . $value['content'] . '">
                </div>
            </div>';
            }
        }
        ?>
    </div>
</div>