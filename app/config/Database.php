<?php
class Database {
    private $host = "localhost";
    private $port = "5432";
    private $db = "profile_dt";
    private $user = "postgres";
    private $pass = "";
    public $conn;

    public function connect() {
        try {
            $this->conn = new PDO("pgsql:host=$this->host;port=$this->port;dbname=$this->db", $this->user, $this->pass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->conn;
        } catch (PDOException $e) {
            echo "Database connection failed: " . $e->getMessage();
            exit;
        }
    }
}
