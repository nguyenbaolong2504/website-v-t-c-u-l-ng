<?php include __DIR__ . '/sidebar.php'; ?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <title>Quản lý danh mục</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

    <div class="main-content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold text-uppercase"><i class="fas fa-list me-2"></i>Danh sách Danh mục</h3>
            <button class="btn btn-success fw-bold" data-bs-toggle="modal" data-bs-target="#addCatModal">
                <i class="fas fa-plus me-1"></i> Thêm danh mục
            </button>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <table class="table table-hover mb-0 align-middle text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th class="text-start ps-5">Tên danh mục</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if($categories): foreach($categories as $c): ?>
                        <tr>
                            <td>#<?= $c['MaDanhMuc'] ?></td>
                            <td class="text-start ps-5 fw-bold text-primary"><?= $c['TenDanhMuc'] ?></td>
                            <td>
                                <button class="btn btn-warning btn-sm me-1 btn-edit-cat" 
                                        data-id="<?= $c['MaDanhMuc'] ?>"
                                        data-ten="<?= $c['TenDanhMuc'] ?>"
                                        data-bs-toggle="modal" data-bs-target="#editCatModal">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <a href="index.php?action=category_list&del_dm=<?= $c['MaDanhMuc'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Xóa danh mục này?')">
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

    <div class="modal fade" id="addCatModal" tabindex="-1">
        <div class="modal-dialog">
            <form class="modal-content" method="POST" action="index.php?action=category_list">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title fw-bold">Thêm Danh Mục</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <label class="form-label fw-bold">Tên danh mục</label>
                    <input type="text" name="ten" class="form-control" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" name="add_dm" class="btn btn-success fw-bold">Lưu</button>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="editCatModal" tabindex="-1">
        <div class="modal-dialog">
            <form class="modal-content" method="POST" action="index.php?action=category_list">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title fw-bold">Sửa Danh Mục</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="madm" id="edit_dm_id">
                    <label class="form-label fw-bold">Tên danh mục</label>
                    <input type="text" name="ten" id="edit_dm_ten" class="form-control" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" name="edit_dm" class="btn btn-warning fw-bold">Lưu thay đổi</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const editCatBtns = document.querySelectorAll('.btn-edit-cat');
        editCatBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                document.getElementById('edit_dm_id').value = btn.getAttribute('data-id');
                document.getElementById('edit_dm_ten').value = btn.getAttribute('data-ten');
            });
        });
    </script>
</body>
</html>