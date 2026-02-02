<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title><?= $product['TenSP'] ?> - Badminton Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body { background-color: #f8f9fa; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        /* Reuse Header Styles */
        .header-top { background: white; padding: 12px 0; border-bottom: 1px solid #eee; }
        .hotline-box { color: #d0021b; font-weight: bold; display: flex; align-items: center; text-decoration: none; }
        .hotline-box i { background: #d0021b; color: white; width: 32px; height: 32px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 8px; }
        .search-container input { border-radius: 50px; border: 1px solid #ddd; height: 40px; }
        .navbar { background-color: #003366; }
        
        /* Product Detail Styles */
        .breadcrumb-section { background: #fff; padding: 10px 0; margin-bottom: 20px; border-bottom: 1px solid #eee; }
        .product-image-card { background: white; border-radius: 12px; padding: 30px; border: 1px solid #eee; }
        .product-info-card { background: white; border-radius: 12px; padding: 30px; height: 100%; border: 1px solid #eee; }
        .price-tag { color: #d0021b; font-size: 2rem; font-weight: 800; margin: 15px 0; }
        .promo-box { background: #fff9f9; border: 1px dashed #d0021b; border-radius: 8px; padding: 15px; margin: 20px 0; }
        .btn-add-cart { background: #d0021b; color: white; border: none; padding: 12px 30px; border-radius: 50px; font-weight: bold; transition: 0.3s; }
        .btn-add-cart:hover { background: #b00216; transform: scale(1.05); color: white; }
        .description-card { background: white; border-radius: 12px; padding: 30px; margin-top: 30px; border: 1px solid #eee; }
        .qty-input { width: 60px; text-align: center; border: 1px solid #ddd; border-left: 0; border-right: 0; }
        .qty-btn { border: 1px solid #ddd; background: #f8f9fa; padding: 5px 12px; }
        /* Màu sắc đặc trưng cho các nút liên hệ */
.btn-zalo { background-color: #0084ff; color: white; border: none; font-weight: bold; }
.btn-zalo:hover { background-color: #0066cc; color: white; transform: translateY(-2px); }

.btn-hotline-call { background-color: #ff9800; color: white; border: none; font-weight: bold; }
.btn-hotline-call:hover { background-color: #e68a00; color: white; transform: translateY(-2px); }

.btn-buy-now { background-color: #d0021b; color: white; border: none; font-weight: 800; text-transform: uppercase; }
.btn-buy-now:hover { background-color: #a00215; color: white; transform: translateY(-2px); }

.action-group { display: flex; flex-direction: column; gap: 10px; margin-top: 25px; }
.contact-group { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; }
    </style>
</head>
<body>

<div class="header-top shadow-sm">
    <div class="container d-flex align-items-center justify-content-between">
        <a href="tel:0364057888" class="hotline-box">
            <i class="bi bi-telephone-fill"></i>
            <div>
                <small class="d-block text-muted" style="font-size: 9px;">HOTLINE:</small>
                <span>0364057888</span>
            </div>
        </a>
        <div class="search-container mx-4 flex-grow-1" style="max-width: 500px;">
            <form action="index.php?action=search" method="POST" class="position-relative">
                <input type="text" name="keyword" class="form-control" placeholder="Tìm kiếm sản phẩm...">
                <button type="submit" class="btn position-absolute end-0 top-0 text-danger"><i class="bi bi-search"></i></button>
            </form>
        </div>
        <div class="d-flex align-items-center gap-4">
            <?php if(isset($_SESSION['user'])): ?>
                <div class="text-center">
                    <i class="bi bi-person-circle fs-4"></i>
                    <div class="fw-bold small">TÀI KHOẢN</div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<nav class="navbar navbar-dark py-2">
    <div class="container">
        <a class="navbar-brand fw-bold" href="index.php">ALC BADMINTON</a>
    </div>
</nav>

<div class="breadcrumb-section">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="index.php" class="text-decoration-none">Trang chủ</a></li>
                <li class="breadcrumb-item active text-dark"><?= $product['TenDanhMuc'] ?></li>
                <li class="breadcrumb-item active fw-bold text-dark" aria-current="page"><?= $product['TenSP'] ?></li>
            </ol>
        </nav>
    </div>
</div>

<div class="container">
    <div class="row g-4">
        <div class="col-md-5">
            <div class="product-image-card text-center shadow-sm">
                <img src="public/uploads/<?= $product['HinhAnh'] ?>" class="img-fluid" alt="<?= $product['TenSP'] ?>" style="max-height: 400px; object-fit: contain;">
            </div>
        </div>

        <div class="col-md-7">
            <div class="product-info-card shadow-sm">
                <h1 class="fw-bold h2 mb-2 text-uppercase"><?= $product['TenSP'] ?></h1>
                <div class="d-flex align-items-center mb-3">
                    <span class="badge bg-primary me-2"><?= $product['TenNCC'] ?? 'Yonex' ?></span>
                    <span class="text-muted small">Tình trạng: <span class="text-success fw-bold">Còn hàng</span></span>
                </div>
                
                <div class="price-tag"><?= number_format($product['Gia']) ?>₫</div>

                <div class="promo-box">
                    <h6 class="fw-bold text-danger"><i class="bi bi-gift-fill me-2"></i>QUÀ TẶNG & ƯU ĐÃI</h6>
                    <ul class="mb-0 small ps-3">
                        <li>Tặng bao vợt chính hãng theo sản phẩm.</li>
                        <li>Tặng 01 quấn cán vợt cầu lông.</li>
                        <li>Bảo hành chính hãng 03 tháng.</li>
                    </ul>
                </div>

                <div class="d-flex align-items-center gap-3 mt-4">
                    <div class="d-flex">
                        <button class="qty-btn rounded-start" onclick="var i=document.getElementById('qty'); if(i.value>1) i.value--">-</button>
                        <input type="text" id="qty" class="qty-input" value="1" readonly>
                        <button class="qty-btn rounded-end" onclick="document.getElementById('qty').value++">+</button>
                    </div>
                    <button class="btn btn-add-cart px-5 shadow-sm">
                        <i class="bi bi-cart-plus-fill me-2"></i>THÊM VÀO GIỎ HÀNG
                    </button>
                    <a href="index.php?action=add_to_cart&id=<?= $product['MaSP'] ?>" class="btn btn-buy-now btn-lg w-100 py-3 shadow-sm">
    <i class="bi bi-lightning-charge-fill me-2"></i>MUA NGAY
</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <div class="description-card shadow-sm">
                <h5 class="fw-bold border-bottom pb-3 mb-4 text-uppercase">Mô tả sản phẩm</h5>
                <div class="lh-lg text-secondary">
                    <?= nl2br($product['MoTa']) ?>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="action-group">
    <button class="btn btn-buy-now btn-lg w-100 py-3 shadow-sm">
        <i class="bi bi-lightning-charge-fill me-2"></i>MUA NGAY (Giao tận nơi hoặc nhận tại cửa hàng)
    </button>

    <div class="contact-group">
        <a href="https://zalo.me/0364057480" target="_blank" class="btn btn-zalo py-2 d-flex align-items-center justify-content-center">
            <i class="bi bi-chat-dots-fill me-2"></i>CHAT ZALO
        </a>

        <a href="tel:0364057480" class="btn btn-hotline-call py-2 d-flex align-items-center justify-content-center">
            <i class="bi bi-telephone-outbound-fill me-2"></i>GỌI HOTLINE
        </a>
    </div>

    <button class="btn btn-outline-danger w-100 fw-bold mt-2 py-2">
        <i class="bi bi-cart-plus me-2"></i>THÊM VÀO GIỎ HÀNG
    </button>
</div>

<footer class="mt-5 py-4 bg-dark text-white text-center">
    <div class="container">
        <p class="mb-0">&copy;  ALC Badminton Shop  Cảm ơn khách hàng luôn tin tưởng</p>
    </div>
</footer>
<div class="container mt-5 mb-5">
    <h4 class="fw-bold mb-4 text-uppercase">
        <span class="border-bottom border-3 border-danger pb-2">Sản phẩm liên quan</span>
    </h4>
    <div class="row">
        <?php if (!empty($related_products)): ?>
            <?php foreach($related_products as $rp): ?>
                <div class="col-md-3">
                    <div class="card h-100 product-card shadow-sm border-0" style="border-radius: 15px; overflow: hidden;">
                        <a href="index.php?action=detail&id=<?= $rp['MaSP'] ?>">
                            <img src="public/uploads/<?= $rp['HinhAnh'] ?>" class="card-img-top p-3" style="height:200px; object-fit:contain" alt="<?= $rp['TenSP'] ?>">
                        </a>
                        <div class="card-body text-center">
                            <a href="index.php?action=detail&id=<?= $rp['MaSP'] ?>" class="text-decoration-none text-dark">
                                <h6 class="fw-bold small mb-1"><?= $rp['TenSP'] ?></h6>
                            </a>
                            <p class="text-danger fw-bold mb-0"><?= number_format($rp['Gia']) ?>₫</p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-muted italic ps-3">Không có sản phẩm liên quan nào.</p>
        <?php endif; ?>
    </div>
</div>
</body>
</html>