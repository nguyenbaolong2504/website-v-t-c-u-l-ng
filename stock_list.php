<?php include __DIR__ . '/sidebar.php'; ?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <title>Quản lý kho</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

    <div class="main-content">
        <h3 class="mb-4 fw-bold text-uppercase"><i class="fas fa-warehouse me-2"></i>Quản lý kho sản phẩm</h3>
        
        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <table class="table table-bordered table-hover mb-0 align-middle">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>ID</th>
                            <th>Hình ảnh</th>
                            <th class="text-start">Tên sản phẩm</th>
                            <th>Tồn kho hiện tại</th>
                            <th>Nhập thêm / Xuất bớt</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($products as $p): ?>
                    <tr>
                        <td class="text-center">#<?= $p['MaSP'] ?></td>
                        <td class="text-center">
                            <img src="public/uploads/<?= $p['HinhAnh'] ?>" width="50" style="border-radius:5px; border:1px solid #ddd;">
                        </td>
                        <td class="fw-bold text-primary"><?= $p['TenSP'] ?></td>
                        <td class="text-center">
                            <?php if($p['SoLuong'] <= 5): ?>
                                <span class="badge bg-danger fs-6">Sắp hết: <?= $p['SoLuong'] ?></span>
                            <?php else: ?>
                                <span class="badge bg-success fs-6"><?= $p['SoLuong'] ?></span>
                            <?php endif; ?>
                        </td>
                        <td style="width: 300px;">
                            <form method="POST" action="index.php?action=stock_update" class="d-flex gap-2 justify-content-center">
                                <input type="hidden" name="id" value="<?= $p['MaSP'] ?>">
                                <input type="number" name="qty" class="form-control form-control-sm" placeholder="Nhập số..." required style="width: 120px;">
                                <button class="btn btn-primary btn-sm fw-bold"><i class="fas fa-save me-1"></i> Cập nhật</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>