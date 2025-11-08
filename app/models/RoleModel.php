<?php
namespace App\Models;

use PDO;
use App\Config\Database;

class RoleModel {

    protected $conn;
    protected $table = 'roles';

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

    public function create($name) {
        $query = "INSERT INTO {$this->table} (name) VALUES (:name)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute(['name' => $name]);
    }

    public function update($id, $name) {
        $query = "UPDATE {$this->table} SET name = :name WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            'name' => $name,
            'id' => $id
        ]);
    }

    public function delete($id) {
        $query = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute(['id' => $id]);
    }
}
