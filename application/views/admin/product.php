<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Quản lý sản phẩm</h1>
    <!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
        For more information about DataTables, please visit the <a target="_blank"
            href="https://datatables.net">official DataTables documentation</a>.</p> -->

    <!-- DataTales Example -->
    <div class="text-right mb-3">
        <a href="/admin/add_product" class="btn btn-primary">Thêm sản phẩm</a>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh sách sản phẩm</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <button class="xuatEx btn btn-primary" style="float:right;" >Xuất excel</button>
                    <thead>
                        <tr>
                            <th>Tên sản phẩm</th>
                            <th>Màu sắc</th>
                            <th>Số lượng</th>
                            <th>Giá</th>
                            <th>Hot</th>
                            <th>Ngày tạo</th>
                            <th class="d-flex justify-content-center">Chức năng</th>
                        </tr>
                    </thead>
                        <!-- <tfoot>
                            <tr>
                                <th>Tên sản phẩm</th>
                                <th>Giá</th>
                                <th>Số lượng</th>
                                <th>Màu sắc</th>
                                <th>Hot</th>
                                <th>Ngày tạo</th>
                                <th>Ngày sửa</th>
                            </tr>
                        </tfoot> -->
                    <tbody>
                        <? foreach ($products as $value) { ?>
                        <tr>
                            <td><?=$value['name']?></td>
                            <td><?=arrayColor()[$value['color']]?></td>
                            <td><?=$value['amount']?></td>
                            <td><?=number_format($value['price'])?></td>
                            <td><?=arrayHot()[$value['hot']]?></td>
                            <td><?=formatDate($value['created_at'])?></td>
                            <td class="d-flex justify-content-center">
                                <a href="/admin/edit_product?id=<?=$value['id']?>" class="btn btn-primary">Chỉnh sửa</a>
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


