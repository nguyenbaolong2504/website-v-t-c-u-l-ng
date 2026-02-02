<?php
class Customer {
    private $db;

    public function __construct($db){
        $this->db = $db;
    }

    public function listAll(){
        return $this->db->query("
            SELECT 
                tk.MaTK, tk.TenDangNhap, tk.MatKhau, tk.VaiTro, tk.TrangThai,
                kh.TenKH, kh.Email, kh.SoDienThoai, kh.DiaChi, kh.NgayDangKy
            FROM taikhoan tk
            LEFT JOIN khachhang kh ON tk.MaTK = kh.MaTK
            WHERE tk.VaiTro = 'KHACHHANG'
            ORDER BY tk.MaTK DESC
        ");
    }

    public function delete($id){
        // Xóa thông tin khách hàng trước (do ràng buộc khóa ngoại)
        $this->db->query("DELETE FROM khachhang WHERE MaTK = $id");
        // Sau đó xóa tài khoản
        $stmt = $this->db->prepare("DELETE FROM taikhoan WHERE MaTK=?");
        return $stmt->execute([$id]);
    }
}
?>