<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Quản lý voucher</h1>
    <!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
        For more information about DataTables, please visit the <a target="_blank"
            href="https://datatables.net">official DataTables documentation</a>.</p> -->

    <!-- DataTales Example -->
    <div class="text-right mb-3">
        <a href="/admin/add_voucher" class="btn btn-primary">Thêm Voucher</a>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh sách voucher</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                            <th>ID</th>
                <table class="table table-bordered " id="dataTable" width="100%" cellspacing="0">
                <button class="xuatEx btn btn-primary" style="float:right;" >Xuất excel</button>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên mã giảm giá</th>
                            <th>Mã giảm giá</th>
                            <th>Số tiền hay % giảm</th>
                            <th>Số lượng vé</th>
                            <th>Số vé còn</th>
                            <th>Giới tính</th>
                            <th>Sinh nhật</th>
                            <th>Ngày chẵn lẻ</th>
                            <th>Thứ chọn</th>
                            <th>Ngày chọn</th>
                            <th>Tháng chọn</th>
                            <th>Giờ bắt đầu</th>
                            <th>Giờ kết thúc</th>
                            <th>Ngày bắt đầu</th>
                            <th>Ngày kết thúc</th>
                            <th class="d-flex justify-content-center">Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        <? foreach ($voucher as $value) { ?>
                            <tr>
                                <td><?= $value['id'] ?></td>
                                <td><?= $value['vou_name'] ?></td>
                                <td><?= $value['vou_coupon'] ?></td>
                                <td><?php if ($value['vou_condition'] == 1) {
                                        echo  number_format($value['discount'], 0, ',', '.');
                                    } else {
                                        echo $value['discount'] . '%';
                                    } ?></td>
                                <td><?= number_format($value['ticket_number'], 0, ',', '.') ?></td>
                                <td><?= number_format($value['remaining_tickets'], 0, ',', '.') ?></td>
                                <td><?php if ($value['gender'] == 0) {
                                        echo 'Nam';
                                    } else if ($value['gender'] == 1) {
                                        echo 'Nữ';
                                    } else if ($value['gender'] == 2) {
                                        echo 'Khác';
                                    } else if ($value['gender'] == 4) {
                                        echo 'x';
                                    } ?></td>
                                <td><?php if ($value['birthday'] == 0) {
                                        echo "x";
                                    } else {
                                        echo "Áp dụng";
                                    } ?></td>
                                <td><?php if ($value['vou_day'] == 0) {
                                        echo 'x';
                                    } else if ($value['vou_day'] == 1) {
                                        echo 'Ngày lẻ';
                                    } else if ($value['vou_day'] == 2) {
                                        echo 'Ngày chẵn';
                                    } ?></td>
                                <td><?php
                                    if ($value['thu_select'] != '') {
                                            echo 'Thứ ' . $value['thu_select'];
                                        } else if ($value['thu_select'] == '') {
                                            echo 'x';
                                        }
                                    ?></td>
                                <td><?php
                                 if ($value['day_select'] != '') {
                                        echo 'Ngày ' . $value['day_select'];
                                    } else if ($value['day_select'] == '') {
                                        echo 'x';
                                    }
                                    ?></td>
                                <td><?php if ($value['month_select'] != '') {
                                        echo 'Tháng ' . $value['month_select'];
                                    } else if ($value['month_select'] == '') {
                                        echo 'x';
                                    }
                                    ?></td>

                                <td><?= ($value['start_time'] == 0) ? "x" : date('H:i', $value["start_time"]) ?></td>
                                <td><?= ($value['time_end'] == 0) ? "x" : date('H:i', $value["time_end"]) ?></td>
                                <td><?= ($value['start_day'] == 0) ? "x" : date('H:i Y-m-d', $value['start_day']) ?></td>
                                <td><?= ($value['end_date'] == 0) ? "x" : date('H:i Y-m-d', $value['end_date']) ?></td>
                                <td class="d-flex justify-content-center">
                                    <a href="/admin/edit_voucher?id=<?= $value['id'] ?>" class="btn btn-primary">Chỉnh sửa</a>
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