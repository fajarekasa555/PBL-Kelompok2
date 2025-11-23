<?php
namespace App\Models;

use PDO;
use App\Config\Database;

class LabVisionModel {

    protected $conn;
    protected $table = 'lab_vision';

    public function __construct() {
        $this->conn = (new Database())->connect();
    }

    public function all() {
        $query = "SELECT * FROM {$this->table} ORDER BY id ASC";
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id) {
        $query = "SELECT * FROM {$this->table} WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $query = "INSERT INTO {$this->table} (vision) VALUES (:vision)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            'vision' => $data ?? null,
        ]);
    }

    public function update($id, $data) {
        $query = "UPDATE {$this->table} SET 
            vision = :vision,
            updated_at = CURRENT_TIMESTAMP
            WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        return $stmt->execute([
            'id' => $id,
            'vision' => $data ?? null,
        ]);
    }

    public function delete($id) {
        $query = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute(['id' => $id]);
    }
}
