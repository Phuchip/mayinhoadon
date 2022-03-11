<?
$filter = getValue('filter', 'str', 'GET', '');
$product = getValue('product', 'str', 'GET', '');
$stock = getValue('stock', 'str', 'GET', '');
$manu = getValue('manu', 'str', 'GET', '');
$cate = getValue('cate', 'str', 'GET', '');
$connect = getValue('connect', 'str', 'GET', '');
$paper = getValue('paper', 'str', 'GET', '');
$min = getValue('min', 'str', 'GET', '');
$max = getValue('max', 'str', 'GET', '');

$product = explode(',', $product);
$stock = explode(',', $stock);

$min = formatMoney($min);
$max = formatMoney($max);
$order = '';
$where = '';

if ($manu != '') {
    $where .= " AND manufacturer in (" . $manu . ")";
}
if ($cate != '') {
    $where .= " AND category in (" . $cate . ")";
}
if ($connect != '') {
    $where .= " AND connector in (" . $connect . ")";
}
if ($paper != '') {
    $where .= " AND paper_size in (" . $paper . ")";
}
if ($min != '' && $max != '') {
    $where .= "AND price_old BETWEEN '" . $min . "' AND '" . $max . "' ";
}
if ($stock != '') {
    foreach ($stock as $value) {
        if ($value == 'con_hang') {
            $where .= 'AND quantity > 0';
        } elseif ($value == 'lien_he') {
            $where .= 'AND contact > 0';
        }
    }
}

if ($filter != '') {
    if ($filter == 'hang_moi') {
        $order .= 'created_time DESC,';
    } elseif ($filter == 'xem_nhieu') {
        $order .= 'view DESC,';
    } elseif ($filter == 'giam_nhieu') {
        $order .= 'discount DESC,';
    } elseif ($filter == 'tang_dan') {
        $order .= 'price_old ASC,';
    } elseif ($filter == 'giam_dan') {
        $order .= 'price_old DESC,';
    }
}
if ($product != '') {
    foreach ($product as $value) {
        if ($value == 'danh_gia') {
            $order .= 'rate DESC,';
        } elseif ($value == 'ten_a_z') {
            $order .= 'name DESC,';
        }
    }
}
?>