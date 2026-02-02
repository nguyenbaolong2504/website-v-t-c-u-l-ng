<?php
class Product {
    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }

    // Lấy tất cả sản phẩm
    public function listAll(){
        $sql = "SELECT p.*, d.TenDanhMuc, n.TenNCC 
                FROM sanpham p 
                LEFT JOIN danhmuc d ON p.MaDanhMuc = d.MaDanhMuc
                LEFT JOIN nhacungcap n ON p.MaNCC = n.MaNCC
                ORDER BY p.MaSP DESC";
        return $this->conn->query($sql);
    }

    // Tìm kiếm
    public function search($keyword){
        $sql = "SELECT p.*, d.TenDanhMuc 
                FROM sanpham p 
                LEFT JOIN danhmuc d ON p.MaDanhMuc = d.MaDanhMuc
                WHERE p.TenSP LIKE '%$keyword%'";
        return $this->conn->query($sql);
    }

    // Lấy chi tiết 1 sản phẩm
    public function getDetail($id){
        $stmt = $this->conn->prepare("SELECT * FROM sanpham WHERE MaSP = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Thêm mới
    public function add($ten, $gia, $sl, $mota, $anh, $madm){
        $sql = "INSERT INTO sanpham (TenSP, Gia, SoLuong, MoTa, HinhAnh, MaDanhMuc) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$ten, $gia, $sl, $mota, $anh, $madm]);
    }

    // Cập nhật
    public function update($id, $ten, $gia, $sl, $mota, $anh, $madm){
        if($anh != ""){
            $sql = "UPDATE sanpham SET TenSP=?, Gia=?, SoLuong=?, MoTa=?, HinhAnh=?, MaDanhMuc=? WHERE MaSP=?";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([$ten, $gia, $sl, $mota, $anh, $madm, $id]);
        } else {
            $sql = "UPDATE sanpham SET TenSP=?, Gia=?, SoLuong=?, MoTa=?, MaDanhMuc=? WHERE MaSP=?";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([$ten, $gia, $sl, $mota, $madm, $id]);
        }
    }

    // Xóa
    public function delete($id){
        $stmt = $this->conn->prepare("DELETE FROM sanpham WHERE MaSP=?");
        return $stmt->execute([$id]);
    }

    // Cập nhật kho (cho phần quản lý kho)
    public function updateStock($id, $qty) {
        $sql = "UPDATE sanpham SET SoLuong = SoLuong + ? WHERE MaSP = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$qty, $id]);
    }

    // --- Các hàm phụ trợ ---
    public function listCategories(){
        return $this->conn->query("SELECT * FROM danhmuc");
    }

    public function listAllNCC(){
        return $this->conn->query("SELECT * FROM nhacungcap");
    }
    
    // Lấy sản phẩm liên quan (cho trang chi tiết)
    public function getRelated($madm, $excludeId){
        $sql = "SELECT * FROM sanpham WHERE MaDanhMuc = ? AND MaSP != ? LIMIT 4";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$madm, $excludeId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // Lấy sản phẩm theo danh mục (cho trang chủ)
    public function listByCategory($madm){
        $sql = "SELECT * FROM sanpham WHERE MaDanhMuc = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$madm]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lọc theo danh mục và NCC
    public function listByFilter($madm, $mancc){
        $sql = "SELECT * FROM sanpham WHERE MaDanhMuc = ? AND MaNCC = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$madm, $mancc]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>