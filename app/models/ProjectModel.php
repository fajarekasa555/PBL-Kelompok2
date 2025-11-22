<?php
namespace App\Models;

use PDO;
use App\Config\Database;

class ProjectModel {

    protected $conn;
    protected $table = 'projects';

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

    public function create(
        $name,
        $description = null,
        $start_date = null,
        $end_date = null,
        $sponsor = null,
        $documentation = null
    ) {
        $query = "INSERT INTO {$this->table} 
                    (name, description, start_date, end_date, sponsor, documentation)
                  VALUES 
                    (:name, :description, :start_date, :end_date, :sponsor, :documentation)";

        $stmt = $this->conn->prepare($query);

        return $stmt->execute([
            'name'          => $name,
            'description'   => $description,
            'start_date'    => $start_date,
            'end_date'      => $end_date,
            'sponsor'       => $sponsor,
            'documentation' => $documentation
        ]);
    }

    public function update(
        $id,
        $name,
        $description = null,
        $start_date = null,
        $end_date = null,
        $sponsor = null,
        $documentation = null
    ) {
        $query = "UPDATE {$this->table}
                  SET name = :name,
                      description = :description,
                      start_date = :start_date,
                      end_date = :end_date,
                      sponsor = :sponsor,
                      documentation = :documentation,
                      updated_at = CURRENT_TIMESTAMP
                  WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        return $stmt->execute([
            'id'            => $id,
            'name'          => $name,
            'description'   => $description,
            'start_date'    => $start_date,
            'end_date'      => $end_date,
            'sponsor'       => $sponsor,
            'documentation' => $documentation
        ]);
    }

    public function delete($id) {
        $query = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute(['id' => $id]);
    }
}
