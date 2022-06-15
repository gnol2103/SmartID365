<div class="container-fluid">

    <!-- Page Heading -->



    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Số lượng khách hàng</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $count[0] ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Số lượng sản phẩm</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $count[1] ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Số lượng hoá đơn</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $count[2] ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-secondary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Tổng doanh thu</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= number_format($count[3]['sum'], 0, ',', ',') ?> VNĐ</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Thống kê</h1>
        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
        <form action="" method="GET">
            <input type="date" class="form-control date_from" name="date_from" placeholder="Từ ngày" required="true">
            <input type="date" class="form-control date_to" name="date_to" placeholder="Đến ngày" required="true">
            <button type="submit" class="btn btn-info search" name="search">Submit</button>
        </form>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh sách hoá đơn đã duyệt</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>ID User</th>
                            <th>ID Voucher</th>
                            <th>Tên người đặt</th>
                            <th>Số điện thoại</th>
                            <th>Địa chỉ</th>
                            <th>Tên thẻ</th>
                            <th>Ghi chú</th>
                            <th>Phí giao hàng</th>
                            <th>Ngày mua</th>
                            <th>Tổng tiền</th>
                            <th>Chi tiết</th>

                        </tr>
                    </thead>
                    <tbody class="dataSearch">
                        <? foreach ($approved_invoice as $value) { ?>
                            <tr>
                                <td><?= $value['id'] ?></td>
                                <td><?= $value['user_id'] ?></td>
                                <td><?php if ($value['voucher'] == '') {
                                        echo "x";
                                    } else {
                                        echo $value['voucher'];
                                    } ?></td>
                                <td><?= $value['bill_name'] ?></td>
                                <td><?= $value['phone'] ?></td>
                                <td><?= $value['address'] ?></td>
                                <td><?= $value['card_name'] ?></td>
                                <td><?= $value['note'] ?></td>
                                <td><?= $value['total_trans'] ?></td>
                                <td><?= date('Y-m-d',$value['created_at']) ?></td>
                                <td><?= number_format($value['total_price'], 0, ',', ',') ?></td>
                                <td class="d-flex justify-content-center">
                                    <a href="/admin/approved_details?id=<?= $value['id'] ?>" class="btn btn-primary">Chi tiết</a>
                                </td>
                            </tr>
                        <? } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>