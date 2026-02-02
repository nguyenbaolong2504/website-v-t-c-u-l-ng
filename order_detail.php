<!DOCTYPE html>
<html lang="vi">
<head>
    <title>Chi tiết đơn hàng #<?= $order['MaDonHang'] ?></title>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { background: #f0f2f5; font-family: 'Segoe UI', sans-serif; font-size: 14px; }
        .container { max-width: 900px; margin: 40px auto; }
        
        /* Card Hóa Đơn */
        .invoice-card { background: #fff; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); overflow: hidden; border: 1px solid #e5e5e5; }
        
        /* Header xanh */
        .invoice-header { background: #003366; color: white; padding: 20px 25px; display: flex; justify-content: space-between; align-items: center; }
        .invoice-title { font-weight: 700; font-size: 1.1rem; text-transform: uppercase; margin: 0; }
        
        /* Phần thông tin */
        .invoice-body { padding: 30px; }
        .info-box { margin-bottom: 25px; }
        .info-title { font-weight: 700; color: #003366; border-bottom: 2px solid #f0f0f0; padding-bottom: 8px; margin-bottom: 15px; font-size: 1rem; }
        
        .row-info { display: flex; margin-bottom: 8px; }
        .label-info { width: 130px; font-weight: 600; color: #666; }
        .val-info { flex: 1; color: #333; font-weight: 500; }

        /* Bảng sản phẩm */
        .table-custom { width: 100%; border-collapse: collapse; margin-top: 10px; }
        .table-custom th { background: #f8f9fa; text-align: left; padding: 12px; color: #555; font-weight: 600; border-bottom: 2px solid #eee; }
        .table-custom td { padding: 12px; border-bottom: 1px solid #eee; vertical-align: middle; }
        .table-custom tr:last-child td { border-bottom: none; }
        
        .prod-img-small { width: 50px; height: 50px; object-fit: cover; border-radius: 4px; border: 1px solid #ddd; margin-right: 10px; }
        
        /* Tổng tiền */
        .total-section { background: #f9f9f9; padding: 20px; text-align: right; border-top: 1px solid #eee; }
        .total-label { font-size: 1rem; color: #555; margin-right: 15px; }
        .total-amount { font-size: 1.4rem; color: #d0021b; font-weight: 800; }

        /* Trạng thái badge */
        .status-badge { padding: 6px 15px; border-radius: 50px; font-size: 0.85rem; font-weight: bold; background: rgba(255,255,255,0.2); border: 1px solid rgba(255,255,255,0.4); }
    </style>
</head>
<body>

    <nav class="navbar navbar-light bg-white shadow-sm mb-4">
        <div class="container-fluid px-4">
            <a class="navbar-brand text-dark fw-bold" href="index.php?action=history">
                <i class="fa fa-arrow-left me-2"></i> Quay lại danh sách
            </a>
        </div>
    </nav>

    <div class="container">
        
        <div class="invoice-card">
            <div class="invoice-header">
                <div>
                    <h5 class="invoice-title">Đơn hàng #<?= strtoupper(substr(md5($order['MaDonHang']), 0, 8)) ?></h5>
                    <small style="opacity: 0.8;">Ngày đặt: <?= date('d/m/Y - H:i', strtotime($order['NgayDat'])) ?></small>
                </div>
                <div>
                    <?php 
                        $stt = $order['TrangThai'];
                        $txt = ''; 
                        if($stt == 'ChoDuyet') $txt = 'Đã đặt hàng';
                        elseif($stt == 'DaThanhToan') $txt = 'Đã đặt hàng (Đã TT)';
                        elseif($stt == 'DangGiao') $txt = 'Đang giao hàng';
                        elseif($stt == 'DaGiao') $txt = 'Giao thành công';
                        elseif($stt == 'Huy') $txt = 'Đã hủy';
                    ?>
                    <span class="status-badge"><?= $txt ?></span>
                </div>
            </div>

            <div class="invoice-body">
                <div class="row">
                    <div class="col-md-6 info-box">
                        <h6 class="info-title"><i class="fa fa-user me-2"></i>Thông tin nhận hàng</h6>
                        <div class="row-info">
                            <span class="label-info">Người nhận:</span>
                            <span class="val-info"><?= $order['TenKH'] ?></span>
                        </div>
                        <div class="row-info">
                            <span class="label-info">Số điện thoại:</span>
                            <span class="val-info"><?= $order['SDT'] ?></span>
                        </div>
                        <div class="row-info">
                            <span class="label-info">Địa chỉ:</span>
                            <span class="val-info"><?= $order['DiaChi'] ?></span>
                        </div>
                    </div>

                    <div class="col-md-6 info-box">
                        <h6 class="info-title"><i class="fa fa-credit-card me-2"></i>Thanh toán & Ghi chú</h6>
                        <div class="row-info">
                            <span class="label-info">Phương thức:</span>
                            <span class="val-info">
                                <?= ($order['PhuongThucTT'] == 'momo') ? 'Ví điện tử MoMo' : 'Thanh toán khi nhận hàng (COD)' ?>
                            </span>
                        </div>
                        <div class="row-info">
                            <span class="label-info">Trạng thái TT:</span>
                            <span class="val-info">
                                <?php if($order['PhuongThucTT'] == 'momo' || $order['TrangThai'] == 'DaGiao' || $order['TrangThai'] == 'DaThanhToan'): ?>
                                    <span class="text-success fw-bold"><i class="fa fa-check-circle me-1"></i>Đã thanh toán</span>
                                <?php else: ?>
                                    <span class="text-warning fw-bold"><i class="fa fa-clock me-1"></i>Chưa thanh toán</span>
                                <?php endif; ?>
                            </span>
                        </div>
                        <div class="row-info">
                            <span class="label-info">Ghi chú:</span>
                            <span class="val-info fst-italic text-muted">
                                <?= !empty($order['GhiChu']) ? $order['GhiChu'] : 'Không có ghi chú' ?>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="info-box mt-2">
                    <h6 class="info-title"><i class="fa fa-box-open me-2"></i>Chi tiết sản phẩm</h6>
                    <table class="table-custom">
                        <thead>
                            <tr>
                                <th>Sản phẩm</th>
                                <th class="text-center">Đơn giá</th>
                                <th class="text-center">Số lượng</th>
                                <th class="text-end">Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($items as $item): ?>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <?php $img = !empty($item['HinhAnh']) ? "public/uploads/".$item['HinhAnh'] : "public/uploads/default.png"; ?>
                                        <img src="<?= $img ?>" class="prod-img-small">
                                        <span class="fw-bold text-dark"><?= $item['TenSP'] ?></span>
                                    </div>
                                </td>
                                <td class="text-center"><?= number_format($item['DonGia']) ?> ₫</td>
                                <td class="text-center">x<?= $item['SoLuong'] ?></td>
                                <td class="text-end fw-bold"><?= number_format($item['DonGia'] * $item['SoLuong']) ?> ₫</td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="total-section">
                <span class="total-label">Tổng thanh toán:</span>
                <span class="total-amount"><?= number_format($order['TongTien']) ?> ₫</span>
            </div>
        </div>

    </div>
</body>
</html>