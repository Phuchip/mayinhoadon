<?php
$submit = getValue('submit', 'str', 'POST', '');
if ($submit == 'update') {
  $id = getValue('id', 'int', 'POST', 0);
  $id_loai_may = getValue('id_loai_may', 'int', 'POST', 0);
  $id_hang_sx = getValue('id_hang_sx', 'int', 'POST', 0);
  $cong_ket_noi = getValue('cong_ket_noi', 'int', 'POST', 0);
  $kho_giay = getValue('kho_giay', 'int', 'POST', 0);
  $giam_gia = getValue('giam_gia', 'int', 'POST', 0);
  $so_luong = getValue('so_luong', 'int', 'POST', 0);
  $insurance = getValue('insurance', 'int', 'POST', 0);
  $status = getValue('status', 'int', 'POST', 0);
  $contact = getValue('contact', 'int', 'POST', 0);

  $id = (int)$id;
  $id_loai_may = (int)$id_loai_may;
  $id_hang_sx = (int)$id_hang_sx;
  $kho_giay = (int)$kho_giay;
  $so_luong = (int)$so_luong;
  $insurance = (int)$insurance;
  $status = (int)$status;
  $contact = (int)$contact;

  $ten_sp = getValue('ten_sp', 'str', 'POST', '');
  $gia_cu = getValue('gia_cu', 'str', 'POST', '');
  $gia_moi = getValue('gia_moi', 'str', 'POST', '');
  $cong_nghe = getValue('cong_nghe', 'str', 'POST', '');
  $do_phan_giai = getValue('do_phan_giai', 'str', 'POST', '');
  $kho_in = getValue('kho_in', 'str', 'POST', '');
  $toc_do = getValue('toc_do', 'str', 'POST', '');
  $kho_giay_in = getValue('kho_giay_in', 'str', 'POST', '');
  $mo_ta_them = getValue('mo_ta_them', 'str', 'POST', '');
  $thuong_hieu = getValue('thuong_hieu', 'str', 'POST', '');
  $model = getValue('model', 'str', 'POST', '');
  $ket_noi = getValue('ket_noi', 'str', 'POST', '');
  $tinh_nang = getValue('tinh_nang', 'str', 'POST', '');
  $toc_do_in = getValue('toc_do_in', 'str', 'POST', '');
  $kich_co = getValue('kich_co', 'str', 'POST', '');
  $trong_luong = getValue('trong_luong', 'str', 'POST', '');
  $xuat_xu = getValue('xuat_xu', 'str', 'POST', '');
  $bao_hanh = getValue('bao_hanh', 'str', 'POST', '');
  $code_product = getValue('code_product', 'str', 'POST', '');
  $title = getValue('title', 'str', 'POST', '');
  $description = getValue('description', 'str', 'POST', '');
  $keyword = getValue('keyword', 'str', 'POST', '');

  $tag = getValue('tag', 'arr', 'POST', '');
  $tag = implode(',', $tag);

  $cong_ket_noi = getValue('cong_ket_noi', 'arr', 'POST', '');
  $danh_gia = getValue('danh_gia', 'str', 'POST', '');

  $tinh_nang = json_encode($tinh_nang);
  $tinh_nang = str_replace('\r\n', '|', $tinh_nang);
  $tinh_nang = json_decode($tinh_nang);

  $avatar = (isset($_FILES['anh'])) ? $_FILES['anh'] : "";
  $files = (isset($_FILES['library'])) ? $_FILES['library'] : "";

  $cong_ket_noi = implode(',', $cong_ket_noi);
  $arr = [];
  $path = "../../../images/item";

  $sql = new db_query("SELECT id, alias,image,des_images FROM tbl_product WHERE id = " . $id);
  $db_qr = mysql_fetch_assoc($sql->result);
  $alias = $db_qr['alias'];
  $f_name = $path . "/" . $alias;
  $image = $db_qr['image'];
  $list_images = $db_qr['des_images'];
  $maxSize = 5000000;
  if ($avatar['name'] != '') {
    if ($avatar['size'] < $maxSize) {
      $link_avatar = $path . '/' . $image;
      unlink($link_avatar);
      // Upload avatar
      $avatar_name = $f_name . "/" . $avatar['name'];
      if (move_uploaded_file($avatar['tmp_name'], $avatar_name) && $avatar['name'] != '') {
        $new_avatar_name = $alias;
        $full_path_avatar_new = $f_name . "/" . $new_avatar_name . ".png";
        rename($avatar_name, $full_path_avatar_new);
        $image = str_replace($path . "/", '', $full_path_avatar_new);
      }
    } else {
      echo '
      <script language="javascript">
          window.alert("Vui lòng chọn kích thước ảnh nhỏ hơn 10mb");
          window.history.back();
      </script>';
      exit;
    }
  }
  if ($files['name'][0] != '') {
    $list_images_old = explode(',', $list_images);
    foreach ($list_images_old as $key => $value) {
      $link = $path . '/' . $value;
      unlink($link);
    }
    for ($i = 0; $i < count($files['name']); $i++) {
      $size = $files['size'][$i];
      if ($size < $maxSize) {
        $full_path = $f_name . "/" . $files['name'][$i];
        if (move_uploaded_file($files['tmp_name'][$i], $full_path) && $files['name'][$i] != '') {
          $new_name = $alias . '-' . $i;
          $full_path_new = $f_name . "/" . $new_name . ".png";
          rename($full_path, $full_path_new);
          array_push($arr, str_replace($path . "/", '', $full_path_new)); /* Add item */
        }
      } else {
        echo '
        <script language="javascript">
            window.alert("Vui lòng chọn kích thước ảnh nhỏ hơn 10mb");
            window.history.back();
        </script>';
      }
    }
    $list_images = implode(',', $arr);
  }
  $data = array(
    'name'            => $ten_sp,
    'image'           => $image,
    'price_old'       => $gia_cu,
    'discount'        => $giam_gia,
    'code_product'    => $code_product,
    'quantity'        => $so_luong,
    'des_images'      => $list_images,
    'insurance'       => $insurance,
    'category'        => $id_loai_may,
    'manufacturer'    => $id_hang_sx,
    'connector'       => $cong_ket_noi,
    'paper_size'      => $kho_giay,
    'review_product'  => $danh_gia,
    'cong_nghe'       => $cong_nghe,
    'do_phan_giai'    => $do_phan_giai,
    'kho_in'          => $kho_in,
    'toc_do'          => $toc_do,
    'kho_giay_in'     => $kho_giay_in,
    'mo_ta'           => $mo_ta_them,
    'thuong_hieu'     => $thuong_hieu,
    'model'           => $model,
    'tinh_nang'       => $tinh_nang,
    'ket_noi'         => $ket_noi,
    'toc_do_in'       => $toc_do_in,
    'kich_co'         => $kich_co,
    'trong_luong'     => $trong_luong,
    'xuat_xu'         => $xuat_xu,
    'bao_hanh'        => $bao_hanh,
    'tag'             => $tag,
    'contact'         => $contact,
    'title'           => $title,
    'description'     => $description,
    'keyword'         => $keyword,
    'modify_time'     => time(),
    'status'          => $status,
  );
  $condition = ['id' => $id];
  update('tbl_product', $data, $condition);
  echo '
    <script language="javascript">
        window.alert("Cập nhật sản phẩm thành công");
        window.parent.location.href="./san-pham";
    </script>';
}
?>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800 bb">Quản lý máy in - Cập nhật</h1>
<!-- DataTales Example -->
<?php if (isset($sql)) {
  $data = mysql_fetch_array($sql->result);
}
?>
<form method="POST" enctype="multipart/form-data" class="product">
  <div class="col-md-9">

    <div class="form-group">
      <div class="row">
        <div class="col-md-12">
          <label>Ảnh đại diện</label>
          <div class="avatar">
            <?php if (isset($data)) { ?>
              <img src="../../../images/item/<?= $data['image'] ?>" alt="<?= $data['name'] ?>">
            <?php } ?>
            <input type="file" name="anh" style="width: 100%;">
          </div>
        </div>
        <div class="col-md-12">
          <label>Thư viện ảnh</label>
          <div class="avatar">
            <div class="list_image">
              <?php if (isset($data)) {
                $list_image = explode(',', $data['des_images']);
                foreach ($list_image as $key => $value) { ?>
                  <img src="../../../images/item/<?= $value; ?>" alt="<?= $data['name'] ?>">
              <?php }
              } ?>
            </div>
            <input type="file" name="library[]" style="width: 100%;" multiple>
          </div>
        </div>
        <div class="col-md-3">
          <label>Mã sản phẩm</label>
          <input type="text" required name="code_product" class="form-control" value="<?= (isset($data)) ? $data['code_product'] : '' ?>">
        </div>
        <div class="col-md-3">
          <label>Liên hệ</label>
          <select name="contact" class="form-control" required>
            <? foreach ($lien_he as $key => $value) { ?>
              <option value="<?= $value['id'] ?>" <?= (isset($data) && $data['contact'] == $value['id']) ? 'selected' : '' ?>><?= $value['name'] ?></option>
            <? } ?>
          </select>
        </div>
        <div class="col-md-3">
          <label>Hiển thị</label>
          <select name="status" class="form-control" required>
            <? foreach ($trang_thai as $key => $value) { ?>
              <option value="<?= $value['id'] ?>" <?= (isset($data) && $data['status'] == $value['id']) ? 'selected' : '' ?>><?= $value['name'] ?></option>
            <? } ?>
          </select>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <label>Tên sản phẩm</label>
          <input name="ten_sp" class="form-control" required value="<?= (isset($data)) ? $data['name'] : '' ?>">
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label>Loại máy in</label>
          <select name="id_loai_may" class="form-control select" required>
            <option value="">--- Chọn loại máy in ---</option>
            <? foreach ($array_loai_may as $key => $value) { ?>
              <option value="<?= $value['id'] ?>" <?= (isset($data) && $data['category'] == $value['id']) ? 'selected' : '' ?>><?= $value['name'] ?></option>
            <? } ?>
          </select>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label>Hãng sản xuất</label>
          <select name="id_hang_sx" class="form-control select" required>
            <option value="">--- Chọn hãng sản xuất ---</option>
            <? foreach ($array_hang_sx as $key => $value) { ?>
              <option value="<?= $value['id'] ?>" <?= (isset($data) && $data['manufacturer'] == $value['id']) ? 'selected' : '' ?>><?= $value['name'] ?></option>
            <? } ?>
          </select>
        </div>
      </div>
      <?php $connector = $data['connector'];
      $connector = explode(',', $connector);
      ?>
      <div class="col-md-6">
        <div class="form-group">
          <label>Cổng kết nối</label>
          <select name="cong_ket_noi[]" class="form-control select" multiple="multiple" required>
            <option value="">--- Chọn cổng kết nối ---</option>
            <? foreach ($array_ket_noi as $key => $value) { ?>
              <option value="<?= $value['id'] ?>" <?= (in_array($value['id'], $connector)) ? 'selected' : '' ?>><?= $value['name'] ?></option>
            <? } ?>
          </select>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label>Khổ giấy</label>
          <select name="kho_giay" class="form-control select" required>
            <option value="">--- Chọn khổ giấy ---</option>
            <? foreach ($array_kho_giay as $key => $value) { ?>
              <option value="<?= $value['id'] ?>" <?= (isset($data) && $data['paper_size'] == $value['id']) ? 'selected' : '' ?>><?= $value['name'] ?></option>
            <? } ?>
          </select>
        </div>
      </div>
      <div class="col-md-12">
        <div class="form-group">
          <div class="row">
            <div class="col-md-4">
              <label>Giá cũ</label>
              <input name="gia_cu" id="price_old" required type="text" class="form-control" placeholder="VNĐ" value="<?= (isset($data)) ? $data['price_old'] : '' ?>">
            </div>
            <div class="col-md-4">
              <label>Giảm giá</label>
              <input name="giam_gia" id="discount" type="number" class="form-control" placeholder="%" value="<?= (isset($data)) ? $data['discount'] : '' ?>">
            </div>
            <div class="col-md-4">
              <label>Giá mới</label>
              <input name="gia_moi" id="price_new" type="text" readonly class="form-control" placeholder="VNĐ" value="<?= (isset($data)) ? price_new($data['price_old'], $data['discount']) : '' ?>">
            </div>

          </div>
        </div>
      </div>
      <div class="col-md-12">
        <div class="form-group">
          <div class="row">
            <div class="col-md-4">
              <label>Số lượng</label>
              <input name="so_luong" type="number" required class="form-control" value="<?= (isset($data)) ? $data['quantity'] : '' ?>">
            </div>
            <div class="col-md-4">
              <label>Bảo hành</label>
              <input name="insurance" type="number" required class="form-control" value="<?= (isset($data)) ? $data['insurance'] : '' ?>">
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-12">
        <h3>Thông tin sản phẩm</h3>
        <div class="form-group">
          <div class="row">
            <div class="col-md-6">
              <label>Công nghệ : </label>
              <input name="cong_nghe" type="text" class="form-control" value="<?= (isset($data)) ? $data['cong_nghe'] : '' ?>">
            </div>
            <div class="col-md-6">
              <label>Độ phân giải : </label>
              <input name="do_phan_giai" type="text" class="form-control" value="<?= (isset($data)) ? $data['do_phan_giai'] : '' ?>">
            </div>
            <div class="col-md-6">
              <label>Khổ in : </label>
              <input name="kho_in" type="text" class="form-control" value="<?= (isset($data)) ? $data['kho_in'] : '' ?>">
            </div>
            <div class="col-md-6">
              <label>Tốc độ tối đa: </label>
              <input name="toc_do" type="text" class="form-control" value="<?= (isset($data)) ? $data['toc_do'] : '' ?>">
            </div>
            <div class="col-md-6">
              <label>Khổ giấy in : </label>
              <input name="kho_giay_in" type="text" class="form-control" value="<?= (isset($data)) ? $data['kho_giay_in'] : '' ?>">
            </div>
            <div class="col-md-6">
              <label>Mô tả thêm : </label>
              <input name="mo_ta_them" type="text" class="form-control" value="<?= (isset($data)) ? $data['mo_ta'] : '' ?>">
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-12">
        <h3>Thông số chi tiết</h3>
        <div class="form-group">
          <div class="row">
            <div class="col-md-6">
              <label>Thương hiệu : </label>
              <input name="thuong_hieu" type="text" class="form-control" value="<?= (isset($data)) ? $data['thuong_hieu'] : '' ?>">
            </div>
            <div class="col-md-6">
              <label>Model : </label>
              <input name="model" type="text" class="form-control" value="<?= (isset($data)) ? $data['model'] : '' ?>">
            </div>
            <div class="col-md-12">
              <label>Kết nối : </label>
              <input name="ket_noi" type="text" class="form-control" value="<?= (isset($data)) ? $data['ket_noi'] : '' ?>">
            </div>
            <div class="col-md-12">
              <label>Tính năng : </label>
              <textarea name="tinh_nang" id="" class="form-control" style="height: 150px;" cols="30" rows="10"><?= (isset($data)) ? trim(str_replace('|', '&#010', $data['tinh_nang'])) : '' ?></textarea>
            </div>

            <div class="col-md-6">
              <label>Tốc độ in : </label>
              <input name="toc_do_in" type="text" class="form-control" value="<?= (isset($data)) ? $data['toc_do_in'] : '' ?>">
            </div>
            <div class="col-md-6">
              <label>Kích cỡ : </label>
              <input name="kich_co" type="text" class="form-control" value="<?= (isset($data)) ? $data['kich_co'] : '' ?>">
            </div>
            <div class="col-md-6">
              <label>Trọng lượng : </label>
              <input name="trong_luong" type="text" class="form-control" value="<?= (isset($data)) ? $data['trong_luong'] : '' ?>">
            </div>
            <div class="col-md-6">
              <label>Xuất xứ : </label>
              <input name="xuat_xu" type="text" class="form-control" value="<?= (isset($data)) ? $data['xuat_xu'] : '' ?>">
            </div>
            <div class="col-md-12">
              <label>Bảo hành : </label>
              <input name="bao_hanh" type="text" class="form-control" value="<?= (isset($data)) ? $data['bao_hanh'] : '' ?>">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-3"></div>
  <div class="col-md-12">
    <div class="form-group">
      <label>Đánh giá sản phẩm</label>
      <textarea name="danh_gia" type="text" required id="editor" class="form-control"><?= (isset($data)) ? $data['review_product'] : '' ?></textarea>
    </div>
  </div>
  <?php $tag = $data['tag'];
  $tag = explode(',', $tag);
  ?>
  <div class="col-md-12">
    <div class="form-group tag">
      <label>Tag :</label>
      <select name="tag[]" class="form-control select" multiple="multiple" required>
        <? foreach ($array_tag as $key => $value) { ?>
          <option value="<?= $value['id'] ?>" <?= (in_array($value['id'], $tag)) ? 'selected' : '' ?>><?= $value['name'] ?></option>
        <? } ?>
      </select>
    </div>
  </div>
  <div class="col-md-12">
    <h3>SEO</h3>
    <div class="form-group">
      <div class="row">
        <div class="col-md-12">
          <label>Title : </label>
          <input name="title" type="text" required class="form-control" value="<?= (isset($data)) ? $data['title'] : '' ?>">
        </div>
        <div class="col-md-12">
          <label>Description (tối đa 160 ký tự): </label>
          <input name="description" maxlength="160" required type="text" class="form-control" value="<?= (isset($data)) ? $data['description'] : '' ?>">
        </div>
        <div class="col-md-12">
          <label>Keyword : </label>
          <input name="keyword" type="text" required class="form-control" value="<?= (isset($data)) ? $data['keyword'] : '' ?>">
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-12 text-center">
    <?php if (isset($data)) { ?><input type="hidden" name="id" value="<?= $data['id'] ?>"><?php } ?>
    <button type="submit" class="btn btn-info" name="submit" value="<?= (isset($data)) ? 'update' : 'add' ?>"><?= (isset($data)) ? 'Cập nhật' : 'Thêm mới' ?></button>
  </div>
</form>
<script type="text/javascript">
  CKEDITOR.replace('editor');
</script>