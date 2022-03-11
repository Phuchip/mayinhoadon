<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800 bb">Khổ giấy - <?= (isset($sql))?'Cập nhật':'Thêm mới' ?></h1>
<!-- DataTales Example -->
<?php if(isset($sql)){$data = mysql_fetch_array($sql->result);}
?>
<form method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Khổ giấy</label>
                    <input name="ten_hang" class="form-control" required value="<?= (isset($data))?$data['name']:'' ?>">
                </div>
            </div>
            <div class="col-md-2">
                <label>Trạng thái</label>
                <select name="status" class="form-control" required>
                    <? foreach ($trang_thai as $key => $value){ ?>
                    <option option value="<?=$value['id']?>" <?= (isset($data) && $data['status'] == $value['id'])?'selected':'' ?> ><?=$value['name']?></option>
                    <? } ?>
                </select>
            </div>
        </div>
        <div class="col-md-12 text-center">
            <?php if(isset($data)){ ?><input type="hidden" name="id" value="<?= $data['id'] ?>"><?php } ?>
            <?php if(isset($data)){ ?><input type="hidden" name="created_time" value="<?= $data['created_time'] ?>"><?php } ?>
            <button type="submit" class="btn btn-info" name="submit" value="<?= (isset($data))?'update':'add' ?>"><?= (isset($data))?'Cập nhật':'Thêm mới' ?></button>
        </div>
    </div>
</form>