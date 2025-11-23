<?php
namespace App\Models;

use PDO;
use App\Config\Database;

class LandingPageModel {
    protected $conn;

    public function __construct() {
        $this->conn = (new Database())->connect();
    }

    public function getVisions() {
        $query = "SELECT * FROM lab_vision ORDER BY id ASC";
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getMissions() {
        $query = "SELECT * FROM lab_missions WHERE is_active = TRUE ORDER BY order_number ASC";
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
