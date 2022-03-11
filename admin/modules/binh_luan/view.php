<?
$submit = getValue('submit', 'str', 'POST', '');
if ($submit == 'add') {
    $comment = getValue('comment', 'str', 'POST', '');
    $id_product = getValue('id_product', 'int', 'POST',0);
    if ($id_product != 0) {
        $data = array(
            'id_product' => $id_product,
            'parent'    => $id,
            'isAdmin'   => $_SESSION["admin_id"],
            'name'      => $_SESSION['name'],
            'email'     => '',
            'phone'     => '',
            'gender'    => '',
            'comment'   => $comment,
            'created_time'  => time(),
            'modify_time'  => time(),
            'status'        => 1,
        );
        add('tbl_comments', $data);
        echo '
        <script language="javascript">
            window.parent.location.href="";
        </script>';
    }
    
}

?>
<?php $data = mysql_fetch_assoc($sql->result); ?>
<h1 class="h3 mb-2 text-gray-800 bb">Quản lý bình luận</h1>
<table class="table table-bordered">
    <thead>
        <tr>
            <td class="text-left" colspan="2">Chi tiết bình luận</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td class="text-left">
                <b>Mã sản phẩm:</b> #<?= $data['id_product'] ?><br>
                <b>Thời gian:</b> <?= date("H:i d/m/Y", $data['created_time']) ?>
            </td>
        </tr>
    </tbody>
</table>
<table class="table table-bordered ">
    <thead>
        <tr>
            <td class="text-left">Thông tin khách hàng</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <table style="width:100%">
                    <thead>
                        <td style="width:40%">Tên khách hàng</td>
                        <td style="width:20%">Số điện thoại</td>
                        <td style="width:30%">Email</td>
                        <td style="width:10%">Giới tính</td>
                    </thead>
                    <tbody>
                        <th><?= $data['name'] ?></th>
                        <th><?= ($data['phone'] != '')?$data['phone']:'Chưa cập nhật' ?></th>
                        <th><?= ($data['email'] != '')?$data['email']:'Chưa cập nhật' ?></th>
                        <th><?= ($data['gender'] == 1)?'Nam':'Nữ' ?></th>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>
<h4>Bình luận</h4>
<div class="show-comment">
    <div class="col-md-3 info-user">
        <div class="cmt-avatar">
            <img class=" lazyloaded" src="../pictures/users/Ellipse_83.png" data-src="../pictures/users/Ellipse_83.png" alt="Avtar user">
        </div>
        <div class="name-date-cmt-mobile">
            <p class="cmt-name"><?= $data['name'] ?></p>
            <div class="cmt-date-time">
                <span class="cmt-date"><?= date('d/m/Y',$data['created_time']) ?></span>
                <span class="cmt-time"><?= date('H:i',$data['created_time']) ?></span>
            </div>
        </div>
    </div>
    <div class="col-md-9 info-cmt">
        <p class="cmt-content"> <?= $data['comment'] ?></p>
        <div class="cmt-image <?= ($role['add'] == 0)?'mb-10':'' ?>">
            <? if($data['images'] != ''){ $image = explode(',', $data['images']);foreach ($image as $value) {?>
                <img src="../pictures/comment/<?= $value ?>" alt="comment image">    
            <?}}?>
        </div>
        <?= ($role['add'] != 0)?'<a href="javascript:void(0)" class="reply" data-toggle="modal" data-target="#quickModal">Trả lời</a>':'' ?>
        <? if(mysql_num_rows($query->result) > 0){
            while ($row = mysql_fetch_array($query->result)) { ?>
            <div class="show-reply d-flex">
                <div class="show-reply-left">
                    <div class="reply-avt">
                        <img class=" lazyloaded" src="../pictures/users/Ellipse_84.png" data-src="../pictures/users/Ellipse_84.png">
                    </div>
                    <div class="reply-cmt">
                        <p class="reply-cmt-name"><?= $row['name'] ?></p>
                        <p class="reply-cmt-content"><?= $row['comment'] ?></p>
                        <div class="cmt-date-time">
                            <span class="cmt-date"><?= date('d/m/Y',$row['created_time']) ?></span>
                            <span class="cmt-time"><?= date('H:i',$row['created_time']) ?></span>
                        </div>
                    </div>
                </div>
                <div class="delete">
                    <a href="?action=delete&id=<?= $row['id']?>"><i class="fa fa-times"></i></a>
                </div>
            </div>  
        <? }
        } ?>
    </div>
</div>

<!-- Modal reply -->
<div class="modal fade" id="quickModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content container-modal-form">
            <div class="modal-header">
                <h4 class="modal-title-form">Trả lời bình luận</h4>
                <button type="button" class="close modal-close-btn ml-auto" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
          </div>
          <div class="modal-body">
                <form method="POST">
                    <div class="form-group">
                        <textarea name="comment" type="text" id="editor" required class="form-control"></textarea>
                    </div>
                    <input type="hidden" name="id_product" value="<?= $data['id_product'] ?>">
                    <button type="submit" name="submit" value="add" class="btn btn-info">Bình luận</button>
                </form>
            </div>
      </div>
  </div>
</div>
<script type="text/javascript">
  CKEDITOR.replace('editor');
</script>