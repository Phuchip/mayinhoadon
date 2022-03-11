<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Quản lý đơn hàng</h1>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Danh sách đơn hàng</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên khách hàng</th>
                        <th>Số điện thoại</th>
                        <th>Địa chỉ</th>
                        <th>Số sản phẩm</th>
                        <th style="width:110px">Tổng tiền</th>
                        <th>Trạng thái</th>
                        <th></th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Tên khách hàng</th>
                        <th>Số điện thoại</th>
                        <th>Địa chỉ</th>
                        <th>Số sản phẩm</th>
                        <th style="width:110px">Tổng tiền</th>
                        <th>Trạng thái</th>
                        <th></th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php while ($data = mysql_fetch_assoc($sql->result)) { ?>
                        <tr>
                            <td><?= $data['id'] ?></td>
                            <td><a href="?action=view&id=<?= $data['id'] ?>"><?= $data['name'] ?></a></td>
                            <td><?= $data['phone'] ?></td>
                            <td><?= $data['address'] ?></td>
                            <td><?= $data['quantity'] ?></td>
                            <td><?= $data['total'] ?> đ</td>
                            <td>
                                <select name="status" data-id="<?= $data['id'] ?>" class="status_order">
                                <?php foreach($status_order as $key => $value){?>
                                    <option <?= ($data['status'] == $key )?'selected':'' ?> value="<?= $key?>"><?= $value ?></option>
                                <?} ?>
                                </select>
                            </td>
                            <td><button class="btn-delete"><a href="?action=delete&id=<?= $data['id']; ?>"><i class="fa fa-trash"></i></a></button></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>