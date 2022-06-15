<div class="container-fluid">

    <h1 class="h3 mb-2 text-gray-800">Quản lý đánh giá sản phẩm</h1>
    <!-- <div class="text-right mb-3">
        <a href="/admin/add_voucher" class="btn btn-primary">Thêm Voucher</a>
    </div> -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh sách đánh giá</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <button class="xuatEx btn btn-primary " style="float:right;" >Xuất excel</button>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>ID Sản phẩm</th>
                            <th>ID User</th>
                            <th>Tên sản phẩm</th>
                            <th>Email</th>
                            <th>Tên người đánh giá</th>
                            <th>Sao đánh giá</th>
                            <th>Nội dung</th>
                            <th class="d-flex justify-content-center">Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        <? foreach ($eva as $value) { ?>
                            <tr>
                                <td><?= $value['id'] ?></td>
                                <td><?= $value['product_id'] ?></td>
                                <td><?= $value['user_id'] ?></td>
                                <td><?= $value['name'] ?></td>
                                <td><?= $value['email'] ?></td>
                                <td><?= $value['name_eva'] ?></td>
                                <td><?= $value['star'] ?></td>
                                <td><?= $value['content'] ?></td>
                                <td class="d-flex justify-content-center">
                                    <a href="/admin/evaluate_details?id=<?= $value['id'] ?>" class="btn btn-primary">Chi tiết</a>
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