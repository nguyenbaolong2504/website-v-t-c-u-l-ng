<?php
require_once __DIR__ . '/../config/db.php';

class AdminOrderModel {
    private $conn;

    public function __construct() {
        if (!class_exists('Database')) { require_once __DIR__ . '/../config/db.php'; }
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    // ĐÃ SỬA: Thêm tham số $keyword để phục vụ chức năng tìm kiếm
    public function getAllOrders($keyword = null) {
        $sql = "SELECT * FROM donhang";
        
        // Nếu có từ khóa thì thêm điều kiện tìm kiếm
        if ($keyword && !empty($keyword)) {
            $sql .= " WHERE MaDonHang LIKE :kw 
                      OR TenKH LIKE :kw 
                      OR SDT LIKE :kw";
        }
        
        $sql .= " ORDER BY NgayDat DESC";
        
        $stmt = $this->conn->prepare($sql);
        
        if ($keyword && !empty($keyword)) {
            $stmt->execute([':kw' => "%$keyword%"]);
        } else {
            $stmt->execute();
        }
        
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
    
    public function getOrderById($id) {
        $sql = "SELECT * FROM donhang WHERE MaDonHang = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateStatus($id, $status) {
        $sql = "UPDATE donhang SET TrangThai = :status WHERE MaDonHang = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':status' => $status, ':id' => $id]);
    }

    public function deleteOrder($id) {
        try {
            $this->conn->beginTransaction();
            
            // Xóa chi tiết trước
            $stmt1 = $this->conn->prepare("DELETE FROM chitietdonhang WHERE MaDonHang = :id");
            $stmt1->execute([':id' => $id]);
            
            // Xóa đơn hàng sau
            $stmt2 = $this->conn->prepare("DELETE FROM donhang WHERE MaDonHang = :id");
            $stmt2->execute([':id' => $id]);
            
            $this->conn->commit();
            return true;
        } catch (Exception $e) {
            $this->conn->rollBack();
            return false;
        }
    }
}
?>