<?php
require_once __DIR__ . '/../models/UserOrderModel.php';

class UserOrderController {
    private $model;

    public function __construct() {
        $this->model = new UserOrderModel();
        if (session_status() === PHP_SESSION_NONE) { session_start(); }
    }

    // --- HIỂN THỊ LỊCH SỬ ĐƠN HÀNG ---
    public function history() {
        $rawOrders = [];

        // 1. Kiểm tra User ID từ Session
        $userId = 0;
        if (isset($_SESSION['user'])) {
            // SỬA: Ưu tiên lấy MaTK theo yêu cầu của bạn
            if (!empty($_SESSION['user']['MaTK'])) {
                $userId = $_SESSION['user']['MaTK'];
            } elseif (!empty($_SESSION['user']['MaKH'])) {
                $userId = $_SESSION['user']['MaKH'];
            } elseif (!empty($_SESSION['user']['id'])) {
                $userId = $_SESSION['user']['id'];
            }
        }

        // Ưu tiên 1: Lấy theo User ID (MaTK)
        if ($userId > 0) {
            $rawOrders = $this->model->getOrdersByUserId($userId);
        }
        // Ưu tiên 2: Lấy theo SĐT (trường hợp vừa mua xong chưa đăng nhập)
        elseif (isset($_GET['phone'])) {
            $rawOrders = $this->model->getOrdersByPhone($_GET['phone']);
        }
        // Không có gì -> Về trang chủ
        else {
            header("Location: index.php?action=home");
            exit;
        }

        // Cấu trúc dữ liệu chuẩn cho View
        $orders = [];
        if (!empty($rawOrders)) {
            foreach ($rawOrders as $order) {
                $items = $this->model->getOrderItems($order['MaDonHang']);
                $orders[] = [
                    'info' => $order,
                    'items' => $items
                ];
            }
        }

        require_once __DIR__ . '/../views/user/history.php';
    }

    // --- XỬ LÝ THANH TOÁN (CHECKOUT) ---
    public function checkout() {
        $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
        if (empty($cart)) {
            header("Location: index.php?action=cart"); exit;
        }
        
        $total = 0;
        foreach ($cart as $item) { $total += $item['price'] * $item['qty']; }

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['order_now'])) {
            
            // --- LẤY ID USER (MaTK) ---
            $maUser = 0;
            if (isset($_SESSION['user'])) {
                // SỬA: Ưu tiên lấy MaTK
                if (!empty($_SESSION['user']['MaTK'])) {
                    $maUser = $_SESSION['user']['MaTK'];
                } elseif (!empty($_SESSION['user']['MaKH'])) {
                    $maUser = $_SESSION['user']['MaKH'];
                } elseif (!empty($_SESSION['user']['id'])) {
                    $maUser = $_SESSION['user']['id'];
                }
            }

            // Kiểm tra session (nếu đang đăng nhập mà ko lấy được ID)
            if (isset($_SESSION['user']) && $maUser == 0) {
                echo "<script>alert('Phiên đăng nhập lỗi. Vui lòng đăng nhập lại!'); window.location.href='logout.php';</script>";
                exit;
            }

            $data = [
                'MaKH' => $maUser, // Truyền MaTK vào đây để lưu xuống DB
                'TenKH' => ($_POST['ho'] ?? '') . ' ' . ($_POST['ten'] ?? ''),
                'SDT' => $_POST['phone'] ?? '',
                'Email' => $_POST['email'] ?? '',
                'DiaChi' => ($_POST['address'] ?? '') . ', ' . ($_POST['district'] ?? '') . ', ' . ($_POST['city'] ?? ''),
                'TongTien' => $_POST['real_total'] ?? $total,
                'PhuongThucTT' => $_POST['payment_method'] ?? 'cod',
                'GhiChu' => $_POST['note'] ?? ''
            ];

            $orderId = $this->model->createOrder($data, $cart);

            if ($orderId) {
                unset($_SESSION['cart']); 
                if ($data['PhuongThucTT'] == 'momo') {
                    $this->momoPayment($orderId, $data['TongTien']); 
                } else {
                    echo "<script>alert('Đặt hàng thành công!'); window.location.href='index.php?action=history&phone=" . $data['SDT'] . "';</script>";
                }
                exit;
            } else {
                echo "<script>alert('Lỗi tạo đơn hàng! Vui lòng thử lại.');</script>";
            }
        }
        require_once __DIR__ . '/../views/user/checkout.php';
    }

    public function momoPayment($orderId, $amount) {
        if ($amount < 10000) $amount = 10000; 
        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
        $partnerCode = "MOMOBKUN20180529";
        $accessKey = "klm05TvNBzhg7h7j";
        $secretKey = "at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa";
        $requestId = time() . "";
        $redirectUrl = "http://localhost/web_banhang/index.php?action=momoReturn";
        $ipnUrl = "http://localhost/web_banhang/index.php?action=momoReturn";
        
        $momoOrderId = $orderId . '_' . time();
        $rawHash = "accessKey=$accessKey&amount=$amount&extraData=&ipnUrl=$ipnUrl&orderId=$momoOrderId&orderInfo=Thanh toan don hang #$orderId&partnerCode=$partnerCode&redirectUrl=$redirectUrl&requestId=$requestId&requestType=payWithATM";
        $signature = hash_hmac("sha256", $rawHash, $secretKey);

        $data = ['partnerCode' => $partnerCode, 'partnerName' => "Test MoMo", "storeId" => "MomoTestStore", 'requestId' => $requestId, 'amount' => $amount, 'orderId' => $momoOrderId, 'orderInfo' => "Thanh toan don hang #$orderId", 'redirectUrl' => $redirectUrl, 'ipnUrl' => $ipnUrl, 'lang' => 'vi', 'extraData' => "", 'requestType' => "payWithATM", 'signature' => $signature];

        $ch = curl_init($endpoint);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        curl_close($ch);
        
        $jsonResult = json_decode($result, true);
        if(isset($jsonResult['payUrl'])) {
            header('Location: ' . $jsonResult['payUrl']); exit;
        } else {
            echo "Lỗi MoMo: " . ($jsonResult['message'] ?? 'Unknown');
        }
    }

    public function momoReturn() {
        if(isset($_GET['resultCode']) && $_GET['resultCode'] == '0') {
            $realOrderId = explode('_', $_GET['orderId'])[0];
            $this->model->updatePaymentStatus($realOrderId, 'DaThanhToan');
            echo "<script>alert('Thanh toán thành công!'); window.location.href = 'index.php?action=history';</script>";
        } else {
            echo "<script>alert('Thanh toán thất bại!'); window.location.href = 'index.php?action=history';</script>";
        }
    }
    
    public function checkCode() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $voucher = $this->model->checkVoucher($_POST['coupon'] ?? '');
            echo json_encode(['status' => (bool)$voucher, 'data' => $voucher, 'message' => $voucher ? 'Áp dụng mã thành công!' : 'Mã không tồn tại!']);
            exit;
        }
    }

    public function orderDetail() {
        if (!isset($_GET['id'])) {
            header("Location: index.php?action=history"); exit;
        }

        $orderId = $_GET['id'];
        
        // 1. Lấy thông tin đơn hàng
        $order = $this->model->getOrderById($orderId);
        
        // 2. Lấy danh sách sản phẩm
        $items = $this->model->getOrderItems($orderId);

        if (!$order) {
            echo "<script>alert('Đơn hàng không tồn tại!'); window.location.href='index.php?action=history';</script>";
            exit;
        }

        require_once __DIR__ . '/../views/user/order_detail.php';
    }
}
?>