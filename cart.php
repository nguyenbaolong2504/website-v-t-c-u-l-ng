<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Giỏ hàng - Badminton Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        .cart-item-img { width: 80px; height: 80px; object-fit: contain; }
        .table align-middle td { vertical-align: middle; }
    </style>
</head>
<body class="bg-light">
    <div class="container mt-5">
    <h3 class="fw-bold mb-4"><i class="bi bi-cart3 me-2"></i>GIỎ HÀNG</h3>
    
    <?php if(!empty($_SESSION['cart'])): ?>
    <form action="index.php?action=update_cart" method="POST">
        <div class="row">
            <div class="col-md-8">
                <div class="card shadow-sm border-0 p-3 mb-3">
                    <table class="table align-middle">
                        <thead>
                            <tr class="text-muted small">
                                <th>SẢN PHẨM</th>
                                <th>GIÁ</th>
                                <th style="width: 100px;">SỐ LƯỢNG</th>
                                <th>THÀNH TIỀN</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $total = 0; foreach($_SESSION['cart'] as $id => $item): 
                                $subtotal = $item['price'] * $item['qty'];
                                $total += $subtotal;
                            ?>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="public/uploads/<?= $item['img'] ?>" class="cart-item-img me-3" style="width:60px; height:60px; object-fit:contain;">
                                        <span class="fw-bold small"><?= $item['name'] ?></span>
                                    </div>
                                </td>
                                <td><?= number_format($item['price']) ?>đ</td>
                                <td>
                                    <input type="number" name="qty[<?= $id ?>]" value="<?= $item['qty'] ?>" min="1" class="form-control form-control-sm text-center">
                                </td>
                                <td class="text-danger fw-bold"><?= number_format($subtotal) ?>đ</td>
                                <td>
                                    <a href="index.php?action=remove_cart&id=<?= $id ?>" class="text-danger" onclick="return confirm('Xóa sản phẩm này?')">
                                        <i class="bi bi-x-circle-fill"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    
                    <div class="d-flex justify-content-between border-top pt-3">
                        <a href="index.php" class="btn btn-outline-dark btn-sm rounded-pill px-3">
                            <i class="bi bi-arrow-left"></i> Tiếp tục mua sắm
                        </a>
                        <button type="submit" class="btn btn-dark btn-sm rounded-pill px-3">
                            <i class="bi bi-arrow-clockwise"></i> Cập nhật giỏ hàng
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm border-0 p-4">
                    <h5 class="fw-bold mb-3">TẠM TÍNH</h5>
                    <div class="d-flex justify-content-between mb-4">
                        <span class="fs-4">Tổng tiền:</span>
                        <span class="fs-4 text-danger fw-bold"><?= number_format($total) ?>đ</span>
                    </div>
                    <a href="index.php?action=checkout" class="btn btn-danger w-100 py-3 fw-bold rounded-pill shadow">
    TIẾN HÀNH ĐẶT HÀNG
</a>
                </div>
            </div>
        </div>
    </form>
    <?php else: ?>
        <div class="text-center py-5 bg-white rounded shadow-sm">
            <i class="bi bi-cart-x fs-1 text-muted"></i>
            <p class="mt-3">Giỏ hàng của bạn đang trống!</p>
            <a href="index.php" class="btn btn-primary rounded-pill px-4">QUAY LẠI CỬA HÀNG</a>
        </div>
    <?php endif; ?>
</div>
</body>
</html>