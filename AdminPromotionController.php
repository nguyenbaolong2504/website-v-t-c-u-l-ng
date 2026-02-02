<?php
require_once __DIR__ . '/../models/PromotionModel.php';

class AdminPromotionController {
    private $model;

    public function __construct() {
        $this->model = new PromotionModel();
    }

    public function index() {
        $keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : null;
        $promotions = $this->model->getAll($keyword);
        require_once __DIR__ . '/../views/admin/promotion/list.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'TenKM' => $_POST['TenKM'], 'Code' => $_POST['Code'], 'LoaiKM' => $_POST['LoaiKM'],
                'GiamGia' => $_POST['GiamGia'], 'NgayBatDau' => $_POST['NgayBatDau'], 'NgayKetThuc' => $_POST['NgayKetThuc']
            ];
            $this->model->create($data);
            header("Location: index.php?action=khuyenmai"); exit;
        }
        require_once __DIR__ . '/../views/admin/promotion/add.php';
    }

    public function edit() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id']; 
            $data = [
                'TenKM' => $_POST['TenKM'], 'Code' => $_POST['Code'], 'LoaiKM' => $_POST['LoaiKM'],
                'GiamGia' => $_POST['GiamGia'], 'NgayBatDau' => $_POST['NgayBatDau'],
                'NgayKetThuc' => $_POST['NgayKetThuc'], 'TrangThai' => $_POST['TrangThai']
            ];
            $this->model->update($id, $data);
            echo "<script>alert('Cập nhật thành công!'); window.location.href='index.php?action=khuyenmai';</script>";
            exit;
        }

        if (isset($_GET['id'])) {
            $promotion = $this->model->getOne($_GET['id']);
            if ($promotion) {
                require_once __DIR__ . '/../views/admin/promotion/edit.php';
            } else {
                header("Location: index.php?action=khuyenmai");
            }
        }
    }

    public function delete() {
        if (isset($_GET['id'])) {
            $this->model->delete($_GET['id']);
        }
        header("Location: index.php?action=khuyenmai");
    }
}
?>