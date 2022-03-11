<?php $data = mysql_fetch_assoc($sql->result); ?>
<h1 class="h3 mb-2 text-gray-800 bb">Đơn hàng</h1>
<table class="table table-bordered">
    <thead>
        <tr>
            <td class="text-left" colspan="2">Chi tiết đơn hàng</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td class="text-left" style="width: 50%;">
                <b>Mã đơn hàng:</b> #<?= $data['id'] ?><br>
                <b>Ngày tạo:</b> <?= date("H:i d/m/Y", $data['created_time']) ?>
            </td>
            <td class="text-left" style="width: 50%;">
                <b>Phương thức thanh toán:</b> Thanh toán khi nhận hàng<br>
                <b>Phương thức vận chuyển:</b> Chưa có
            </td>
        </tr>
    </tbody>
</table>
<table class="table table-bordered ">
    <thead>
        <tr>
            <td class="text-left">Thông tin đặt hàng</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <table style="width:100%">
                    <thead>
                        <td style="width:20%">Tên khách hàng</td>
                        <td style="width:20%">Số điện thoại</td>
                        <td style="width:30%">Email</td>
                        <td style="width:30%">Địa chỉ</td>
                    </thead>
                    <tbody>
                        <th><?= $data['name'] ?></th>
                        <th><?= $data['phone'] ?></th>
                        <th><?= $data['email'] ?></th>
                        <th><?= $data['address'] ?></th>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>
<table class="table table-bordered ">
    <thead>
        <tr>
            <td class="text-left">Thông tin giao hàng</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <table style="width:100%">
                    <thead>
                        <td style="width:20%">Tên người nhận</td>
                        <td style="width:20%">Số điện thoại</td>
                        <td style="width:30%">Địa chỉ</td>
                        <td style="width:30%">Ghi chú</td>
                    </thead>
                    <tbody>
                        <th><?= $data['ship_name'] ?></th>
                        <th><?= $data['ship_phone'] ?></th>
                        <th><?= $data['ship_address'] ?></th>
                        <th><?= $data['note'] ?></th>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>
<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <td class="text-left">Mã sản phẩm</td>
                <td class="text-left">Tên sản phẩm</td>
                <td class="text-right">Số lượng</td>
                <td class="text-right">Đơn giá</td>
                <td class="text-right">Tổng cộng</td>
            </tr>
        </thead>
        <tbody>
            <?php $subTotal = 0;
            while ($value = mysql_fetch_array($query->result)) { ?>
                <tr>
                    <td class="text-left"><?= $value['id']; ?>
                    </td>
                    <td class="text-left"><?= $value['name']; ?></td>
                    <td class="text-right"><?= $value['quantity']; ?></td>
                    <td class="text-right"><?= $value['price']; ?> đ</td>
                    <td class="text-right"><?= formatMoney($value['price'] * $value['quantity']); ?> đ</td>
                </tr>
            <?php $subTotal += $value['price'] * $value['quantity'];
            } ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3"></td>
                <td class="text-right"><b>Thành tiền</b></td>
                <td class="text-right"><?= formatMoney($subTotal) ?> đ</td>
            </tr>
            <tr>
                <td colspan="3"></td>
                <td class="text-right"><b>Phí vận chuyển</b></td>
                <td class="text-right" style="color: green"><i>Miễn phí</i></td>
            </tr>
            <tr>
                <td colspan="3"></td>
                <td class="text-right"><b>Tổng tiền</b></td>
                <td class="text-right"><?= $data['total'] ?> đ</td>
            </tr>
        </tfoot>
    </table>
</div>