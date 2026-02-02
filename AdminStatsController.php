<?php
require_once __DIR__ . '/../models/ReportModel.php';

class AdminStatsController {
    private $model;

    public function __construct() {
        $this->model = new ReportModel();
    }

    public function index() {
        // Mặc định: Từ đầu tháng đến hiện tại
        $fromDate = isset($_GET['from']) ? $_GET['from'] : date('Y-m-01');
        $toDate = isset($_GET['to']) ? $_GET['to'] : date('Y-m-d');

        // Gọi dữ liệu từ Model
        $totals = $this->model->getTongQuan($fromDate, $toDate);
        $chartData = $this->model->getBieuDoDoanhThu($fromDate, $toDate);
        $topProducts = $this->model->getTopSanPham($fromDate, $toDate);

        // Xử lý dữ liệu cho biểu đồ ChartJS
        $labels = []; 
        $values = [];
        foreach ($chartData as $item) {
            // Format ngày cho đẹp (Ngày/Tháng)
            $labels[] = date('d/m', strtotime($item['ThoiGian']));
            $values[] = $item['Tien'];
        }

        // Gọi View
        require_once __DIR__ . '/../views/admin/stats.php';
    }
}
?>