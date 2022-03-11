<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Quản lý đăng ký nhận tin</h1>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Danh sách đăng ký nhận tin</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Mã SP</th>
                        <th>Thông tin</th>
                        <th>Ngày đăng ký</th>
                        <th></th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Mã SP</th>
                        <th>Thông tin</th>
                        <th>Ngày đăng ký</th>
                        <th></th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php while ($data = mysql_fetch_assoc($sql->result)) { ?>
                        <tr>
                            <td><?= $data['id'] ?></td>
                            <td><a href="?action=view&id=<?= $data['id'] ?>"><?= $data['name'] ?></a></td>
                            <td><?= $data['info'] ?></td>
                            <td><?= $data['created_time'] ?></td>
                            <td><?= date('H:i d/m/Y',$data['quantity']) ?></td>
                            <td><button class="btn-delete"><a href="?action=delete&id=<?= $data['id']; ?>"><i class="fa fa-trash"></i></a></button></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>