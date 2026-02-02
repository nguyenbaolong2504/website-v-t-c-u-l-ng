<?php
require_once 'models/Supplier.php';

class SupplierController {
    public function index(){
        $database = new Database();
        $db = $database->getConnection();
        $supplierModel = new Supplier($db);
        $suppliers = $supplierModel->listAll();
        include 'views/admin/supplier_list.php';
    }
}
?>