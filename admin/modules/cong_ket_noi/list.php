<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Cổng kết nối</h1>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Danh sách cổng kết nối</h6>
                <button><a href="?action=add">Thêm mới</a></button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Cổng kết nối</th>
                                <th>Ngày sửa đổi</th>
                                <th>Trạng thái</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Cổng kết nối</th>
                                <th>Ngày sửa đổi</th>
                                <th>Trạng thái</th>
                                <th></th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php While($data = mysql_fetch_assoc($sql->result)){ ?>
                                <tr>
                                    <td><?= $data['id'] ?></td>
                                    <td><a href="?action=add&id=<?= $data['id'] ?>"><?= $data['name'] ?></a></td>
                                    <td><?= date('H:i d-m-Y',$data['modify_time']); ?></td>
                                    <td><img src="../../../images/icon/<?php checkStatus($data['status']) ?>" alt=""></td>
                                    <td><button class="btn-delete"><a href="?action=delete&id=<?= $data['id']; ?>"><i class="fa fa-trash"></i></a></button></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>