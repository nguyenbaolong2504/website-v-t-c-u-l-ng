<?php
class Category {
    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }

    public function listAll(){
        return $this->conn->query("SELECT * FROM danhmuc ORDER BY MaDanhMuc DESC");
    }

    public function search($keyword){
        return $this->conn->query("SELECT * FROM danhmuc WHERE TenDanhMuc LIKE '%$keyword%'");
    }

    public function add($ten){
        $stmt = $this->conn->prepare("INSERT INTO danhmuc (TenDanhMuc) VALUES (?)");
        return $stmt->execute([$ten]);
    }

    public function update($id, $ten){
        $stmt = $this->conn->prepare("UPDATE danhmuc SET TenDanhMuc=? WHERE MaDanhMuc=?");
        return $stmt->execute([$ten, $id]);
    }

    public function delete($id){
        // Xóa sản phẩm thuộc danh mục này trước (nếu cần) hoặc set NULL
        // Ở đây ta xóa trực tiếp, cẩn thận ràng buộc khóa ngoại
        try {
            $stmt = $this->conn->prepare("DELETE FROM danhmuc WHERE MaDanhMuc=?");
            return $stmt->execute([$id]);
        } catch(PDOException $e) {
            echo "<script>alert('Không thể xóa danh mục này vì còn sản phẩm bên trong!');</script>";
        }
    }
}
?>