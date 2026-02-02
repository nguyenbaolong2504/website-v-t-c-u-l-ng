<?php
session_start();
// Bật hiển thị lỗi để dễ debug (Tắt khi chạy chính thức)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// =================================================================
// 1. KẾT NỐI DATABASE & MODELS CƠ BẢN
// =================================================================
require_once 'config/db.php';
require_once 'models/Product.php';
require_once 'models/Category.php';

// Nạp các Controllers (Kiểm tra file tồn tại để tránh lỗi sập web)
// --- Nhóm User ---
if (file_exists('controllers/AuthController.php')) require_once 'controllers/AuthController.php';
if (file_exists('controllers/UserOrderController.php')) require_once 'controllers/UserOrderController.php';

// --- Nhóm Admin Cũ ---
if (file_exists('controllers/AdminOrderController.php')) require_once 'controllers/AdminOrderController.php';
if (file_exists('controllers/AdminStatsController.php')) require_once 'controllers/AdminStatsController.php';

// --- Nhóm Admin Mới (Tổng quan, Khách, NCC, Kho) ---
if (file_exists('controllers/DashboardController.php')) require_once 'controllers/DashboardController.php';
if (file_exists('controllers/CustomerController.php')) require_once 'controllers/CustomerController.php';
if (file_exists('controllers/SupplierController.php')) require_once 'controllers/SupplierController.php';
if (file_exists('controllers/StockController.php')) require_once 'controllers/StockController.php';

// =================================================================
// 2. KHỞI TẠO ĐỐI TƯỢNG DÙNG CHUNG
// =================================================================
$database = new Database();
$db = $database->getConnection();
$productModel = new Product($db);
$categoryModel = new Category($db); 
$authController = new AuthController($db);

// Lấy action từ URL (Mặc định là home)
$action = $_GET['action'] ?? 'home';

// =================================================================
// 3. XỬ LÝ ĐĂNG NHẬP (Global)
// =================================================================
if (isset($_POST['login_submit'])) {
    if ($authController->login($_POST['user'], $_POST['pass'])) {
        // Admin vào Overview (Tổng quan), User vào Home
        $target = ($_SESSION['user']['VaiTro'] == 'ADMIN') ? 'overview' : 'home';
        header("Location: index.php?action=$target");
        exit();
    } else {
        echo "<script>alert('Sai tài khoản hoặc mật khẩu!');</script>";
    }
}

