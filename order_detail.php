<!DOCTYPE html>
<html lang="vi">
<head>
    <title>Chi tiết #<?= $order['MaDonHang'] ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f5f6fa; font-family: 'Segoe UI', sans-serif; }
        .main-content { margin: 30px auto; max-width: 900px; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
    </style>
</head>
<body>
    <div class="main-content">
        <a href="index.php?action=quanlydonhang" class="btn btn-outline-secondary mb-3">← Quay lại</a>
        <h3 class="mb-4 fw-bold">Chi tiết đơn hàng #<?= $order['MaDonHang'] ?></h3>

        <div class="row mb-4">
            <div class="col-md-6">
                <h5 class="text-primary fw-bold">Thông tin khách hàng</h5>
                <p class="mb-1"><strong>Họ tên:</strong> <?= $order['TenKH'] ?></p>
                <p class="mb-1"><strong>SĐT:</strong> <?= $order['SDT'] ?></p>
                <p class="mb-1"><strong>Địa chỉ:</strong> <?= $order['DiaChi'] ?></p>
                <p class="mb-1"><strong>Ngày đặt:</strong> <?= date('d/m/Y H:i', strtotime($order['NgayDat'])) ?></p>
            </div>
            <div class="col-md-6">
                <h5 class="text-primary fw-bold">Cập nhật trạng thái</h5>
                <form action="index.php?action=capnhatdonhang" method="POST" class="d-flex gap-2">
                    <input type="hidden" name="id" value="<?= $order['MaDonHang'] ?>">
                    <select name="TrangThai" class="form-select">
                        <option value="ChoDuyet" <?= ($order['TrangThai']=='ChoDuyet')?'selected':'' ?>>Chờ duyệt</option>
                        <option value="DangGiao" <?= ($order['TrangThai']=='DangGiao')?'selected':'' ?>>Đang giao</option>
                        <option value="DaGiao" <?= ($order['TrangThai']=='DaGiao')?'selected':'' ?>>Đã giao</option>
                        <option value="Huy" <?= ($order['TrangThai']=='Huy')?'selected':'' ?>>Hủy</option>
                    </select>
                    <button type="submit" class="btn btn-success">Lưu</button>
                </form>
            </div>
        </div>

        <h5 class="text-primary fw-bold">Danh sách sản phẩm</h5>
        <table class="table table-bordered">
            <thead class="table-light">
                <tr><th>Sản phẩm</th><th>Ảnh</th><th>Đơn giá</th><th>SL</th><th class="text-end">Thành tiền</th></tr>
            </thead>
            <tbody>
                <?php foreach($items as $item): ?>
                <tr>
                    <td><?= $item['TenSP'] ?></td>
                    <td>
                        <?php $img = (!empty($item['HinhAnh'])) ? "public/uploads/".$item['HinhAnh'] : "public/uploads/default.png"; ?>
                        <img src="<?= $img ?>" width="50">
                    </td>
                    <td><?= number_format($item['DonGia']) ?> đ</td>
                    <td class="text-center"><?= $item['SoLuong'] ?></td>
                    <td class="text-end fw-bold"><?= number_format($item['DonGia'] * $item['SoLuong']) ?> đ</td>
                </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="4" class="text-end fw-bold fs-5">TỔNG CỘNG:</td>
                    <td class="text-end fw-bold fs-5 text-danger"><?= number_format($order['TongTien']) ?> đ</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>