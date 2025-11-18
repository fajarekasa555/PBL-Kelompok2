<?php
namespace App\Models;

use PDO;
use App\Config\Database;

class ResearchFocusModel {

    protected $conn;
    protected $table = 'research_focuses';

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

    public function create($title, $field = null, $description = null) {
        $query = "INSERT INTO {$this->table} (title, field, description) 
                  VALUES (:title, :field, :description)";
        
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            'title' => $title,
            'field' => $field,
            'description' => $description
        ]);
    }

    public function update($id, $title, $field = null, $description = null) {
        $query = "UPDATE {$this->table} 
                  SET title = :title,
                      field = :field,
                      description = :description,
                      updated_at = CURRENT_TIMESTAMP
                  WHERE id = :id";

        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            'title' => $title,
            'field' => $field,
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
