<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Quản lý bình luận</h1>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Danh sách bình luận</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Mã bình luận</th>
                        <th>Tên khách hàng</th>
                        <th>Nội dung</th>
                        <th>Thời gian</th>
                        <th>Bình luận con</th>
                        <th>Trả lời</th>
                        <th>Hiển thị</th>
                        <th></th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Mã bình luận</th>
                        <th>Tên khách hàng</th>
                        <th>Nội dung</th>
                        <th>Thời gian</th>
                        <th>Bình luận con</th>
                        <th>Trả lời</th>
                        <th>Hiển thị</th>
                        <th></th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php while ($data = mysql_fetch_assoc($sql->result)) { ?>
                        <tr>
                            <?php $check_rep = new db_query("SELECT * FROM `tbl_comments` WHERE parent = ".$data['id']." and isAdmin != 0 ORDER BY `created_time` DESC");
                            $value = mysql_num_rows($check_rep->result);
                             ?>
                            <td><?= $data['id'] ?></td>
                            <td><a href="?action=view&id=<?= $data['id'] ?>"><?= $data['name'] ?></a></td>
                            <td><?= $data['comment'] ?></td>
                            <td><?= date('H:i d/m/Y',$data['created_time']) ?></td>
                            <td><a href="<?= '/'.$data['alias'].'-id-'.$data['product_id'].'.html' ?>"><?= ($data['parent'] == 0)?'':$data['parent'] ?></a></td>
                            <td><?= ($value > 0)?'<i class="fas fa-check color-check"></i>':''  ?></td>
                            <td><input type="checkbox" class="check-show" value="<?= $data['id'] ?>" <?= ($data['status'] == 1)?'checked':'' ?>></td>
                            <td><button class="btn-delete"><a href="?action=delete&id=<?= $data['id']; ?>"><i class="fa fa-trash"></i></a></button></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>