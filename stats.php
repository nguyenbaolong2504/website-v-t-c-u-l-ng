<!DOCTYPE html>
<html lang="vi">
<head>
    <title>Báo Cáo Thống Kê</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <link rel="stylesheet" href="public/css/style.css"> 
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body { background-color: #f8f9fa; font-family: 'Segoe UI', sans-serif; }
        
        /* Căn lề trái để không bị sidebar che */
        .main-content { margin-left: 250px; padding: 30px; }

        .filter-bar { background: #fff; padding: 15px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); margin-bottom: 25px; display: flex; align-items: center; gap: 15px; }
        .stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 30px; }
        .stat-card { background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); }
        .stat-info h3 { margin: 0; font-size: 1.8rem; font-weight: bold; color: #333; }
        .stat-info p { margin: 5px 0 0; color: #777; }
        
        .card-green { border-left: 5px solid #28a745; }
        .card-blue { border-left: 5px solid #007bff; }
        .card-orange { border-left: 5px solid #fd7e14; }
        .card-red { border-left: 5px solid #dc3545; }
        
        .report-row { display: grid; grid-template-columns: 2fr 1fr; gap: 20px; }
        .box-white { background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); }
    </style>
</head>
<body>

    <?php include __DIR__ . '/sidebar.php'; ?>

    <div class="main-content">
        <h2 class="mb-4">Thống kê báo cáo</h2>

        <div class="filter-bar">
            <form action="index.php" method="GET" class="d-flex gap-3 align-items-center">
                <input type="hidden" name="action" value="dashboard">
                <div>
                    <span class="fw-bold">Từ:</span>
                    <input type="date" name="from" value="<?= $fromDate ?>" class="form-control d-inline-block w-auto">
                </div>
                <div>
                    <span class="fw-bold">Đến:</span>
                    <input type="date" name="to" value="<?= $toDate ?>" class="form-control d-inline-block w-auto">
                </div>
                <button type="submit" class="btn btn-primary"><i class="fa fa-filter"></i> Lọc</button>
            </form>
        </div>

        <div class="stats-grid">
            <div class="stat-card card-green">
                <div class="stat-info">
                    <h3><?= number_format($totals['doanh_thu']) ?> ₫</h3>
                    <p>Tổng doanh thu</p>
                </div>
            </div>
            <div class="stat-card card-blue">
                <div class="stat-info">
                    <h3><?= $totals['don_hang'] ?></h3>
                    <p>Tổng đơn hàng</p>
                </div>
            </div>
            <div class="stat-card card-orange">
                <div class="stat-info">
                    <h3><?= $totals['khach_hang'] ?></h3>
                    <p>Khách hàng</p>
                </div>
            </div>
            <div class="stat-card card-red">
                <div class="stat-info">
                    <h3><?= $totals['san_pham'] ?></h3>
                    <p>Sản phẩm</p>
                </div>
            </div>
        </div>

        <div class="report-row">
            <div class="box-white">
                <h4>Biểu đồ doanh thu</h4>
                <canvas id="revenueChart"></canvas>
            </div>
            <div class="box-white">
                <h4>Top sản phẩm bán chạy</h4>
                <ul class="list-group list-group-flush mt-3">
                    <?php if(!empty($topProducts)): ?>
                        <?php foreach($topProducts as $i => $p): ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>
                                <span class="badge bg-secondary rounded-pill me-2"><?= $i + 1 ?></span>
                                <?= $p['TenSP'] ?>
                            </span>
                            <span class="fw-bold text-success"><?= $p['DaBan'] ?> đã bán</span>
                        </li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li class="list-group-item text-center text-muted">Chưa có dữ liệu</li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>

    <script>
        const ctx = document.getElementById('revenueChart');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?= json_encode($labels) ?>,
                datasets: [{
                    label: 'Doanh thu (VNĐ)',
                    data: <?= json_encode($values) ?>,
                    borderColor: '#28a745',
                    backgroundColor: 'rgba(40, 167, 69, 0.1)',
                    fill: true,
                    tension: 0.3
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false } },
                scales: { y: { beginAtZero: true } }
            }
        });
    </script>
</body>
</html>