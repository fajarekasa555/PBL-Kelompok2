<?php
namespace App\Models;

use PDO;
use App\Config\Database;

class LabCourseModel {

    protected $conn;
    protected $table = 'lab_courses';

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

    public function findOrFail($id) {
        $data = $this->find($id);
        return $data ?: null;
    }

    public function create($name, $description = null) {
        $query = "INSERT INTO {$this->table} (name, description) 
                  VALUES (:name, :description)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            'name' => $name,
            'description' => $description
        ]);
    }

    public function update($id, $name, $description = null) {
        $query = "UPDATE {$this->table} 
                  SET name = :name,
                      description = :description,
                      updated_at = CURRENT_TIMESTAMP
                  WHERE id = :id";

        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            'name' => $name,
            'description' => $description,
            'id' => $id
        ]);
    }

    public function delete($id) {
        $query = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute(['id' => $id]);
    }
}
