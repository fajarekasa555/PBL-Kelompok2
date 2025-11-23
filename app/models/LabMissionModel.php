<?php
namespace App\Models;

use PDO;
use App\Config\Database;

class LabMissionModel {

    protected $conn;
    protected $table = 'lab_missions';

    public function __construct() {
        $this->conn = (new Database())->connect();
    }

    // Get all active missions (sorted)
    public function allActive() {
        $query = "SELECT * FROM {$this->table} 
                  WHERE is_active = TRUE
                  ORDER BY order_number ASC";
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get all missions including inactive
    public function all() {
        $query = "SELECT * FROM {$this->table} ORDER BY order_number ASC";
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Find by ID
    public function find($id) {
        $query = "SELECT * FROM {$this->table} WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Create new mission
    public function create($data) {
        $query = "INSERT INTO {$this->table} (mission, order_number, is_active) 
                  VALUES (:mission, :order_number, :is_active)";

        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            'mission'      => $data['mission'] ?? null,
            'order_number' => $data['order_number'] ?? 1,
            'is_active'    => $data['is_active'] ?? true,
        ]);
    }

    // Update mission
    public function update($id, $data) {
        $query = "UPDATE {$this->table} SET 
            mission = :mission,
            order_number = :order_number,
            is_active = :is_active,
            updated_at = CURRENT_TIMESTAMP
            WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        return $stmt->execute([
            'id'           => $id,
            'mission'      => $data['mission'] ?? null,
            'order_number' => $data['order_number'] ?? 1,
            'is_active'    => $data['is_active'] ?? true,
        ]);
    }

    // Soft delete mission
    public function softDelete($id) {
        $query = "UPDATE {$this->table} 
                  SET is_active = FALSE, updated_at = CURRENT_TIMESTAMP
                  WHERE id = :id";

        $stmt = $this->conn->prepare($query);
        return $stmt->execute(['id' => $id]);
    }

    // Restore mission
    public function restore($id) {
        $query = "UPDATE {$this->table} 
                  SET is_active = TRUE, updated_at = CURRENT_TIMESTAMP
                  WHERE id = :id";
                  
        $stmt = $this->conn->prepare($query);
        return $stmt->execute(['id' => $id]);
    }

    // Hard delete
    public function delete($id) {
        $query = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute(['id' => $id]);
    }
}
