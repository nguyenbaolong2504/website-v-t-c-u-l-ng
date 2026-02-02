<?php include __DIR__ . '/sidebar.php'; ?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý Đơn hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { background-color: #f5f6fa; font-family: 'Segoe UI', sans-serif; font-size: 15px; }
        
        .main-content { margin-left: 250px; padding: 25px; }
        
        /* STYLE KHUNG BAO NGOÀI */
        .card-custom { 
            background: white; 
            border-top: 3px solid #3c8dbc; 
            box-shadow: 0 1px 3px rgba(0,0,0,0.1); 
            padding: 20px; 
            border-radius: 3px; 
        }

        /* CARD ĐƠN HÀNG */
        .order-card { background: #fff; border: 1px solid #e1e4e8; border-radius: 6px; margin-bottom: 20px; overflow: hidden; }
        .card-header { padding: 15px 20px; border-bottom: 1px solid #eee; display: flex; justify-content: space-between; align-items: center; background: #fafafa; }
        .total-price { font-size: 1.3rem; color: #d63031; font-weight: 800; margin-right: 15px; }
        
        /* SELECT BOX TRẠNG THÁI */
        .status-select { 
            padding: 5px 10px; 
            border-radius: 4px; 
            font-weight: 700; /* Chữ đậm */
            cursor: pointer; 
            background: white; 
            min-width: 150px;
            border-width: 1px;
            border-style: solid;
        }
        
        .col-title { font-size: 0.75rem; font-weight: 700; text-transform: uppercase; color: #999; margin-bottom: 15px; border-bottom: 1px solid #eee; padding-bottom: 5px; display: block; letter-spacing: 0.5px; }
        .product-item { display: flex; gap: 15px; margin-bottom: 15px; align-items: center; }
        .prod-img { width: 55px; height: 55px; border-radius: 4px; object-fit: cover; border: 1px solid #eee; }
        .prod-name { font-size: 0.95rem; font-weight: 600; color: #333; line-height: 1.3; margin-bottom: 2px; }
        .pay-status { padding: 6px 12px; border-radius: 20px; font-size: 0.8rem; font-weight: bold; display: inline-block; }
        .bg-paid { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .bg-unpaid { background: #fff3cd; color: #856404; border: 1px solid #ffeeba; }
        
        .btn-trash { color: #dc3545; border: 1px solid #dc3545; padding: 5px 10px; border-radius: 4px; transition: 0.2s; }
        .btn-trash:hover { background: #dc3545; color: white; }
    </style>
</head>
<body>

<div class="main-content">
    <h4 class="mb-4 fw-bold text-uppercase"><i class="fas fa-file-invoice-dollar me-2"></i> Quản lý đơn hàng</h4>

    <div class="card-custom">
        <div class="mb-4">
            <form action="index.php" method="GET" class="input-group" style="max-width: 600px;">
                <input type="hidden" name="action" value="quanlydonhang">
                <input type="text" name="keyword" class="form-control" 
                       placeholder="Tìm mã đơn, tên khách hàng hoặc SĐT..." 
                       value="<?= isset($_GET['keyword']) ? htmlspecialchars($_GET['keyword']) : '' ?>">
                <button class="btn btn-primary fw-bold" type="submit">
                    <i class="fas fa-search"></i> Tìm
                </button>
            </form>
        </div>

        <div class="order-list">
            <?php if(!empty($orders)): ?>
                <?php foreach($orders as $data): ?>
                    <?php 
                        $o = $data['info']; 
                        $items = $data['items'];
                        $isPaid = ($o['PhuongThucTT'] == 'momo' || $o['TrangThai'] == 'DaGiao' || $o['TrangThai'] == 'DaThanhToan');
                        $displayNote = ($o['PhuongThucTT'] != 'momo' && $o['TrangThai'] == 'DaGiao') ? "Đã thu tiền mặt (COD)" : "";
                        $totalQty = 0; foreach($items as $item) $totalQty += $item['SoLuong'];

                        // --- XỬ LÝ MÀU SẮC TRẠNG THÁI (ĐÃ SỬA THEO YÊU CẦU) ---
                        $statusStyle = "border-color: #ced4da; color: #333;"; // Mặc định
                        
                        if ($o['TrangThai'] == 'ChoDuyet') {
                            // MÀU CAM cho "Đã đặt hàng"
                            $statusStyle = "border-color: #fd7e14; color: #fd7e14;"; 
                        } 
                        elseif ($o['TrangThai'] == 'DangGiao') {
                            // Màu xanh dương cho "Đang giao"
                            $statusStyle = "border-color: #0dcaf0; color: #0dcaf0;";
                        } 
                        elseif ($o['TrangThai'] == 'DaGiao') {
                            // Màu xanh lá cho "Đã giao"
                            $statusStyle = "border-color: #198754; color: #198754;";
                        } 
                        elseif ($o['TrangThai'] == 'Huy') {
                            // Màu đỏ cho "Đã hủy"
                            $statusStyle = "border-color: #dc3545; color: #dc3545;";
                        }
                    ?>

                <div class="order-card">
                    <div class="card-header">
                        <div>
                            <div class="fw-bold fs-5 text-dark">
                                <i class="fas fa-receipt text-primary me-2"></i> #<?= strtoupper(substr(md5($o['MaDonHang']), 0, 8)) ?>
                            </div>
                            <div class="text-muted small mt-1">
                                <i class="far fa-clock me-1"></i> <?= date('d/m/Y - H:i', strtotime($o['NgayDat'])) ?>
                            </div>
                        </div>

                        <div class="d-flex align-items-center">
                            <div class="total-price"><?= number_format($o['TongTien']) ?> ₫</div>
                            
                            <form action="index.php?action=capnhatdonhang" method="POST" class="d-flex align-items-center m-0">
                                <input type="hidden" name="id" value="<?= $o['MaDonHang'] ?>">
                                
                                <select name="TrangThai" class="status-select me-2 form-select form-select-sm" 
                                        onchange="this.form.submit()" 
                                        style="<?= $statusStyle ?>">
                                    <option value="ChoDuyet" <?= ($o['TrangThai'] == 'ChoDuyet') ? 'selected' : '' ?>> ● Đã đặt hàng</option>
                                    <option value="DangGiao" <?= ($o['TrangThai'] == 'DangGiao') ? 'selected' : '' ?>> ● Đang giao hàng</option>
                                    <option value="DaGiao" <?= ($o['TrangThai'] == 'DaGiao') ? 'selected' : '' ?>> ● Đã giao hàng</option>
                                    <option value="Huy" <?= ($o['TrangThai'] == 'Huy') ? 'selected' : '' ?>> ● Đã hủy</option>
                                </select>
                            </form>

                            <a href="index.php?action=xoadonhang&id=<?= $o['MaDonHang'] ?>" 
                               class="btn-trash ms-2"
                               onclick="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này không?');"
                               title="Xóa đơn hàng">
                                <i class="fas fa-trash"></i>
                            </a>
                        </div>
                    </div>

                    <div class="p-4 row">
                        <div class="col-md-5" style="border-right: 1px solid #eee;">
                            <div class="col-title"><?= $totalQty ?> SẢN PHẨM | CHI TIẾT ĐƠN HÀNG</div>
                            <div style="max-height: 180px; overflow-y: auto; padding-right: 10px;">
                                <?php foreach($items as $item): ?>
                                <div class="product-item">
                                    <?php $img = !empty($item['HinhAnh']) ? "public/uploads/".$item['HinhAnh'] : "public/uploads/default.png"; ?>
                                    <img src="<?= $img ?>" class="prod-img">
                                    <div>
                                        <div class="prod-name"><?= $item['TenSP'] ?></div>
                                        <div class="text-muted small">SL: <strong>x<?= $item['SoLuong'] ?></strong></div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <div class="col-md-4" style="border-right: 1px solid #eee;">
                            <div class="col-title">👤 THÔNG TIN KHÁCH HÀNG</div>
                            <div class="mb-2"><span class="text-secondary" style="width:70px; display:inline-block;">Tên:</span> <strong><?= $o['TenKH'] ?></strong></div>
                            <div class="mb-2"><span class="text-secondary" style="width:70px; display:inline-block;">SĐT:</span> <span class="text-dark fw-bold"><?= $o['SDT'] ?></span></div>
                            <div class="mb-2">
                                <span class="text-secondary" style="width:70px; display:inline-block;">Đ/c:</span> 
                                <span class="text-dark fw-bold"><?= $o['DiaChi'] ?></span>
                            </div>
                            <?php if(!empty($o['GhiChu'])): ?>
                                <div class="mt-2 text-muted fst-italic small bg-light p-2 rounded">"<?= $o['GhiChu'] ?>"</div>
                            <?php endif; ?>
                        </div>

                        <div class="col-md-3">
                            <div class="col-title">💳 THANH TOÁN</div>
                            <div class="d-flex justify-content-between mb-3">
                                <span class="text-secondary">Phương thức:</span>
                                <?php if($o['PhuongThucTT'] == 'momo'): ?>
                                    <span style="color: #a50064; font-weight:bold;">MoMo</span>
                                <?php else: ?>
                                    <span class="fw-bold text-dark">Tiền mặt (COD)</span>
                                <?php endif; ?>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-secondary">Trạng thái:</span>
                                <?php if($isPaid): ?>
                                    <span class="pay-status bg-paid">✔ Đã thanh toán</span>
                                <?php else: ?>
                                    <span class="pay-status bg-unpaid">Chưa thanh toán</span>
                                <?php endif; ?>
                            </div>
                            <?php if($displayNote): ?>
                                <div class="text-end mt-2 text-success small fst-italic"><i class="fa fa-check"></i> <?= $displayNote ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="alert alert-info text-center p-5">
                    <i class="fas fa-search me-2"></i> Không tìm thấy đơn hàng nào phù hợp!
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
</body>
</html>