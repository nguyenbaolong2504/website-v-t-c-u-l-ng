<?php include __DIR__ . '/sidebar.php'; ?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <title>Quản lý sản phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

    <div class="main-content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold text-uppercase"><i class="fas fa-box me-2"></i>Danh sách sản phẩm</h3>
            <button class="btn btn-success fw-bold" data-bs-toggle="modal" data-bs-target="#addModal">
                <i class="fas fa-plus me-1"></i> Thêm mới
            </button>
        </div>

        <div class="card mb-4 border-0 shadow-sm">
            <div class="card-body">
                <form action="index.php" method="GET" class="d-flex gap-2">
                    <input type="hidden" name="action" value="product_list">
                    <input type="text" name="keyword" class="form-control" placeholder="Nhập tên sản phẩm..." value="<?= isset($_GET['keyword']) ? $_GET['keyword'] : '' ?>">
                    <button class="btn btn-primary px-4"><i class="fas fa-search"></i> Tìm</button>
                </form>
            </div>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <table class="table table-hover mb-0 align-middle">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>ID</th>
                            <th>Ảnh</th>
                            <th class="text-start">Tên sản phẩm</th>
                            <th>Giá</th>
                            <th>Kho</th>
                            <th>Danh mục</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if($products): foreach($products as $p): ?>
                        <tr>
                            <td class="text-center">#<?= $p['MaSP'] ?></td>
                            <td class="text-center">
                                <img src="public/uploads/<?= $p['HinhAnh'] ?: 'default.jpg' ?>" width="60" style="border-radius:5px; border:1px solid #ddd;">
                            </td>
                            <td>
                                <div class="fw-bold text-primary"><?= $p['TenSP'] ?></div>
                            </td>
                            <td class="text-center text-danger fw-bold"><?= number_format($p['Gia']) ?>đ</td>
                            <td class="text-center">
                                <span class="badge bg-<?= $p['SoLuong'] > 0 ? 'success' : 'danger' ?>">
                                    <?= $p['SoLuong'] ?>
                                </span>
                            </td>
                            <td class="text-center badge-light text-dark"><?= $p['TenDanhMuc'] ?? '-' ?></td>
                            <td class="text-center">
                                <button class="btn btn-warning btn-sm me-1 btn-edit" 
                                        data-id="<?= $p['MaSP'] ?>"
                                        data-ten="<?= $p['TenSP'] ?>"
                                        data-gia="<?= $p['Gia'] ?>"
                                        data-sl="<?= $p['SoLuong'] ?>"
                                        data-dm="<?= $p['MaDanhMuc'] ?>"
                                        data-mota="<?= htmlspecialchars($p['MoTa']) ?>"
                                        data-bs-toggle="modal" data-bs-target="#editModal">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <a href="index.php?action=product_list&del=<?= $p['MaSP'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Xóa sản phẩm này?')">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <form class="modal-content" method="POST" enctype="multipart/form-data" action="index.php?action=product_list">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title fw-bold">Thêm Sản Phẩm Mới</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Tên sản phẩm</label>
                            <input type="text" name="ten" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Danh mục</label>
                            <select name="madm" class="form-select">
                                <?php foreach($categories as $c): ?>
                                    <option value="<?= $c['MaDanhMuc'] ?>"><?= $c['TenDanhMuc'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Giá bán</label>
                            <input type="number" name="gia" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Số lượng kho</label>
                            <input type="number" name="sl" class="form-control" value="10" required>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label fw-bold">Hình ảnh</label>
                            <input type="file" name="anh" class="form-control">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label fw-bold">Mô tả</label>
                            <textarea name="mota" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" name="add_sp" class="btn btn-success fw-bold">Lưu sản phẩm</button>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="editModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <form class="modal-content" method="POST" enctype="multipart/form-data" action="index.php?action=product_list">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title fw-bold text-dark">Cập Nhật Sản Phẩm</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="masp" id="edit_id">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Tên sản phẩm</label>
                            <input type="text" name="ten" id="edit_ten" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Danh mục</label>
                            <select name="madm" id="edit_dm" class="form-select">
                                <?php foreach($categories as $c): ?>
                                    <option value="<?= $c['MaDanhMuc'] ?>"><?= $c['TenDanhMuc'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Giá bán</label>
                            <input type="number" name="gia" id="edit_gia" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Số lượng kho</label>
                            <input type="number" name="sl" id="edit_sl" class="form-control" required>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label fw-bold">Chọn ảnh mới (Nếu muốn thay)</label>
                            <input type="file" name="anh" class="form-control">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label fw-bold">Mô tả</label>
                            <textarea name="mota" id="edit_mota" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" name="edit_sp" class="btn btn-warning fw-bold">Lưu thay đổi</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const editBtns = document.querySelectorAll('.btn-edit');
        editBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                document.getElementById('edit_id').value = btn.getAttribute('data-id');
                document.getElementById('edit_ten').value = btn.getAttribute('data-ten');
                document.getElementById('edit_gia').value = btn.getAttribute('data-gia');
                document.getElementById('edit_sl').value = btn.getAttribute('data-sl');
                document.getElementById('edit_dm').value = btn.getAttribute('data-dm');
                document.getElementById('edit_mota').value = btn.getAttribute('data-mota');
            });
        });
    </script>
</body>
</html>