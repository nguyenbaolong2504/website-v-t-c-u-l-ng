<!DOCTYPE html>
<html lang="vi">
<head>
    <title>Thanh Toán</title>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f8f9fa; font-family: 'Segoe UI', sans-serif; }
        .container { max-width: 1100px; margin: 40px auto; display: grid; grid-template-columns: 1.8fr 1.2fr; gap: 40px; }
        .form-control { width: 100%; padding: 12px 15px; border: 1px solid #ddd; margin-bottom: 15px; }
        .order-summary { background: #fff; padding: 25px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
        .cart-item { display: flex; gap: 15px; margin-bottom: 15px; border-bottom: 1px solid #eee; padding-bottom: 15px; }
        .cart-img { width: 60px; height: 60px; object-fit: cover; }
        .btn-checkout { width: 100%; background: #000; color: white; padding: 18px; border: none; font-weight: bold; cursor: pointer; text-transform: uppercase; }
        .payment-label { display: flex; align-items: center; justify-content: center; height: 60px; border: 1px solid #ddd; cursor: pointer; background: white; width: 100%; }
        input[type="radio"]:checked + .payment-label { border: 2px solid #007bff; background: #f0f7ff; }
    </style>
</head>
<body>
    <form action="index.php?action=checkout" method="POST">
    <div class="container">
        <div>
            <h2>Thông tin giao hàng</h2>
            <div class="row">
                <div class="col-6"><input type="text" name="ho" class="form-control" placeholder="Họ" required></div>
                <div class="col-6"><input type="text" name="ten" class="form-control" placeholder="Tên" required></div>
            </div>
            <input type="email" name="email" class="form-control" placeholder="Email">
            <input type="text" name="phone" class="form-control" placeholder="Số điện thoại" required>
            <input type="text" name="address" class="form-control" placeholder="Địa chỉ nhà" required>
            <div class="row">
                <div class="col-6"><input type="text" name="district" class="form-control" placeholder="Quận / Huyện" required></div>
                <div class="col-6"><input type="text" name="city" class="form-control" placeholder="Tỉnh / Thành phố" required></div>
            </div>
            <textarea name="note" class="form-control" rows="3" placeholder="Ghi chú thêm"></textarea>
        </div>

        <div class="order-summary">
            <h3>Đơn hàng của bạn</h3>
            <div style="max-height: 300px; overflow-y: auto;">
                <?php if(!empty($cart)): foreach($cart as $item): ?>
                <div class="cart-item">
                    <img src="public/uploads/<?php echo $item['img']; ?>" class="cart-img">
                    <div>
                        <strong><?php echo $item['name']; ?></strong><br>
                        <small>x<?php echo $item['qty']; ?></small>
                    </div>
                    <div style="margin-left: auto; font-weight: bold;"><?php echo number_format($item['price'] * $item['qty']); ?> đ</div>
                </div>
                <?php endforeach; endif; ?>
            </div>

            <div class="d-flex justify-content-between mt-3"><span>Tạm tính</span><span><?php echo number_format($total); ?> đ</span></div>
            <div class="d-flex justify-content-between"><span>Phí giao hàng</span><span>30.000 đ</span></div>
            
            <div id="discountRow" class="d-flex justify-content-between text-success fw-bold" style="display: none !important;">
                <span>Voucher giảm giá <span id="voucherDetail"></span>:</span>
                <span id="discountAmount">-0 đ</span>
            </div>

            <div class="d-flex justify-content-between border-top pt-3 mt-3 fw-bold fs-5">
                <span>Tổng cộng</span>
                <span id="displayTotal" style="color: #d63031;"><?php echo number_format($total + 30000); ?> đ</span>
                <input type="hidden" name="real_total" id="realTotalInput" value="<?php echo $total + 30000; ?>">
                <input type="hidden" id="originalTotal" value="<?php echo $total; ?>">
            </div>

            <div class="input-group mt-3 mb-3">
                <input type="text" id="couponInput" name="coupon" class="form-control mb-0" placeholder="Mã giảm giá">
                <button type="button" class="btn btn-dark" onclick="applyCoupon()">Áp dụng</button>
            </div>

            <h5 class="mt-4">Phương thức thanh toán</h5>
            <div class="d-flex gap-2">
                <div style="flex:1;">
                    <input type="radio" name="payment_method" id="momo" value="momo" hidden>
                    <label for="momo" class="payment-label">
                        <img src="public/uploads/momo.webp" style="height: 30px;"> <span class="ms-2 text-danger fw-bold">MoMo</span>
                    </label>
                </div>
                <div style="flex:1;">
                    <input type="radio" name="payment_method" id="cod" value="cod" hidden checked>
                    <label for="cod" class="payment-label">
                        <span class="fw-bold">Tiền mặt (COD)</span>
                    </label>
                </div>
            </div>

            <button type="submit" name="order_now" class="btn-checkout mt-3">ĐẶT HÀNG NGAY</button>
        </div>
    </div>
    </form>

    <script>
        function applyCoupon() {
            var code = document.getElementById('couponInput').value;
            if(!code) { alert("Vui lòng nhập mã giảm giá!"); return; }

            var formData = new FormData(); 
            formData.append('coupon', code);

            fetch('index.php?action=check_code', { method: 'POST', body: formData })
            .then(r => r.json())
            .then(res => {
                if(res.status) {
                    var total = parseInt(document.getElementById('originalTotal').value);
                    var discountVal = 0;
                    var displayText = '';

                    // --- ĐÃ SỬA: Logic hiển thị % hoặc số tiền ---
                    if(res.data.LoaiKM == 'phantram') {
                        // Nếu là %: Tính tiền và hiện text kèm %
                        var percent = parseInt(res.data.GiamGia);
                        discountVal = (total * percent) / 100;
                        displayText = '-' + discountVal.toLocaleString('vi-VN') + ' đ (' + percent + '%)';
                    } else {
                        // Nếu là tiền: Hiện số tiền bình thường
                        discountVal = parseInt(res.data.GiamGia);
                        displayText = '-' + discountVal.toLocaleString('vi-VN') + ' đ';
                    }

                    // Tính lại tổng
                    var newTotal = total + 30000 - discountVal;
                    if(newTotal < 0) newTotal = 0;

                    // Cập nhật giao diện
                    document.getElementById('discountRow').style.setProperty('display', 'flex', 'important');
                    document.getElementById('discountAmount').innerText = displayText;
                    
                    document.getElementById('displayTotal').innerText = newTotal.toLocaleString('vi-VN') + ' đ';
                    document.getElementById('realTotalInput').value = newTotal;
                    
                    alert(res.message);
                } else { 
                    // Reset nếu mã sai
                    alert(res.message); 
                    document.getElementById('discountRow').style.setProperty('display', 'none', 'important');
                    var total = parseInt(document.getElementById('originalTotal').value);
                    document.getElementById('displayTotal').innerText = (total + 30000).toLocaleString('vi-VN') + ' đ';
                    document.getElementById('realTotalInput').value = total + 30000;
                }
            })
            .catch(err => {
                console.error(err);
                alert("Có lỗi xảy ra khi kiểm tra mã.");
            });
        }
    </script>
</body>
</html>