<?php
require_once 'models/Customer.php';

class CustomerController {
    public function index(){
        $database = new Database();
        $db = $database->getConnection();
        $model = new Customer($db);

        // Xử lý xóa
        if(isset($_GET['del'])){
            $model->delete($_GET['del']);
            echo "<script>alert('Đã xóa khách hàng thành công!'); window.location.href='index.php?action=customer';</script>";
            exit();
        }

        $customers = $model->listAll();
        include 'views/admin/customer_list.php';
    }
}
?>