<?php
require_once __DIR__ . '/../config/db.php';

class ReportModel {
    private $conn;

    public function __construct() {
        if (!class_exists('Database')) { require_once __DIR__ . '/../config/db.php'; }
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function getTongQuan($fromDate, $toDate) {
        $data = [];

        // Tổng doanh thu (Chỉ tính đơn đã giao hoặc đã thanh toán)
        $sql = "SELECT SUM(TongTien) as DoanhThu FROM donhang 
                WHERE (TrangThai = 'DaGiao' OR TrangThai = 'DaThanhToan') 
                AND DATE(NgayDat) BETWEEN :from AND :to";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':from' => $fromDate, ':to' => $toDate]);
        $data['doanh_thu'] = $stmt->fetch(PDO::FETCH_ASSOC)['DoanhThu'] ?? 0;

        // Tổng đơn hàng
        $sql = "SELECT COUNT(*) as TongDon FROM donhang WHERE DATE(NgayDat) BETWEEN :from AND :to";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':from' => $fromDate, ':to' => $toDate]);
        $data['don_hang'] = $stmt->fetch(PDO::FETCH_ASSOC)['TongDon'];

        // Tổng khách hàng
        $sql = "SELECT COUNT(DISTINCT SDT) as KhachHang FROM donhang";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $data['khach_hang'] = $stmt->fetch(PDO::FETCH_ASSOC)['KhachHang'];

        // Tổng sản phẩm
        $sql = "SELECT COUNT(*) as SanPham FROM sanpham";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $data['san_pham'] = $stmt->fetch(PDO::FETCH_ASSOC)['SanPham'];

        return $data;
    }

    public function getBieuDoDoanhThu($fromDate, $toDate) {
        $diff = strtotime($toDate) - strtotime($fromDate);
        $days = round($diff / (60 * 60 * 24));

        // Nếu khoảng thời gian > 60 ngày thì gom nhóm theo Tháng, ngược lại theo Ngày
        if ($days > 60) {
            $sql = "SELECT DATE_FORMAT(NgayDat, '%Y-%m') as ThoiGian, SUM(TongTien) as Tien 
                    FROM donhang 
                    WHERE (TrangThai = 'DaGiao' OR TrangThai = 'DaThanhToan') 
                    AND DATE(NgayDat) BETWEEN :from AND :to
                    GROUP BY DATE_FORMAT(NgayDat, '%Y-%m')
                    ORDER BY ThoiGian ASC";
        } else {
            $sql = "SELECT DATE(NgayDat) as ThoiGian, SUM(TongTien) as Tien 
                    FROM donhang 
                    WHERE (TrangThai = 'DaGiao' OR TrangThai = 'DaThanhToan') 
                    AND DATE(NgayDat) BETWEEN :from AND :to
                    GROUP BY DATE(NgayDat)
                    ORDER BY ThoiGian ASC";
        }

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':from' => $fromDate, ':to' => $toDate]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTopSanPham($fromDate, $toDate) {
        try {
            // Lưu ý: Đã sửa ct.MaHD thành ct.MaDonHang cho khớp DB
            $sql = "SELECT sp.TenSP, SUM(ct.SoLuong) as DaBan 
                    FROM chitietdonhang ct
                    JOIN sanpham sp ON ct.MaSP = sp.MaSP
                    JOIN donhang dh ON ct.MaDonHang = dh.MaDonHang
                    WHERE (dh.TrangThai = 'DaGiao' OR dh.TrangThai = 'DaThanhToan')
                    AND DATE(dh.NgayDat) BETWEEN :from AND :to
                    GROUP BY sp.MaSP, sp.TenSP
                    ORDER BY DaBan DESC
                    LIMIT 5";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':from' => $fromDate, ':to' => $toDate]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }
}
?>