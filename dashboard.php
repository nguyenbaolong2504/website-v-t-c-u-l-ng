<?php include __DIR__ . '/sidebar.php'; ?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <title>Tổng quan hệ thống</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

    <div class="main-content">
        <h2 class="mb-4 fw-bold text-dark"><i class="fas fa-tachometer-alt me-2"></i>Tổng quan hệ thống</h2>
        
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card text-white bg-primary h-100 shadow border-0">
                    <div class="card-body d-flex justify-content-between align-items-center p-4">
                        <div>
                            <h5 class="card-title fw-bold text-uppercase" style="font-size: 0.9rem; opacity: 0.9;">Sản phẩm</h5>
                            <h2 class="fw-bold mb-0" style="font-size: 2.5rem;"><?= number_format($product) ?></h2>
                        </div>
                        <i class="fas fa-box fa-4x opacity-25"></i>
                    </div>
                    <div class="card-footer bg-transparent border-0 text-end">
                        <a href="index.php?action=product_list" class="text-white text-decoration-none small">Xem chi tiết <i class="fas fa-arrow-right ms-1"></i></a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card text-white bg-success h-100 shadow border-0">
                    <div class="card-body d-flex justify-content-between align-items-center p-4">
                        <div>
                            <h5 class="card-title fw-bold text-uppercase" style="font-size: 0.9rem; opacity: 0.9;">Khách hàng</h5>
                            <h2 class="fw-bold mb-0" style="font-size: 2.5rem;"><?= number_format($customer) ?></h2>
                        </div>
                        <i class="fas fa-users fa-4x opacity-25"></i>
                    </div>
                    <div class="card-footer bg-transparent border-0 text-end">
                        <a href="index.php?action=customer" class="text-white text-decoration-none small">Xem chi tiết <i class="fas fa-arrow-right ms-1"></i></a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card text-dark bg-warning h-100 shadow border-0">
                    <div class="card-body d-flex justify-content-between align-items-center p-4">
                        <div>
                            <h5 class="card-title fw-bold text-uppercase" style="font-size: 0.9rem; opacity: 0.8;">Nhà cung cấp</h5>
                            <h2 class="fw-bold mb-0" style="font-size: 2.5rem;"><?= number_format($supplier) ?></h2>
                        </div>
                        <i class="fas fa-truck fa-4x opacity-25"></i>
                    </div>
                    <div class="card-footer bg-transparent border-0 text-end">
                        <a href="index.php?action=supplier" class="text-dark text-decoration-none small fw-bold">Xem chi tiết <i class="fas fa-arrow-right ms-1"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>