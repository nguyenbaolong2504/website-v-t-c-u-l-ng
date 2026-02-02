<?php include __DIR__ . '/sidebar.php'; ?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <title>Nhà cung cấp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

    <div class="main-content">
        <h3 class="mb-4 fw-bold text-uppercase"><i class="fas fa-truck me-2"></i>Danh sách Nhà cung cấp</h3>
        
        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <table class="table table-hover mb-0 align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Tên Nhà Cung Cấp</th>
                            <th>Điện thoại</th>
                            <th>Địa chỉ</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php while($row = $suppliers->fetch()): ?>
                        <tr>
                            <td>#<?= $row['MaNCC'] ?></td>
                            <td class="fw-bold text-primary"><?= $row['TenNCC'] ?></td>
                            <td><i class="fas fa-phone-alt me-2 text-muted"></i><?= $row['SDT'] ?? $row['đienthoai'] ?? '-' ?></td>
                            <td><i class="fas fa-map-marker-alt me-2 text-muted"></i><?= $row['DiaChi'] ?></td>
                        </tr>
                    <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>