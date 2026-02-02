<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Badminton Shop - Thế giới vợt cầu lông</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        .product-card { border: none; transition: 0.3s; border-radius: 15px; overflow: hidden; }
        .product-card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
        .navbar { background-color: #003366; }
        .header-top { background: white; padding: 15px 0; border-bottom: 1px solid #eee; }
        .hotline-box { color: #d0021b; font-weight: bold; display: flex; align-items: center; text-decoration: none; }
        .hotline-box i { background: #d0021b; color: white; width: 35px; height: 35px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 10px; font-size: 18px; }
        .search-container { position: relative; max-width: 500px; width: 100%; }
        .search-container input { border-radius: 50px; padding-right: 45px; border: 1px solid #ddd; height: 45px; }
        .search-container .btn-search { position: absolute; right: 15px; top: 50%; transform: translateY(-50%); background: none; border: none; color: #d0021b; font-size: 20px; }
        .header-icon-item { text-align: center; color: #333; text-decoration: none; font-size: 11px; font-weight: bold; transition: 0.3s; position: relative; }
        .header-icon-item:hover { color: #d0021b; }
        .cart-badge { background: #d0021b; color: white; font-size: 10px; padding: 2px 6px; border-radius: 50%; position: absolute; top: -5px; right: 15px; border: 2px solid white; }
    </style>
</head>
<body class="bg-light">
    <div class="header-top shadow-sm sticky-top">
        <div class="container d-flex align-items-center justify-content-between">
            <a href="tel:0364057888" class="hotline-box">
                <i class="bi bi-telephone-fill"></i>
                <div><small class="d-block text-muted" style="font-size: 10px; line-height: 1;">HOTLINE:</small><span>0364057888</span></div>
            </a>
            <div class="search-container mx-4">
                <form action="index.php?action=search" method="POST">
                    <input type="text" name="keyword" class="form-control" placeholder="Tìm kiếm sản phẩm...">
                    <button type="submit" class="btn-search"><i class="bi bi-search"></i></button>
                </form>
            </div>
            <div class="d-flex align-items-center gap-4">
                <?php if(isset($_SESSION['user'])): ?>
                    <a href="index.php?action=cart" class="header-icon-item">
                        <i class="bi bi-cart3 fs-4 d-block mb-1"></i> GIỎ HÀNG <span class="cart-badge"><?= isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0 ?></span>
                    </a>
                <?php else: ?>
                    <button class="btn btn-primary rounded-pill px-4 btn-sm fw-bold" data-bs-toggle="modal" data-bs-target="#loginModal">ĐĂNG NHẬP</button>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="index.php?action=home">ACL BADMINTON</a>
            <div class="ms-auto text-white">
                <?php if(isset($_SESSION['user'])): ?>
                    Chào, <strong><?= $_SESSION['user']['TenDangNhap'] ?></strong> |
                    <a href="index.php?action=history" class="text-white text-decoration-none">Đơn mua</a> |
                    <?php if($_SESSION['user']['VaiTro'] == 'ADMIN'): ?> <a href="index.php?action=overview" class="text-warning text-decoration-none">Quản trị</a> | <?php endif; ?>
                    <a href="index.php?action=logout" class="text-white text-decoration-none">Thoát</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h2 class="text-center fw-bold mb-4">THẾ GIỚI VỢT CẦU LÔNG</h2>
        <div class="row">
        <?php if (!empty($products)): foreach($products as $p): ?>
            <div class="col-md-3 mb-4">
                <div class="card h-100 product-card shadow-sm">
                    <a href="index.php?action=detail&id=<?= $p['MaSP'] ?>">
                        <img src="public/uploads/<?= $p['HinhAnh'] ?: 'default.jpg' ?>" class="card-img-top p-4" style="height:250px; object-fit:contain">
                    </a>
                    <div class="card-body text-center d-flex flex-column">
                        <a href="index.php?action=detail&id=<?= $p['MaSP'] ?>" class="text-decoration-none text-dark"><h6 class="fw-bold mb-1"><?= $p['TenSP'] ?></h6></a>
                        <p class="text-danger fw-bold mt-auto mb-3"><?= number_format($p['Gia']) ?>đ</p>
                        <div class="d-flex gap-2">
                            <a href="index.php?action=add_to_cart&id=<?= $p['MaSP'] ?>" class="btn btn-warning w-50 btn-sm">🛒 Thêm giỏ</a>
                            <a href="index.php?action=checkout&id=<?= $p['MaSP'] ?>" class="btn btn-primary w-50 btn-sm">⚡ Mua ngay</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; endif; ?>
        </div>
    </div>
    
    <div class="modal fade" id="loginModal" tabindex="-1"><div class="modal-dialog modal-dialog-centered"><form class="modal-content" method="POST" action="index.php"><div class="modal-body p-5 text-center"><h4 class="fw-bold mb-4">ĐĂNG NHẬP</h4><div class="mb-3 text-start"><label class="form-label small fw-bold">Tài khoản</label><input type="text" name="user" class="form-control" required></div><div class="mb-4 text-start"><label class="form-label small fw-bold">Mật khẩu</label><input type="password" name="pass" class="form-control" required></div><button type="submit" name="login_submit" class="btn btn-primary w-100 fw-bold">ĐĂNG NHẬP</button></div></form></div></div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>