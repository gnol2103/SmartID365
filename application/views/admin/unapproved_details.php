<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Chi tiết hoá đơn chưa duyệt</h1>
    <div class="card shadow mb-4 px-5 py-4">
        <h1>Hoá đơn</h1>
        <div class="d-flex mb-3">
            <label for="exampleInputEmail1" class="d-flex col-xl-3">ID</label>
            <div class="w-100 text-right">
                <input type="text" class="form-control col-xl-12 mb-1" disabled value="<?= $_GET['id'] ?>">
            </div>
        </div>
        <div class="d-flex mb-3">
            <label for="exampleInputEmail1" class="d-flex col-xl-3">Tên người đặt hàng</label>
            <div class="w-100 text-right">
                <input type="text" class="form-control col-xl-12 mb-1" value="<?= $details[0]['bill_name'] ?>" disabled>
            </div>
        </div>
        <div class="d-flex mb-3">
            <label for="exampleInputEmail1" class="d-flex col-xl-3">Số điện thoại</label>
            <div class="w-100 text-right">
                <input type="text" class="form-control col-xl-12 mb-1" disabled value="<?= $details[0]['phone'] ?>">
            </div>
        </div>
        <div class="d-flex mb-3">
            <label for="exampleInputEmail1" class="d-flex col-xl-3">Thành phố </label>
            <div class="w-100 text-right">
                <input type="text" class="form-control col-xl-12 mb-1" disabled value="<?= $details[0]['cit_name'] ?>">
            </div>
        </div>
        <div class="d-flex mb-3">
            <label for="exampleInputEmail1" class="d-flex col-xl-3">Quận</label>
            <div class="w-100 text-right">
                <input type="text" class="form-control col-xl-12 mb-1" disabled value="<?= $details[0]['dis_name'] ?>">
            </div>
        </div>
        <div class="d-flex mb-3">
            <label for="exampleInputEmail1" class="d-flex col-xl-3">Địa chỉ</label>
            <div class="w-100 text-right">
                <input type="text" class="form-control col-xl-12 mb-1" disabled value="<?= $details[0]['address'] ?>">
            </div>
        </div>
        <div class="d-flex mb-3">
            <label for="exampleInputEmail1" class="d-flex col-xl-3">Tên thẻ</label>
            <div class="w-100 text-right">
                <input type="text" class="form-control col-xl-12 mb-1" disabled value="<?= $details[0]['card_name'] ?>">
            </div>
        </div>
        <div class="d-flex mb-3">
            <label for="exampleInputEmail1" class="d-flex col-xl-3">Chú thích</label>
            <div class="w-100 text-right">
                <input type="text" class="form-control col-xl-12 mb-1" disabled value="<?= $details[0]['note'] ?>">
            </div>
        </div>
        <div class="d-flex mb-3">
            <label for="exampleInputEmail1" class="d-flex col-xl-3">Phí giao hàng</label>
            <div class="w-100 text-right">
                <input type="text" class="form-control col-xl-12 mb-1" disabled value="<?= $details[0]['total_trans'] ?>">
            </div>
        </div>
        <?php if ($details[0]['voucher'] != '') { ?>

            <div class="d-flex mb-3">
                <label for="exampleInputEmail1" class="d-flex col-xl-3">Mã giảm giá</label>
                <div class="w-100 text-right">
                    <input type="text" class="form-control col-xl-12 mb-1" disabled value="<?= $details[0]['vou_coupon'] ?>">
                </div>
            </div>
            <div class="d-flex mb-3">
                <label for="exampleInputEmail1" class="d-flex col-xl-3">Số tiền hoặc %</label>
                <div class="w-100 text-right">
                    <input type="text" class="form-control col-xl-12 mb-1" disabled value="<?php if ($details[0]['vou_condition'] == 1) {
                                                                                                echo number_format($details[0]['discount'], 0, ',', ',') . " VNĐ";
                                                                                            } else {
                                                                                                echo $details[0]['discount'] . " %";
                                                                                            } ?>">
                </div>
            </div>
        <?php } ?>
        <div class="d-flex mb-3">
            <label for="exampleInputEmail1" class="d-flex col-xl-3">Tổng tiền</label>
            <div class="w-100 text-right">
                <input type="text" class="form-control col-xl-12 mb-1" disabled value="<?= number_format($details[0]['total_price'], 0, ',', ',') . ' VNĐ' ?>">
            </div>
        </div>
        <div class="d-flex mb-3">
            <label for="exampleInputEmail1" class="d-flex col-xl-3">Ngày mua</label>
            <div class="w-100 text-right">
                <input type="text" class="form-control col-xl-12 mb-1" disabled value="<?= date('Y-m-d', $details[0]['created_at']) ?>">
            </div>
        </div>
        <h1>Sản phẩm</h1>
        <?php foreach ($details as $key) {  ?>
            <div class="d-flex mb-3">
                <label for="exampleInputEmail1" class="d-flex col-xl-3">Mã sản phẩm</label>
                <div class="w-100 text-right">
                    <input type="text" class="form-control col-xl-12 mb-1" disabled value="<?= $key['product_id'] ?>">
                </div>
            </div>
            <div class="d-flex mb-3">
                <label for="exampleInputEmail1" class="d-flex col-xl-3">Tên sản phẩm</label>
                <div class="w-100 text-right">
                    <input type="text" class="form-control col-xl-12 mb-1" disabled value="<?= $key['name'] ?>">
                </div>
            </div>
            <div class="d-flex mb-3">
                <label for="exampleInputEmail1" class="d-flex col-xl-3">Giá sản phẩm</label>
                <div class="w-100 text-right">
                    <input type="text" class="form-control col-xl-12 mb-1" disabled value="<?= number_format($key['bill_price'],0,',',','). ' VNĐ'  ?>">
                </div>
            </div>
            <div class="d-flex mb-3">
                <label for="exampleInputEmail1" class="d-flex col-xl-3">Số lượng đặt</label>
                <div class="w-100 text-right">
                    <input type="text" class="form-control col-xl-12 mb-1" disabled value="<?= $key['amount'] ?>">
                </div>
            </div>
        <?php } ?>
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
                <input type="date" class="form-control col-xl-12 mb-1" disabled value="<?= date('Y-m-d', $details[0]['date_birth']) ?>">
            </div>
        </div>
        <div class="d-flex mb-3">
            <label for="exampleInputEmail1" class="d-flex col-xl-3">Giới Tính</label>
            <div class="w-100 text-right">
                <input type="text" class="form-control col-xl-12 mb-1" disabled value="<?= ($details[0]['gender'] == 0) ? "Nam" : "Nữ" ?>">
            </div>
        </div>
        <button class="xuatEx btn btn-primary" style="float:right;">Xuất excel</button>
        <table class="tableExcel" id="dataTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên người đặt hàng</th>
                    <th>Số điện thoại</th>
                    <th>Thành phố</th>
                    <th>Quận</th>
                    <th>Địa chỉ</th>
                    <th>Tên thẻ</th>
                    <th>Ghi chú</th>
                    <th>Phí giao hàng</th>
                    <?php if ($details[0]['voucher'] != '') { ?>
                        <th>Mã Giảm giá</th>
                        <th>Số tiền hoặc % giảm</th>
                    <?php } ?>
                    <th>Tổng tiền</th>
                    <th>Ngày mua</th>
                    <?php for ($i = 0; $i < count($details); $i++) {
                        echo '     <th>Mã sản phẩm</th>
<th>Tên sản phẩm</th>
<th>Giá sản phẩm</th>';
                    }
                    ?>


                    <th>ID User</th>
                    <th>Email</th>
                    <th>Tên hiển thị</th>
                    <th>Họ và tên</th>
                    <th>Ngày sinh</th>
                    <th>Giới tính</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?= $_GET['id'] ?></td>
                    <td><?= $details[0]['bill_name'] ?></td>
                    <td><?= $details[0]['phone'] ?></td>
                    <td><?= $details[0]['cit_name'] ?></td>
                    <td><?= $details[0]['dis_name'] ?></td>
                    <td><?= $details[0]['address'] ?></td>
                    <td><?= $details[0]['card_name'] ?></td>
                    <td><?= $details[0]['note'] ?></td>
                    <td><?= $details[0]['total_trans'] ?></td>
                    <?php if ($details[0]['voucher'] != '') { ?>
                        <td><?= $details[0]['vou_coupon'] ?></td>
                        <td><?php if ($details[0]['vou_condition'] == 1) {
                                echo number_format($details[0]['discount'], 0, ',', ',') . " VNĐ";
                            } else {
                                echo $details[0]['discount'] . " %";
                            } ?></td>
                    <?php } ?>
                    <td><?= number_format($details[0]['total_price'], 0, ',', ',') . ' VNĐ' ?></td>
                    <td><?= date('Y-m-d', $details[0]['created_at']) ?></td>
                    <?php foreach ($details as $key) {  ?>
                        <td><?= $key['product_id'] ?></td>
                        <td><?= $key['name'] ?></td>
                        <td><?= $key['bill_price'] ?></td>
                    <?php } ?>
                    <td><?= $details[0]['user_id'] ?></td>
                    <td><?= $details[0]['email'] ?></td>
                    <td><?= $details[0]['user_name'] ?></td>
                    <td><?= $details[0]['full_name'] ?></td>
                    <td><?= date('Y-m-d', $details[0]['date_birth']) ?></td>
                    <td><?= ($details[0]['gender'] == 0) ? "Nam" : "Nữ" ?></td>

                </tr>
            </tbody>
        </table>
    </div>
</div>