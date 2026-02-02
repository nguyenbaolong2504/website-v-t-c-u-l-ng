<?php
class Supplier {
    private $db;

    public function __construct($db){
        $this->db = $db;
    }

    public function listAll(){
        return $this->db->query("SELECT * FROM nhacungcap ORDER BY MaNCC DESC");
    }
}
?>