<?php
class AuthController {
    private $conn;
    public function __construct($db) { $this->conn = $db; }

    public function login($u, $p) {
        $stmt = $this->conn->prepare("SELECT * FROM TAIKHOAN WHERE TenDangNhap = ? AND TrangThai = 1");
        $stmt->execute([$u]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // So sánh trực tiếp mật khẩu (vì dữ liệu bạn có sẵn có thể chưa hash)
        if ($user && ($p === $user['MatKhau'] || password_verify($p, $user['MatKhau']))) {
            $_SESSION['user'] = $user;
            return true;
        }
        return false;
    }
}
?>