<?php
namespace App\Models;

use PDO;
use App\Config\Database;

class EducationModel {

    protected $conn;
    protected $table = 'educations';

    public function __construct() {
        $this->conn = (new Database())->connect();
    }

    public function all() {
        $query = "SELECT e.*, m.name AS member_name 
                  FROM {$this->table} e
                  LEFT JOIN members m ON e.member_id = m.id
                  ORDER BY e.end_year DESC";
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id) {
        $query = "SELECT * FROM {$this->table} WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function findByMember($member_id) {
        $query = "SELECT * FROM {$this->table} WHERE member_id = :member_id ORDER BY start_year DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['member_id' => $member_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $query = "INSERT INTO {$this->table} 
            (member_id, degree, major, institution, start_year, end_year) 
            VALUES 
            (:member_id, :degree, :major, :institution, :start_year, :end_year)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            'member_id' => $data['member_id'] ?? null,
            'degree' => $data['degree'] ?? null,
            'major' => $data['major'] ?? null,
            'institution' => $data['institution'] ?? null,
            'start_year' => $data['start_year'] ?? null,
            'end_year' => $data['end_year'] ?? null,
        ]);
    }

    public function update($id, $data) {
        $query = "UPDATE {$this->table} SET 
            member_id = :member_id,
            degree = :degree,
            major = :major,
            institution = :institution,
            start_year = :start_year,
            end_year = :end_year
            WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            'id' => $id,
            'member_id' => $data['member_id'] ?? null,
            'degree' => $data['degree'] ?? null,
            'major' => $data['major'] ?? null,
            'institution' => $data['institution'] ?? null,
            'start_year' => $data['start_year'] ?? null,
            'end_year' => $data['end_year'] ?? null,
        ]);
    }

    public function delete($id) {
        $query = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute(['id' => $id]);
    }
}
