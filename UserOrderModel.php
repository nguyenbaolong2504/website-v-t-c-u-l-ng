<?php
require_once __DIR__ . '/../config/db.php';

class UserOrderModel {
    private $conn;

    public function __construct() {
        if (!class_exists('Database')) { require_once __DIR__ . '/../config/db.php'; }
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    // 1. Tạo đơn hàng (Đã thêm hiển thị lỗi chi tiết)
    public function createOrder($data, $cart) {
        try {
            $this->conn->beginTransaction();

            // SỬA: Thêm MaKH vào INSERT. 
            // Lưu ý: Nếu Database chưa có cột MaKH hoặc Email, dòng này sẽ gây lỗi.
            $sql = "INSERT INTO donhang (NgayDat, TongTien, TrangThai, SDT, PhuongThucTT, TenKH, DiaChi, GhiChu, Email, MaKH) 
                    VALUES (NOW(), :TongTien, 'ChoDuyet', :SDT, :PhuongThucTT, :TenKH, :DiaChi, :GhiChu, :Email, :MaKH)";
            
            $stmt = $this->conn->prepare($sql);
            
            // Xử lý MaKH: Nếu không có thì để 0 (hoặc null tùy DB)
            $maKH = !empty($data['MaKH']) ? $data['MaKH'] : 0;

            $stmt->execute([
                ':TongTien' => $data['TongTien'],
                ':SDT' => $data['SDT'],
                ':PhuongThucTT' => $data['PhuongThucTT'],
                ':TenKH' => $data['TenKH'],
                ':DiaChi' => $data['DiaChi'],
                ':GhiChu' => $data['GhiChu'],
                ':Email' => $data['Email'],
                ':MaKH' => $maKH 
            ]);

            $orderId = $this->conn->lastInsertId();

            // Thêm chi tiết đơn hàng
            $sqlDetail = "INSERT INTO chitietdonhang (MaDonHang, MaSP, SoLuong, DonGia) 
                          VALUES (:MaDonHang, :MaSP, :SoLuong, :DonGia)";
            $stmtDetail = $this->conn->prepare($sqlDetail);

            foreach ($cart as $item) {
                $stmtDetail->execute([
                    ':MaDonHang' => $orderId,
                    ':MaSP' => $item['id'],
                    ':SoLuong' => $item['qty'],
                    ':DonGia' => $item['price']
                ]);
            }
            $this->conn->commit();
            return $orderId;

        } catch (Exception $e) {
            $this->conn->rollBack();
            // QUAN TRỌNG: In lỗi ra màn hình để biết chính xác sai ở đâu
            die("Lỗi SQL: " . $e->getMessage()); 
            return false;
        }
    }

    public function getOrdersByUserId($userId) {
        $sql = "SELECT * FROM donhang WHERE MaKH = :id ORDER BY NgayDat DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOrdersByPhone($phone) {
        $sql = "SELECT * FROM donhang WHERE SDT = :phone ORDER BY NgayDat DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':phone' => $phone]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOrderItems($orderId) {
        $sql = "SELECT c.*, s.TenSP, s.HinhAnh 
                FROM chitietdonhang c 
                JOIN sanpham s ON c.MaSP = s.MaSP 
                WHERE c.MaDonHang = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $orderId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOrderById($orderId) {
        $sql = "SELECT * FROM donhang WHERE MaDonHang = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $orderId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updatePaymentStatus($orderId, $status) {
        $sql = "UPDATE donhang SET TrangThai = :status WHERE MaDonHang = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':status' => $status, ':id' => $orderId]);
    }
    
    public function checkVoucher($code) {
        $sql = "SELECT * FROM khuyenmai WHERE Code = :code AND TrangThai = 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':code' => $code]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>