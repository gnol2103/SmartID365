<div class="container-fluid">

    <h1 class="h3 mb-2 text-gray-800">Quản lý hoá đơn</h1>
    <!-- <div class="text-right mb-3">
        <a href="/admin/add_voucher" class="btn btn-primary">Thêm Voucher</a>
    </div> -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh sách hoá đơn chưa duyệt</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <!-- <th>ID User</th> -->
                            <!-- <th>ID Voucher</th> -->
                            <th>Tên người đặt</th>
                            <th>Số điện thoại</th>
                            <th>Địa chỉ</th>
                            <th>Tên thẻ</th>
                            <th>Ghi chú</th>
                            <th>Phí giao hàng</th>
                            <!-- <th>Mã giảm giá</th> -->
                            <th>Tổng tiền</th>
                            <th>Ngày mua</th>
                            <th>Trạng thái</th>
                            <th class="d-flex justify-content-center">Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        <? foreach ($unapproved_invoice as $value) { ?>
                            <tr>
                                <td><?= $value['id'] ?></td>
                                <!-- <td><?= $value['user_id'] ?></td> -->
                                <!-- <td><?php if ($value['voucher'] == '') {
                                        echo "x";
                                    } else {
                                        echo $value['voucher'];
                                    } ?></td> -->
                                <td><?= $value['bill_name'] ?></td>
                                <td><?= $value['phone'] ?></td>
                                <td><?= $value['address'] ?></td>
                                <td><?= $value['card_name'] ?></td>
                                <td><?= $value['note'] ?></td>
                                <td><?= $value['total_trans'] ?></td>
                                <td><?= number_format($value['total_price'], 0, ',', ',') ?></td>
                                <td><?= date('Y-m-d', $value['created_at']) ?></td>
                                <td><?php if ($value['status'] == 0) {
                                        echo 'Chưa duyệt';
                                    } ?></td>
                                <td class="d-flex justify-content-center">
                                    <button type="button" data-id="<?= $value['id'] ?>" class="btn btn-primary duyet">
                                        Duyệt
                                    </button>
                                    <a href="/admin/unapproved_details?id=<?= $value['id'] ?>" class="btn btn-primary">Chi tiết</a>
                                </td>
                            </tr>
                        <? } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->