// =================================================================
// 4. BỘ ĐIỀU HƯỚNG (ROUTER)
// =================================================================
switch ($action) {

    // =============================================================
    // KHU VỰC ADMIN - TỔNG QUAN & BÁO CÁO
    // =============================================================
    case 'overview': // Trang tổng quan
        checkAdmin();
        $ctrl = new DashboardController();
        $ctrl->index();
        break;

    case 'dashboard': // Báo cáo thống kê
        checkAdmin();
        if (class_exists('AdminStatsController')) {
            $statsCtrl = new AdminStatsController();
            $statsCtrl->index();
        } else {
            echo "Chưa có AdminStatsController.";
        }
        break;

    // =============================================================
    // KHU VỰC ADMIN - QUẢN LÝ SẢN PHẨM (Logic cũ)
    // =============================================================
    case 'admin': 
    case 'product_list':
        checkAdmin();

        // Xử lý XÓA
        if (isset($_GET['del'])) {
            $productModel->delete($_GET['del']);
            header("Location: index.php?action=product_list"); exit();
        }

        // Xử lý SỬA
        if (isset($_POST['edit_sp'])) {
            $id = $_POST['masp'];
            $anh = $_FILES['anh']['name'];
            if ($anh != "") {
                move_uploaded_file($_FILES['anh']['tmp_name'], "public/uploads/" . $anh);
            }
            $productModel->update($id, $_POST['ten'], $_POST['gia'], $_POST['sl'], $_POST['mota'], $anh, $_POST['madm']);
            header("Location: index.php?action=product_list"); exit();
        }

        // Xử lý THÊM
        if (isset($_POST['add_sp'])) {
            $anh = $_FILES['anh']['name'];
            move_uploaded_file($_FILES['anh']['tmp_name'], "public/uploads/" . $anh);
            $productModel->add($_POST['ten'], $_POST['gia'], $_POST['sl'], $_POST['mota'], $anh, $_POST['madm']);
            header("Location: index.php?action=product_list"); exit();
        }

        // Hiển thị view
        $keyword = $_GET['keyword'] ?? '';
        $products = ($keyword != '') ? $productModel->search($keyword) : $productModel->listAll();
        $categories = $productModel->listCategories();
        $brands = $productModel->listAllNCC(); 
        
        include 'views/admin/product_list.php';
        break;

    // =============================================================
    // KHU VỰC ADMIN - QUẢN LÝ DANH MỤC
    // =============================================================
    case 'admin_category':
    case 'category_list':
        checkAdmin();
        if (isset($_POST['add_dm'])) { $categoryModel->add($_POST['ten']); header("Location: index.php?action=category_list"); exit(); }
        if (isset($_POST['edit_dm'])) { $categoryModel->update($_POST['madm'], $_POST['ten']); header("Location: index.php?action=category_list"); exit(); }
        if (isset($_GET['del_dm'])) { $categoryModel->delete($_GET['del_dm']); header("Location: index.php?action=category_list"); exit(); }
        
        $kw = $_GET['keyword'] ?? '';
        $categories = ($kw != '') ? $categoryModel->search($kw) : $categoryModel->listAll();
        include 'views/admin/category_list.php'; 
        break;

    // =============================================================
    // KHU VỰC ADMIN - CÁC MODULE MỚI (KHO, KHÁCH, NCC)
    // =============================================================
    case 'stock': // Quản lý kho
        checkAdmin();
        $ctrl = new StockController($db); // Truyền db vào controller
        $ctrl->index();
        break;

    case 'stock_update': // Cập nhật kho
        checkAdmin();
        $ctrl = new StockController($db);
        $ctrl->update();
        break;

    case 'customer': // Quản lý khách hàng
        checkAdmin();
        $ctrl = new CustomerController();
        $ctrl->index();
        break;

    case 'supplier': // Quản lý nhà cung cấp
        checkAdmin();
        $ctrl = new SupplierController();
        $ctrl->index();
        break;

    // =============================================================
    // KHU VỰC ADMIN - QUẢN LÝ ĐƠN HÀNG
    // =============================================================
    case 'quanlydonhang':
    case 'order_list':
        checkAdmin();
        $ctrl = new AdminOrderController();
        $ctrl->index();
        break;

    case 'chitietdonhang': checkAdmin(); $ctrl = new AdminOrderController(); $ctrl->detail(); break;
    case 'capnhatdonhang': checkAdmin(); $ctrl = new AdminOrderController(); $ctrl->updateStatus(); break;
    case 'xoadonhang':     checkAdmin(); $ctrl = new AdminOrderController(); $ctrl->delete(); break;

    // =============================================================
    // KHU VỰC ADMIN - QUẢN LÝ KHUYẾN MÃI (Dùng PromotionModel.php)
    // =============================================================
    case 'khuyenmai':
    case 'voucher_list':
        checkAdmin();
        
        // 1. Kiểm tra và gọi PromotionModel
        if(file_exists('models/PromotionModel.php')){
            require_once 'models/PromotionModel.php';
            // Khởi tạo Model (PromotionModel tự kết nối DB trong constructor)
            $promoModel = new PromotionModel();

            // 2. Xử lý THÊM MỚI (Mapping dữ liệu từ POST sang mảng $data)
            if (isset($_POST['add_km'])) {
                $data = [
                    'TenKM'       => $_POST['ten'],
                    'Code'        => $_POST['code'],
                    'LoaiKM'      => $_POST['loai'],
                    'GiamGia'     => $_POST['giatri'],
                    'SoLuong'     => $_POST['sl'],
                    'NgayBatDau'  => $_POST['bd'],
                    'NgayKetThuc' => $_POST['kt']
                ];
                $promoModel->create($data); // Gọi hàm create($data) của PromotionModel
                header("Location: index.php?action=voucher_list"); exit();
            }

            // 3. Xử lý CẬP NHẬT
            if (isset($_POST['edit_km'])) {
                $id = $_POST['makm'];
                $data = [
                    'TenKM'       => $_POST['ten'],
                    'Code'        => $_POST['code'],
                    'LoaiKM'      => $_POST['loai'],
                    'GiamGia'     => $_POST['giatri'],
                    'SoLuong'     => $_POST['sl'],
                    'NgayBatDau'  => $_POST['bd'],
                    'NgayKetThuc' => $_POST['kt'],
                    'TrangThai'   => 1 // Mặc định active khi sửa, hoặc lấy từ POST nếu có
                ];
                $promoModel->update($id, $data); // Gọi hàm update($id, $data)
                header("Location: index.php?action=voucher_list"); exit();
            }

            // 4. Xử lý XÓA
            if (isset($_GET['del_km'])) {
                $promoModel->delete($_GET['del_km']); // Gọi hàm delete($id)
                header("Location: index.php?action=voucher_list"); exit();
            }

            // 5. Lấy danh sách để hiển thị
            // Model của bạn dùng hàm getAll() thay vì listAll()
            $keyword = $_GET['keyword'] ?? null;
            $promotions = $promoModel->getAll($keyword);
            
            include 'views/admin/voucher_list.php';
        } else {
            echo "<h3 class='text-center mt-5 text-danger'>Lỗi: Không tìm thấy file models/PromotionModel.php</h3>";
        }
        break;

    // =============================================================
    // KHU VỰC USER - KHÁCH HÀNG (Trang chủ, Giỏ hàng...)
    // =============================================================
    case 'search':
        $keyword = $_POST['keyword'] ?? $_GET['keyword'] ?? '';
        $categories = $productModel->listCategories();
        $brands = $productModel->listAllNCC();
        $products = ($keyword != '') ? $productModel->search($keyword) : $productModel->listAll();
        include 'views/user/home.php';
        break;

    case 'detail':
        $id = $_GET['id'] ?? 0;
        $product = $productModel->getDetail($id);
        if (!$product) { header("Location: index.php"); exit(); }
        $related_products = $productModel->getRelated($product['MaDanhMuc'], $id);
        $categories = $productModel->listCategories();
        $brands = $productModel->listAllNCC();
        include 'views/user/product_detail.php';
        break;

    case 'add_to_cart':
        $id = $_GET['id'] ?? 0;
        $product = $productModel->getDetail($id); 
        if ($product) {
            if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];
            if (isset($_SESSION['cart'][$id])) {
                $_SESSION['cart'][$id]['qty'] += 1;
            } else {
                $_SESSION['cart'][$id] = [
                    'id' => $id, 'name' => $product['TenSP'], 'price' => $product['Gia'], 'img' => $product['HinhAnh'], 'qty' => 1
                ];
            }
        }
        header("Location: index.php?action=cart");
        break;

    case 'cart':
        $categories = $productModel->listCategories();
        $brands = $productModel->listAllNCC();
        include 'views/user/cart.php';
        break;

    case 'remove_cart':
        if (isset($_GET['id']) && isset($_SESSION['cart'][$_GET['id']])) unset($_SESSION['cart'][$_GET['id']]); 
        header("Location: index.php?action=cart");
        break;

    case 'update_cart':
        if (isset($_POST['qty']) && is_array($_POST['qty'])) {
            foreach ($_POST['qty'] as $id => $new_qty) {
                if (isset($_SESSION['cart'][$id])) {
                    $_SESSION['cart'][$id]['qty'] = max(0, (int)$new_qty);
                    if ($_SESSION['cart'][$id]['qty'] == 0) unset($_SESSION['cart'][$id]);
                }
            }
        }
        header("Location: index.php?action=cart");
        break;

    case 'checkout': $ctrl = new UserOrderController(); $ctrl->checkout(); break;
    case 'momoReturn': $ctrl = new UserOrderController(); $ctrl->momoReturn(); break;
    case 'check_code': $ctrl = new UserOrderController(); $ctrl->checkCode(); break;
    
    case 'history': 
        if (!isset($_SESSION['user'])) { header("Location: index.php"); exit(); }
        $ctrl = new UserOrderController(); 
        $ctrl->history(); 
        break;
        
    case 'order_detail': 
        $ctrl = new UserOrderController(); 
        $ctrl->orderDetail(); 
        break;

    case 'logout':
        session_destroy();
        header("Location: index.php");
        break;

    // =============================================================
    // MẶC ĐỊNH: TRANG CHỦ
    // =============================================================
    case 'home':
    default:
        $categories = $productModel->listCategories(); 
        $brands = $productModel->listAllNCC(); 
        $madm = $_GET['madm'] ?? ''; 
        $mancc = $_GET['mancc'] ?? ''; 
        if ($madm != '' && $mancc != '') $products = $productModel->listByFilter($madm, $mancc); 
        elseif ($madm != '') $products = $productModel->listByCategory($madm); 
        else $products = $productModel->listAll();
        include 'views/user/home.php';
        break;
}

// Hàm kiểm tra quyền Admin
function checkAdmin() {
    if (!isset($_SESSION['user']) || $_SESSION['user']['VaiTro'] != 'ADMIN') {
        header("Location: index.php?action=home");
        exit();
    }
}
?>