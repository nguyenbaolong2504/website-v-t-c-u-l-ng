<?php include __DIR__ . '/sidebar.php'; ?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <title>Quản lý Khuyến Mãi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* CSS GIAO DIỆN CŨ CỦA BẠN */
        body { background-color: #f5f6fa; font-family: 'Segoe UI', sans-serif; font-size: 15px; }
        .main-content { margin-left: 250px; padding: 25px; }
        .card-custom { background: white; border-top: 3px solid #3c8dbc; box-shadow: 0 1px 3px rgba(0,0,0,0.1); padding: 20px; border-radius: 3px; }
        .code-badge { background: #f8f9fa; color: #333; padding: 5px 10px; border-radius: 4px; font-weight: 700; border: 1px solid #ddd; font-family: monospace; font-size: 0.95rem; }
        .status-active { color: #28a745; font-weight: 600; font-size: 0.95rem; }
        .status-locked { color: #6c757d; font-weight: 600; font-size: 0.95rem; }
    </style>
</head>
<body>

<div class="main-content">
    <h4 class="mb-4 fw-bold text-uppercase"><i class="fas fa-tags me-2"></i> Quản lý khuyến mãi</h4>

    <div class="card-custom">
        <div class="d-flex justify-content-between mb-3">
            <form action="index.php" method="GET" class="input-group w-50">
                <input type="hidden" name="action" value="voucher_list">
                <input type="text" name="keyword" class="form-control" placeholder="Tìm tên hoặc mã code..." value="<?= htmlspecialchars($_GET['keyword'] ?? '') ?>">
                <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Tìm</button>
            </form>
            
            <button class="btn btn-success fw-bold" data-bs-toggle="modal" data-bs-target="#addVoucherModal">
                <i class="fas fa-plus"></i> Thêm Voucher
            </button>
        </div>

        <table class="table table-bordered table-hover align-middle text-center">
            <thead class="table-light">
                <tr>
                    <th width="5%">STT</th>
                    <th width="25%">Tên chương trình</th>
                    <th width="15%">Mã Code</th>
                    <th width="15%">Giảm giá</th>
                    <th width="20%">Thời gian</th>
                    <th width="10%">Trạng thái</th>
                    <th width="10%">Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($promotions)): $stt=1; foreach($promotions as $km): ?>
                <tr>
                    <td><?= $stt++ ?></td>
                    <td class="text-start fw-bold"><?= $km['TenKM'] ?></td>
                    <td><span class="code-badge"><?= $km['Code'] ?></span></td>
                    <td class="text-danger fw-bold">
                        <?= ($km['LoaiKM'] == 'phantram') ? $km['GiamGia'].'%' : number_format($km['GiamGia']).' đ' ?>
                    </td>
                    <td class="small text-muted">
                        <?= date('d/m/Y', strtotime($km['NgayBatDau'])) ?> <i class="fas fa-arrow-right mx-1" style="font-size: 0.7rem;"></i> <?= date('d/m/Y', strtotime($km['NgayKetThuc'])) ?>
                    </td>
                    
                    <td>
                        <?php if($km['TrangThai'] == 1): ?>
                            <span class="status-active">● Hoạt động</span>
                        <?php else: ?>
                            <span class="status-locked">● Đã khóa</span>
                        <?php endif; ?>
                    </td>
                    
                    <td>
                        <button class="btn btn-warning btn-sm btn-edit" title="Sửa"
                                data-id="<?= $km['MaKM'] ?>"
                                data-ten="<?= $km['TenKM'] ?>"
                                data-code="<?= $km['Code'] ?>"
                                data-loai="<?= $km['LoaiKM'] ?>"
                                data-giam="<?= $km['GiamGia'] ?>"
                                data-bd="<?= $km['NgayBatDau'] ?>"
                                data-kt="<?= $km['NgayKetThuc'] ?>"
                                data-tt="<?= $km['TrangThai'] ?>"
                                data-bs-toggle="modal" data-bs-target="#editVoucherModal">
                            <i class="fas fa-edit"></i>
                        </button>

                        <a href="index.php?action=voucher_list&del_km=<?= $km['MaKM'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Xóa voucher này?')" title="Xóa">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
                <?php endforeach; else: ?>
                <tr><td colspan="7" class="text-center py-4 text-muted">Không có dữ liệu.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="addVoucherModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success text-white fw-bold">
                <h5 class="modal-title">THÊM VOUCHER MỚI</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="index.php?action=voucher_list" method="POST" onsubmit="return validateForm('add')">
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Tên chương trình *</label>
                        <input type="text" name="ten" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Mã Code *</label>
                        <input type="text" name="code" class="form-control text-uppercase fw-bold" required>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Loại giảm giá</label>
                            <select name="loai" id="add_loai" class="form-select" onchange="changeType('add')">
                                <option value="tien">Tiền mặt (VNĐ)</option>
                                <option value="phantram">Phần trăm (%)</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold" id="add_labelGiam">Số tiền giảm *</label>
                            <input type="number" name="giatri" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Ngày bắt đầu *</label>
                            <input type="date" name="bd" id="add_bd" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Ngày kết thúc *</label>
                            <input type="date" name="kt" id="add_kt" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" name="add_km" class="btn btn-success fw-bold">Lưu Voucher</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editVoucherModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white fw-bold">
                <h5 class="modal-title">CẬP NHẬT VOUCHER</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="index.php?action=voucher_list" method="POST" onsubmit="return validateForm('edit')">
                <div class="modal-body p-4">
                    <input type="hidden" name="makm" id="edit_id">
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Tên chương trình *</label>
                        <input type="text" name="ten" id="edit_ten" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Mã Code *</label>
                        <input type="text" name="code" id="edit_code" class="form-control text-uppercase fw-bold" required>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Loại giảm giá</label>
                            <select name="loai" id="edit_loai" class="form-select" onchange="changeType('edit')">
                                <option value="tien">Tiền mặt (VNĐ)</option>
                                <option value="phantram">Phần trăm (%)</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold" id="edit_labelGiam">Giá trị giảm *</label>
                            <input type="number" name="giatri" id="edit_giam" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Ngày bắt đầu *</label>
                            <input type="date" name="bd" id="edit_bd" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Ngày kết thúc *</label>
                            <input type="date" name="kt" id="edit_kt" class="form-control" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Trạng thái</label>
                        <select name="trangthai" id="edit_tt" class="form-select">
                            <option value="1">🟢 Đang hoạt động</option>
                            <option value="0">🔴 Tạm khóa</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" name="edit_km" class="btn btn-primary fw-bold">Lưu thay đổi</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Xử lý đổi nhãn (Tiền/Phần trăm)
    function changeType(mode) {
        let type = document.getElementById(mode + '_loai').value;
        let label = document.getElementById(mode + '_labelGiam');
        label.innerText = (type === 'phantram') ? 'Số % giảm (1-100) *' : 'Số tiền giảm (VNĐ) *';
    }

    // Validate ngày tháng
    function validateForm(mode) {
        let start = new Date(document.getElementById(mode + '_bd').value);
        let end = new Date(document.getElementById(mode + '_kt').value);
        if(start > end) { 
            alert('Ngày kết thúc phải sau ngày bắt đầu!'); 
            return false; 
        }
        return true;
    }

    // Đổ dữ liệu vào Modal Sửa
    const editBtns = document.querySelectorAll('.btn-edit');
    editBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            document.getElementById('edit_id').value = btn.getAttribute('data-id');
            document.getElementById('edit_ten').value = btn.getAttribute('data-ten');
            document.getElementById('edit_code').value = btn.getAttribute('data-code');
            document.getElementById('edit_loai').value = btn.getAttribute('data-loai');
            document.getElementById('edit_giam').value = btn.getAttribute('data-giam');
            
            // Xử lý ngày (lấy yyyy-mm-dd)
            document.getElementById('edit_bd').value = btn.getAttribute('data-bd').split(' ')[0];
            document.getElementById('edit_kt').value = btn.getAttribute('data-kt').split(' ')[0];
            
            document.getElementById('edit_tt').value = btn.getAttribute('data-tt');
            
            // Cập nhật nhãn loại giảm giá
            changeType('edit');
        });
    });
</script>

</body>
</html>