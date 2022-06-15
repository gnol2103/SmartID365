<div class="container-fluid">

    <h1 class="h3 mb-2 text-gray-800">Quản lý khách hàng</h1>
    <!-- <div class="text-right mb-3">
        <a href="/admin/add_voucher" class="btn btn-primary">Thêm Voucher</a>
    </div> -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh sách khách hàng</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered " id="dataTable" width="100%" cellspacing="0">
                <button class="xuatEx btn btn-primary" style="float:right;" >Xuất excel</button>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Email</th>
                            <th>Tên hiển thị</th>
                            <th>Tên đầy đủ</th>
                            <th>Ngày sinh</th>
                            <th>Giới tính</th>
                            <th>Công ty</th>
                            <th>Chức vụ</th>
                            <th>Mô tả</th>
                            <th>Trạng thái</th>
                            <th class="d-flex justify-content-center noExl">Chức năng</th>

                        </tr>
                    </thead>
                    <tbody>
                        <? foreach ($users as $value) { ?>
                            <tr>
                                <td><?= $value['id'] ?></td>
                                <td><?= $value['email'] ?></td>
                                <td><?= $value['user_name'] ?></td>
                                <td><?= $value['full_name'] ?></td>
                                <td><?= $value['date_birth'] != 0 ?  date('d/m/Y', $value['date_birth']) : "" ?> </td>
                                <td><?= ($value['gender'] == 0) ? "Nam" : "Nữ" ?></td>
                                <td><?= $value['company'] ?></td>
                                <td><?= $value['position'] ?></td>
                                <td><?= $value['descrip'] ?></td>
                                <td><?= ($value['status'] == 0) ? "Chưa xác thực" : "Đã xác thực" ?></td>
                                <td class="d-flex justify-content-center">
                                    <a href="/admin/user_details?id=<?= $value['id'] ?>" class="btn btn-primary noExl">Chi tiết</a>
                                </td>

                            </tr>
                        <? } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>