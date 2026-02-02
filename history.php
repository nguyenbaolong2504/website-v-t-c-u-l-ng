<!DOCTYPE html>
<html lang="vi">
<head>
    <title>Đơn hàng của tôi</title>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        body { background: #f0f2f5; font-family: 'Segoe UI', sans-serif; font-size: 14px; }
        .container { max-width: 1000px; margin: 40px auto; }

        .page-header { text-align: center; margin-bottom: 30px; }
        .page-header h3 { color: #003366; font-weight: 800; text-transform: uppercase; margin-bottom: 10px; }

        /* KHUNG CARD ĐƠN HÀNG */
        .order-card {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            margin-bottom: 25px;
            overflow: hidden;
            border: 1px solid #e5e5e5;
        }

        .order-header-strip {
            background-color: #f8f9fa;
            padding: 12px 20px;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.9rem;
            color: #555;
        }
        .order-id { font-weight: bold; color: #333; font-size: 1rem; }

        .order-body {
            padding: 20px;
            display: flex;
            align-items: stretch;
            justify-content: space-between;
        }

        /* CỘT 1: SẢN PHẨM */
        .col-info { flex: 2; display: flex; flex-direction: column; padding-right: 20px; border-right: 1px solid #f0f0f0; }
        
        .item-row { display: flex; gap: 15px; align-items: flex-start; margin-bottom: 15px; padding-bottom: 15px; border-bottom: 1px dashed #eee; }
        .item-row:last-child { border-bottom: none; margin-bottom: 0; padding-bottom: 0; }

        .prod-img { width: 65px; height: 65px; object-fit: cover; border-radius: 4px; border: 1px solid #e0e0e0; flex-shrink: 0; }
        .prod-name { font-weight: 600; color: #333; font-size: 0.95rem; margin-bottom: 3px; display: block; text-decoration: none; }
        .prod-detail { font-size: 0.85rem; color: #777; }
        
        .order-footer-mini { margin-top: 15px; padding-top: 10px; border-top: 2px solid #f5f5f5; display: flex; justify-content: space-between; align-items: center; }
        .total-price { color: #d0021b; font-size: 1.1rem; font-weight: bold; }

        /* CỘT 2: TRẠNG THÁI */
        .col-status { 
            flex: 0.8; 
            text-align: center; 
            padding: 0 15px; 
            border-right: 1px solid #f0f0f0; 
            display: flex; 
            flex-direction: row; 
            align-items: center; 
            justify-content: center; 
            gap: 10px; 
        }
        
        .status-dot { width: 10px; height: 10px; border-radius: 50%; display: inline-block; }
        .status-text { font-weight: 600; font-size: 0.95rem; }

        /* MÀU TRẠNG THÁI (ĐÃ SỬA: ChoDuyet luôn màu Cam) */
        .st-orange { color: #fd7e14; } .dot-orange { background: #fd7e14; }
        .st-blue   { color: #3498db; } .dot-blue   { background: #3498db; }
        .st-green  { color: #27ae60; } .dot-green  { background: #27ae60; }
        .st-red    { color: #e74c3c; } .dot-red    { background: #e74c3c; }

        /* CỘT 3: HÀNH ĐỘNG */
        .col-action { flex: 0.6; text-align: center; padding-left: 15px; display: flex; align-items: center; justify-content: center; }
        .btn-track {
            border: 1px solid #003366; background: #fff; color: #003366;
            padding: 8px 12px; border-radius: 4px; font-weight: 600; font-size: 0.85rem;
            text-decoration: none; display: inline-block; width: 100%; transition: 0.2s;
        }
        .btn-track:hover { background: #003366; color: white; }

        @media (max-width: 768px) {
            .order-body { flex-direction: column; gap: 20px; }
            .col-info, .col-status, .col-action { width: 100%; border: none; padding: 0; }
            .col-status { margin-bottom: 10px; justify-content: flex-start; }
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-light bg-white shadow-sm mb-4">
        <div class="container-fluid px-4">
            <a class="navbar-brand text-dark fw-bold" href="index.php?action=home">
                <i class="fa fa-chevron-left me-2"></i> Mua sắm tiếp
            </a>
        </div>
    </nav>

    <div class="container">
        <div class="page-header">
            <h3>Đơn hàng của tôi</h3>
            <p class="text-muted">Quản lý và theo dõi trạng thái đơn hàng</p>
        </div>

        <?php if(!empty($orders)): ?>
            <?php foreach($orders as $data): 
                $o = $data['info'];
                $items = $data['items'];
                
                // --- XỬ LÝ TRẠNG THÁI HIỂN THỊ (ĐÃ SỬA MÀU SẮC) ---
                $stt = $o['TrangThai'];
                $sttClass = ''; $sttText = ''; $dotClass = '';

                // LUÔN DÙNG MÀU CAM (orange) CHO TRẠNG THÁI CHỜ DUYỆT / ĐÃ ĐẶT HÀNG
                if($stt == 'ChoDuyet' || $stt == 'DaThanhToan') { 
                    $sttText = 'Đã đặt hàng'; 
                    $sttClass = 'st-orange'; 
                    $dotClass = 'dot-orange'; 
                }
                elseif($stt == 'DangGiao') { 
                    $sttText = 'Đang giao hàng'; 
                    $sttClass = 'st-blue'; 
                    $dotClass = 'dot-blue'; 
                }
                elseif($stt == 'DaGiao') { 
                    $sttText = 'Giao thành công'; 
                    $sttClass = 'st-green'; 
                    $dotClass = 'dot-green'; 
                }
                elseif($stt == 'Huy') { 
                    $sttText = 'Đã hủy'; 
                    $sttClass = 'st-red'; 
                    $dotClass = 'dot-red'; 
                }
                else { 
                    $sttText = 'Đang xử lý'; 
                    $sttClass = 'st-orange'; 
                    $dotClass = 'dot-orange'; 
                }
            ?>

            <div class="order-card">
                
                <div class="order-header-strip">
                    <span class="order-id"><i class="fa fa-receipt me-2"></i>Đơn hàng #<?= strtoupper(substr(md5($o['MaDonHang']), 0, 8)) ?></span>
                    <span class="text-muted small"><i class="fa fa-clock me-1"></i><?= date('d/m/Y H:i', strtotime($o['NgayDat'])) ?></span>
                </div>

                <div class="order-body">
                    <div class="col-info">
                        <?php foreach($items as $item): ?>
                        <div class="item-row">
                            <?php $img = !empty($item['HinhAnh']) ? "public/uploads/".$item['HinhAnh'] : "public/uploads/default.png"; ?>
                            <img src="<?= $img ?>" class="prod-img">
                            <div>
                                <span class="prod-name"><?= $item['TenSP'] ?></span>
                                <div class="prod-detail">
                                    <span class="text-danger fw-bold"><?= number_format($item['DonGia']) ?> ₫</span> 
                                    <span class="mx-2 text-muted">|</span> 
                                    SL: <?= $item['SoLuong'] ?>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                        
                        <div class="order-footer-mini">
                            <span class="text-muted small">Thanh toán: <?= ($o['PhuongThucTT'] == 'momo') ? 'MoMo' : 'Tiền mặt (COD)' ?></span>
                            <div>
                                <span class="text-dark small me-2">Tổng tiền:</span>
                                <span class="total-price"><?= number_format($o['TongTien']) ?> ₫</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-status">
                        <span class="status-dot <?= $dotClass ?>"></span>
                        <span class="status-text <?= $sttClass ?>"><?= $sttText ?></span>
                    </div>

                    <div class="col-action">
                        <a href="index.php?action=order_detail&id=<?= $o['MaDonHang'] ?>" class="btn-track">
                            Xem chi tiết
                        </a>
                    </div>
                </div>
            </div>

            <?php endforeach; ?>

        <?php else: ?>
            <div class="text-center p-5 bg-white rounded shadow-sm">
                <img src="https://cdn-icons-png.flaticon.com/512/2038/2038854.png" width="80" style="opacity: 0.5;">
                <p class="mt-3 text-muted">Bạn chưa có đơn hàng nào.</p>
                <a href="index.php" class="btn btn-primary rounded-pill px-4">Mua sắm ngay</a>
            </div>
        <?php endif; ?>

    </div>
</body>
</html>