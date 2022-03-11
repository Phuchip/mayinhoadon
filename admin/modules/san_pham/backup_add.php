<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800 bb">Quản lý máy in - Thêm mới</h1>
<!-- DataTales Example -->
<?php if(isset($sql)){$data = mysql_fetch_array($sql->result);}
?>
<form method="POST" enctype="multipart/form-data">
  <div class="form-group">
    <div class="row">
      <div class="col-md-5">
        <label>Ảnh đại diện</label>
        <div class="avatar">
          <?php if(isset($data)){ ?> 
            <input type="hidden" name="avatar" value="<?= $data['image'] ?>">
            <img src="../../../images/item/<?= $data['image'] ?>" alt="<?= $data['name'] ?>"> 
          <?php } ?>
          <input type="file" name="anh" style="width: 100%;">
        </div>
      </div>
      <div class="col-md-5">
        <label>Thư viện ảnh</label>
        <?php if(isset($data)){ ?> 
            <input type="hidden" name="avatar" value="<?= $data['image'] ?>">
            <img src="../../../images/item/<?= $data['image'] ?>" alt="<?= $data['name'] ?>"> 
          <?php } ?>
        <input type="file" name="library[]" style="width: 100%;" multiple>
      </div>
      <div class="col-md-2">
        <label>Trạng thái</label>
        <select name="id_loai_may" class="form-control" required>
            <? foreach ($trang_thai as $key => $value){ ?>
              <option value="<?=$value['id']?>" <?= (isset($data) && $data['status'] == $value['id'])?'selected':'' ?> ><?=$value['name']?></option>
            <? } ?>
          </select>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label>Tên sản phẩm</label>
        <input name="ten_sp" class="form-control" required value="<?= (isset($data))?$data['name']:'' ?>">
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label>Loại máy in</label>
        <select name="id_loai_may" class="form-control" required>
          <option value="" >--- Chọn loại máy in ---</option>
            <? foreach ($loai_may as $key => $value){ ?>
              <option value="<?=$value['id']?>" <?= (isset($data) && $data['category'] == $value['id'])?'selected':'' ?> ><?=$value['name']?></option>
            <? } ?>
          </select>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label>Hãng sản xuất</label>
          <select name="id_hang_sx" class="form-control" required>
            <option value="" >--- Chọn hãng sản xuất ---</option>
            <? foreach ($hang_sx as $key => $value){ ?>
              <option value="<?=$value['id']?>" <?= (isset($data) && $data['category'] == $value['id'])?'selected':'' ?>><?=$value['name']?></option>
            <? } ?>
            </select>
          </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label>Cổng kết nối</label>
          <select name="id_nxb" class="form-control" required>
            <option value="" >--- Chọn cổng kết nối ---</option>
            <? foreach ($ket_noi as $key => $value){ ?>
              <option value="<?=$value['id']?>" <?= (isset($data) && $data['category'] == $value['id'])?'selected':'' ?>><?=$value['name']?></option>
            <? } ?>
          </select>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label>Khổ giấy</label>
          <select name="id_nxb" class="form-control" required>
            <option value="" >--- Chọn khổ giấy ---</option>
            <? foreach ($kho_giay as $key => $value){ ?>
              <option value="<?=$value['id']?>" <?= (isset($data) && $data['category'] == $value['id'])?'selected':'' ?>><?=$value['name']?></option>
            <? } ?>
          </select>
        </div>
      </div>
      <div class="col-md-12">
        <div class="form-group">
          <div class="row">
            <div class="col-md-4"> 
              <label>Giá cũ</label>
              <input name="gia_cu" type="text" class="form-control" placeholder="VNĐ" value="<?= (isset($data))?$data['price_old'].'đ':'' ?>">
            </div>
            <div class="col-md-4"> 
              <label>Giá mới</label>
              <input name="gia_moi" type="text" class="form-control" placeholder="VNĐ" value="<?= (isset($data))?price_new($data['price_old'],$data['discount']).'đ':'' ?>">
            </div>
            <div class="col-md-4"> 
              <label>Giảm giá</label>
              <input name="giam_gia" type="text" class="form-control" placeholder="%" value="<?= (isset($data))?$data['discount'].'%':'' ?>">
            </div> 
          </div>
        </div>
      </div>
      <div class="col-md-12">
        <div class="form-group">
          <div class="row">
            <div class="col-md-4">
              <label>Công nghệ : </label>
              <input name="cong_nghe" type="text" class="form-control" value="<?= (isset($data))?$data['cong_nghe']:'' ?>">
            </div>
            <div class="col-md-4">
              <label>Độ phân giải : </label>
              <input name="do_phan_giai" type="text" class="form-control" value="<?= (isset($data))?$data['do_phan_giai']:'' ?>">
            </div>
            <div class="col-md-4">
              <label>Khổ in : </label>
              <input name="kho_in" type="text" class="form-control" value="<?= (isset($data))?$data['kho_in']:'' ?>">
            </div>
            <div class="col-md-4">
              <label>Tốc độ tối đa: </label>
              <input name="toc_do" type="text" class="form-control" value="<?= (isset($data))?$data['toc_do']:'' ?>">
            </div>
            <div class="col-md-4">
              <label>Khổ giấy in : </label>
              <input name="kho_giay_in" type="text" class="form-control" value="<?= (isset($data))?$data['kho_giay_in']:'' ?>">
            </div>
            <div class="col-md-4">
              <label>Mô tả thêm : </label>
              <input name="mo_ta_them" type="text" class="form-control" value="<?= (isset($data))?$data['mo_ta']:'' ?>">
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-12">
        <div class="form-group">
          <div class="row brand">
            <div class="col-md-6 row" style="margin-bottom: 10px;">
              <div class="col-md-6">
                <label>Thương hiệu : </label>
                <input name="thuong_hieu" type="text" class="form-control" value="<?= (isset($data))?$data['thuong_hieu']:'' ?>">
              </div>
              <div class="col-md-6">
                <label>Model : </label>
                <input name="model" type="text" class="form-control" value="<?= (isset($data))?$data['model']:'' ?>">
              </div>
              <div class="col-md-12">
                <label>Kết nối : </label>
                <input name="ket_noi" type="text" class="form-control" value="<?= (isset($data))?$data['ket_noi']:'' ?>">
              </div>
            </div>
            <div class="col-md-6" >
              <label>Tính năng : </label>
              <textarea name="tinh_nang" id="" class="form-control" style="height: 100px;" cols="30" rows="10"><?= (isset($data))?$data['tinh_nang']:'' ?></textarea>
              <!-- <input name="" type="text" class="form-control" style="height: 100px;" value=""> -->
            </div>
            
            <div class="col-md-3">
              <label>Tốc độ in : </label>
              <input name="toc_do_in" type="text" class="form-control" value="<?= (isset($data))?$data['toc_do_in']:'' ?>">
            </div>
            <div class="col-md-3">
              <label>Kích cỡ : </label>
              <input name="kich_co" type="text" class="form-control" value="<?= (isset($data))?$data['kich_co']:'' ?>">
            </div>
            <div class="col-md-3">
              <label>Trọng lượng : </label>
              <input name="trong_luong" type="text" class="form-control" value="<?= (isset($data))?$data['trong_luong']:'' ?>">
            </div>
            <div class="col-md-3">
              <label>Xuất xứ : </label>
              <input name="xuat_xu" type="text" class="form-control" value="<?= (isset($data))?$data['xuat_xu']:'' ?>">
            </div>
            <div class="col-md-6">
              <label>Bảo hành : </label>
              <input name="bao_hanh" type="text" class="form-control" placeholder="tháng" value="<?= (isset($data))?$data['bao_hanh']:'' ?>">
            </div>
            <div class="col-md-3">
              <label>Mã sản phẩm</label>
              <input type="text" name="code_product" class="form-control" value="<?= (isset($data))?$data['code_product']:'' ?>">
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-12">
        <div class="form-group">
          <label>Đánh giá sản phẩm</label>
          <textarea name="danh_gia" type="text" id="editor" class="form-control"><?= (isset($data))?$data['review_product']:'' ?></textarea>
        </div>
      </div>
      <div class="col-md-12 text-center">
        <button type="submit" class="btn btn-info" name="submit" value="<?= (isset($data))?'update':'add' ?>"><?= (isset($data))?'Cập nhật':'Thêm mới' ?></button>
      </div>
    </div>
  </form>
<script type="text/javascript">CKEDITOR.replace('editor');</script>