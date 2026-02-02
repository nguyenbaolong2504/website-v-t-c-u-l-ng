<?php
require_once "models/Product.php";

class StockController {
    private $model;

    public function __construct($db){
        $this->model = new Product($db);
    }

    public function index(){
        $products = $this->model->listAll();
        include "views/admin/stock_list.php";
    }

    public function update(){
        if(isset($_POST['id']) && isset($_POST['qty'])){
            $id = $_POST['id'];
            $qty = (int)$_POST['qty'];
            $this->model->updateStock($id, $qty);
        }
        header("Location: index.php?action=stock");
    }
}
?>