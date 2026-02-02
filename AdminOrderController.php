<?php
require_once __DIR__ . '/../models/AdminOrderModel.php';

class AdminOrderController {
    private $model;

    public function __construct() {
        $this->model = new AdminOrderModel();
    }

    public function index() {
        // --- THÊM LOGIC TÌM KIẾM ---
        $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
        
        // Gọi hàm getAllOrders có truyền keyword (Bạn cần sửa model để nhận tham số này)
        // Nếu model chưa hỗ trợ, nó sẽ bỏ qua tham số và lấy hết như cũ
        $rawOrders = $this->model->getAllOrders($keyword);
        
        $orders = [];
        if (!empty($rawOrders)) {
            foreach ($rawOrders as $order) {
                // Đảm bảo lấy đúng ID
                $id = isset($order['MaDonHang']) ? $order['MaDonHang'] : $order['id']; // Fallback nếu tên cột khác
                $items = $this->model->getOrderItems($id);
                $orders[] = [
                    'info' => $order,
                    'items' => $items
                ];
            }
        }
        require_once __DIR__ . '/../views/admin/order_list.php';
    }
    
    public function detail() {
        if (isset($_GET['id'])) {
            $order = $this->model->getOrderById($_GET['id']);
            $items = $this->model->getOrderItems($_GET['id']);
            require_once __DIR__ . '/../views/admin/order_detail.php';
        } else {
            header('Location: index.php?action=quanlydonhang');
        }
    }

    public function updateStatus() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id']; 
            $status = $_POST['TrangThai'];
            $this->model->updateStatus($id, $status);
            
            if(isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], 'chitietdonhang') !== false) {
                 header("Location: index.php?action=chitietdonhang&id=$id");
            } else {
                 header("Location: index.php?action=quanlydonhang");
            }
            exit;
        }
    }

    public function delete() {
        if (isset($_GET['id'])) {
            $this->model->deleteOrder($_GET['id']);
        }
        header("Location: index.php?action=quanlydonhang");
        exit;
    }
}
?>