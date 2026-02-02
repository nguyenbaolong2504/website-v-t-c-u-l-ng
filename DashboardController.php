<?php
class DashboardController {
    public function index(){
        // Kết nối DB riêng để đảm bảo có biến $db
        $database = new Database();
        $db = $database->getConnection();

        // Đếm số lượng
        $product = $db->query("SELECT COUNT(*) as total FROM sanpham")->fetch()['total'];
        $supplier = $db->query("SELECT COUNT(*) as total FROM nhacungcap")->fetch()['total'];
        $customer = $db->query("SELECT COUNT(*) as total FROM taikhoan WHERE VaiTro='KHACHHANG'")->fetch()['total'];

        include "views/admin/dashboard.php";
    }
}
?>