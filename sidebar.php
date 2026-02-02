<style>
    /* CSS THANH MENU (SIDEBAR) */
    .sidebar {
        width: 250px;
        background: #263544;
        min-height: 100vh;
        position: fixed;
        top: 0;
        left: 0;
        z-index: 1000;
        color: #b7c0cd;
        font-family: 'Segoe UI', sans-serif;
        box-shadow: 2px 0 5px rgba(0,0,0,0.1);
        transition: all 0.3s;
    }

    .sidebar-header {
        background: #1e88e5;
        padding: 20px;
        text-align: center;
        color: white;
        font-weight: bold;
        font-size: 1.1rem;
        text-transform: uppercase;
        border-bottom: 1px solid rgba(255,255,255,0.1);
    }

    .sidebar ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .sidebar ul li {
        border-bottom: 1px solid rgba(255,255,255,0.05);
    }

    .sidebar ul li a {
        display: block;
        padding: 15px 20px;
        color: #b7c0cd;
        text-decoration: none;
        transition: all 0.3s;
        font-size: 0.95rem;
    }

    .sidebar ul li a:hover, 
    .sidebar ul li.active a {
        background: #1a252f;
        color: white;
        border-left: 4px solid #1e88e5;
        padding-left: 25px;
        background-color: #15202b;
    }

    .sidebar ul li a i {
        margin-right: 10px;
        width: 20px;
        text-align: center;
    }

    /* CSS ĐẨY NỘI DUNG SANG PHẢI */
    .main-content {
        margin-left: 250px;
        padding: 30px;
        background-color: #f4f6f9;
        min-height: 100vh;
    }
</style>

<div class="sidebar">
    <div class="sidebar-header">
        <i class="fas fa-shield-alt me-2"></i> ADMIN PANEL
    </div>
    
    <ul>
        <li class="<?= ($_GET['action'] == 'overview') ? 'active' : '' ?>">
            <a href="index.php?action=overview">
                <i class="fas fa-tachometer-alt"></i> Tổng quan hệ thống
            </a>
        </li>

        <li class="<?= ($_GET['action'] == 'product_list' || $_GET['action'] == 'admin') ? 'active' : '' ?>">
            <a href="index.php?action=product_list">
                <i class="fas fa-box"></i> Quản lý sản phẩm
            </a>
        </li>

        <li class="<?= ($_GET['action'] == 'category_list') ? 'active' : '' ?>">
            <a href="index.php?action=category_list">
                <i class="fas fa-list"></i> Quản lý danh mục
            </a>
        </li>

        <li class="<?= ($_GET['action'] == 'stock') ? 'active' : '' ?>">
            <a href="index.php?action=stock">
                <i class="fas fa-warehouse"></i> Quản lý kho
            </a>
        </li>

        <li class="<?= ($_GET['action'] == 'order_list' || $_GET['action'] == 'quanlydonhang') ? 'active' : '' ?>">
            <a href="index.php?action=order_list">
                <i class="fas fa-file-invoice-dollar"></i> Quản lý đơn hàng
            </a>
        </li>

        <li class="<?= ($_GET['action'] == 'voucher_list') ? 'active' : '' ?>">
            <a href="index.php?action=voucher_list">
                <i class="fas fa-tags"></i> Quản lý khuyến mãi
            </a>
        </li>

        <li class="<?= ($_GET['action'] == 'customer') ? 'active' : '' ?>">
            <a href="index.php?action=customer">
                <i class="fas fa-users"></i> Khách hàng
            </a>
        </li>

        <li class="<?= ($_GET['action'] == 'supplier') ? 'active' : '' ?>">
            <a href="index.php?action=supplier">
                <i class="fas fa-truck"></i> Nhà cung cấp
            </a>
        </li>

        <li class="<?= ($_GET['action'] == 'dashboard') ? 'active' : '' ?>">
            <a href="index.php?action=dashboard">
                <i class="fas fa-chart-line"></i> Báo cáo thống kê
            </a>
        </li>

        <li>
            <a href="index.php?action=logout" onclick="return confirm('Bạn có chắc muốn đăng xuất?');">
                <i class="fas fa-sign-out-alt"></i> Đăng xuất
            </a>
        </li>
    </ul>
</div>