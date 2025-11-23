<?php
namespace App\Models;

use PDO;
use App\Config\Database;

class LandingPageModel {
    protected $conn;

    public function __construct() {
        $this->conn = (new Database())->connect();
    }
}
