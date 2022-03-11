<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800 bb">Tài khoản - <?= (isset($sql))?'Cập nhật':'Thêm mới' ?></h1>
<!-- DataTales Example -->
<?php if(isset($sql)){$data = mysql_fetch_array($sql->result);}
?>
<form method="POST" id="form_account" enctype="multipart/form-data" onsubmit="return false" novalidate="novalidate">
<div class="form-group info">
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label>Tên đăng nhập</label>
                    <input id="username" name="username" class="form-control" required>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Mật khẩu</label>
                    <input id="password" name="password" class="form-control" required>
                </div>
            </div>
            <div class="col-md-3">
                <label>Trạng thái</label>
                <select id="status" name="status" class="form-control" required>
                    <? foreach ($trang_thai as $key => $value){ ?>
                    <option option value="<?=$value['id']?>"><?=$value['name']?></option>
                    <? } ?>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="info-first">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Họ tên</label>
                            <input id="name" name="name" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6 ">
                        <div class="form-group">
                            <label>Số điện thoại</label>
                            <div class="validate">
                                <input id="phone" name="phone" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="info-second">
                    <div class="col-md-6 ">
                        <div class="form-group">
                            <label>Email</label>
                            <input id="email" name="email" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6 ">
                        <div class="form-group">
                            <label>Địa chỉ</label>
                            <input name="address" id="address" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Mô tả</label>
                        <textarea name="sapo" id="sapo" class="form-control" style="height: 120px;" cols="30" rows="10"></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <label>Phân quyền</label>
                <div>
                    <input type="checkbox" id='all_role'>
                    <label>Chọn toàn quyền</label>
                </div>
                <table class="table table-bordered dataTable">
                    <thead>
                        <tr>
                            <td class="col-md-4">Modules</td>
                            <td class="col-md-2">Xem</td>
                            <td class="col-md-2">Thêm mới</td>
                            <td class="col-md-2">Sửa</td>
                            <td class="col-md-2">Xóa</td>
                        </tr>
                    </thead>
                    <tbody>
                        <? foreach ($array_modules as $key => $value){ ?>
                        <tr data-id="<?= $value['id'] ?>" class="module">
                            <td><?= $value['name'] ?></td>
                            <td><input type="checkbox" value="1"></td>
                            <td><input type="checkbox" value="2"></td>
                            <td><input type="checkbox" value="3"></td>
                            <td><input type="checkbox" value="4"></td>
                        </tr>
                        <? }?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-12 text-center">
            <button type="submit" id="btn_form" class="btn btn-info" name="submit" value="<?= (isset($data))?'update':'add' ?>"><?= (isset($data))?'Cập nhật':'Thêm mới' ?></button>
        </div>
    </div>
</form>