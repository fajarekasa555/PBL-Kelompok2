<?php
namespace App\Models;

use PDO;
use App\Config\Database;

class FacilitiesModel {

    protected $conn;
    protected $table = 'facilities';

    public function __construct() {
        $this->conn = (new Database())->connect();
    }

    public function getConnection() {
        return $this->conn;
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

    public function create($slug, $description, $image = null) {
        $query = "INSERT INTO {$this->table} 
                    (slug, description, image) 
                  VALUES 
                    (:slug, :description, :image)";
        
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            'slug'        => $slug,
            'description' => $description,
            'image'       => $image
        ]);
    }

    public function update($id, $slug, $description, $image = null) {
        $query = "UPDATE {$this->table}
                  SET slug = :slug,
                      description = :description,
                      image = :image
                  WHERE id = :id";

        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            'slug'        => $slug,
            'description' => $description,
            'image'       => $image,
            'id'          => $id
        ]);
    }

    public function delete($id) {
        $query = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute(['id' => $id]);
    }
}
