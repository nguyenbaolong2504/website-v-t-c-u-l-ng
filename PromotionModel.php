<?php
// QUAN TRỌNG: Tên class phải là PromotionModel
class PromotionModel {
    private $conn;

    public function __construct() {
        // Kết nối CSDL
        if (class_exists('Database')) { 
            $db = new Database();
            $this->conn = $db->getConnection();
        } else {
            // Fallback nếu chưa load Database
            require_once __DIR__ . '/../config/db.php';
            $db = new Database();
            $this->conn = $db->getConnection();
        }
    }

    // Lấy tất cả (khớp với gọi hàm getAll trong index)
    public function getAll($keyword = null) {
        // Cập nhật trạng thái voucher hết hạn
        $sqlUpd = "UPDATE khuyenmai SET TrangThai = 0 WHERE NgayKetThuc < CURDATE() AND TrangThai = 1";
        $this->conn->exec($sqlUpd); 

        $sql = "SELECT * FROM khuyenmai";
        if ($keyword) {
            $sql .= " WHERE TenKM LIKE :kw OR Code LIKE :kw";
        }
        $sql .= " ORDER BY MaKM DESC";
        
        $stmt = $this->conn->prepare($sql);
        if ($keyword) {
            $stmt->execute([':kw' => "%$keyword%"]);
        } else {
            $stmt->execute();
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy 1 bản ghi
    public function getOne($id) {
        $stmt = $this->conn->prepare("SELECT * FROM khuyenmai WHERE MaKM = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Thêm mới (Nhận mảng $data từ index)
    public function create($data) {
        // Thêm cột SoLuong vào câu SQL
        $sql = "INSERT INTO khuyenmai (TenKM, Code, LoaiKM, GiamGia, SoLuong, NgayBatDau, NgayKetThuc, TrangThai) 
                VALUES (:ten, :code, :loai, :giam, :sl, :batdau, :ketthuc, 1)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':ten' => $data['TenKM'], 
            ':code' => $data['Code'], 
            ':loai' => $data['LoaiKM'],
            ':giam' => $data['GiamGia'], 
            ':sl' => $data['SoLuong'], 
            ':batdau' => $data['NgayBatDau'], 
            ':ketthuc' => $data['NgayKetThuc']
        ]);
    }

    // Cập nhật (Nhận $id và mảng $data)
    public function update($id, $data) {
        $sql = "UPDATE khuyenmai SET TenKM=:ten, Code=:code, LoaiKM=:loai, GiamGia=:giam, 
                SoLuong=:sl, NgayBatDau=:batdau, NgayKetThuc=:ketthuc, TrangThai=:trangthai 
                WHERE MaKM=:id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':ten' => $data['TenKM'], 
            ':code' => $data['Code'], 
            ':loai' => $data['LoaiKM'],
            ':giam' => $data['GiamGia'], 
            ':sl' => $data['SoLuong'],
            ':batdau' => $data['NgayBatDau'], 
            ':ketthuc' => $data['NgayKetThuc'],
            ':trangthai' => $data['TrangThai'], 
            ':id' => $id
        ]);
    }

    // Xóa
    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM khuyenmai WHERE MaKM = :id");
        return $stmt->execute([':id' => $id]);
    }
}
?>