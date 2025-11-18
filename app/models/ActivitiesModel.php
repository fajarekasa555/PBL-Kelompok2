<?php
namespace App\Models;

use PDO;
use App\Config\Database;

class ActivitiesModel {

    protected $conn;
    protected $table = 'activities';

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

    public function create($title, $description = null, $location = null, $date = null, $documentation = null) {
        $query = "INSERT INTO {$this->table} 
                    (title, description, location, date, documentation) 
                  VALUES 
                    (:title, :description, :location, :date, :documentation)";
        
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            'title'         => $title,
            'description'   => $description,
            'location'      => $location,
            'date'          => $date,
            'documentation' => $documentation
        ]);
    }

    public function update($id, $title, $description = null, $location = null, $date = null, $documentation = null) {
        $query = "UPDATE {$this->table}
                  SET title = :title,
                      description = :description,
                      location = :location,
                      date = :date,
                      documentation = :documentation,
                      updated_at = CURRENT_TIMESTAMP
                  WHERE id = :id";

        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            'title'         => $title,
            'description'   => $description,
            'location'      => $location,
            'date'          => $date,
            'documentation' => $documentation,
            'id'            => $id
        ]);
    }

    public function delete($id) {
        $query = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute(['id' => $id]);
    }
}
