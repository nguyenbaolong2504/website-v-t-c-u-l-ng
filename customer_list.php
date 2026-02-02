<?php include __DIR__ . '/sidebar.php'; ?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <title>Quản lý khách hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

    <div class="main-content">
        <h3 class="fw-bold mb-4 text-uppercase"><i class="fas fa-users me-2"></i>Quản lý khách hàng</h3>
        
        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <table class="table table-hover mb-0 align-middle text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Tài khoản</th>
                            <th>Họ tên</th>
                            <th>Email</th>
                            <th>SĐT</th>
                            <th>Trạng thái</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php while($row = $customers->fetch()): ?>
                        <tr>
                            <td>#<?= $row['MaTK'] ?></td>
                            <td class="fw-bold text-primary"><?= $row['TenDangNhap'] ?></td>
                            <td><?= $row['TenKH'] ?? '-' ?></td>
                            <td><?= $row['Email'] ?? '-' ?></td>
                            <td><?= $row['SoDienThoai'] ?? '-' ?></td>
                            <td>
                                <?= $row['TrangThai'] ? '<span class="badge bg-success">Hoạt động</span>' : '<span class="badge bg-secondary">Khóa</span>' ?>
                            </td>
                            <td>
                                <a href="index.php?action=customer&del=<?= $row['MaTK'] ?>" 
                                   class="btn btn-danger btn-sm"
                                   onclick="return confirm('Bạn chắc chắn muốn xóa khách hàng này?')"><i class="fas fa-trash"></i> Xóa</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>