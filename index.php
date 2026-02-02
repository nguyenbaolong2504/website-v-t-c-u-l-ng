<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 bg-dark min-vh-100 text-white p-3">
            <h3>Admin Panel</h3>
            <hr>
            <ul class="nav flex-column">
                <li class="nav-item"><a class="nav-link text-white" href="?action=list">📦 Quản lý Sản phẩm</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="?action=category">📁 Quản lý Danh mục</a></li>
            </ul>
        </div>

        <div class="col-md-10 p-4">
            <div class="d-flex justify-content-between mb-4">
                <h2>Danh sách Vợt Cầu Lông</h2>
                <form class="d-flex w-50">
                    <input class="form-control me-2" name="search" type="search" placeholder="Tìm kiếm tên vợt...">
                    <button class="btn btn-outline-success" type="submit">Tìm</button>
                </form>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAdd">+ Thêm mới</button>
            </div>

            <table class="table table-hover align-middle shadow-sm">
                <thead class="table-primary">
                    <tr>
                        <th>ID</th> <th>Hình ảnh</th> <th>Tên Vợt</th> <th>Giá</th> <th>Kho</th> <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $data->fetch()): ?>
                    <tr>
                        <td>#<?= $row['MaSP'] ?></td>
                        <td><img src="uploads/<?= $row['HinhAnh'] ?>" width="60" class="rounded"></td>
                        <td><strong><?= $row['TenSP'] ?></strong></td>
                        <td class="text-danger"><?= number_format($row['Gia']) ?>đ</td>
                        <td><?= $row['SoLuong'] ?></td>
                        <td>
                            <a href="?edit=<?= $row['MaSP'] ?>" class="btn btn-sm btn-warning">Sửa</a>
                            <a href="?delete=<?= $row['MaSP'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Xóa?')">Xóa</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>