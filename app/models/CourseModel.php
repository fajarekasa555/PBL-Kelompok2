<?php
namespace App\Models;

use PDO;
use App\Config\Database;

class CourseModel {

    protected $conn;
    protected $table = 'courses';

    public function __construct() {
        $this->conn = (new Database())->connect();
    }

    public function all() {
        $query = "SELECT c.*, m.name AS member_name 
                  FROM {$this->table} c
                  LEFT JOIN members m ON c.member_id = m.id
                  ORDER BY c.semester ASC, c.course_name ASC";

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
        $query = "SELECT * FROM {$this->table} 
                  WHERE member_id = :member_id 
                  ORDER BY semester ASC, course_name ASC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute(['member_id' => $member_id]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $query = "INSERT INTO {$this->table} 
            (member_id, semester, course_name)
            VALUES 
            (:member_id, :semester, :course_name)";

        $stmt = $this->conn->prepare($query);

        return $stmt->execute([
            'member_id' => $data['member_id'] ?? null,
            'semester' => $data['semester'] ?? null,
            'course_name' => $data['course_name'] ?? null,
        ]);
    }

    public function update($id, $data) {
        $query = "UPDATE {$this->table} SET 
            member_id = :member_id,
            semester = :semester,
            course_name = :course_name
            WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        return $stmt->execute([
            'id' => $id,
            'member_id' => $data['member_id'] ?? null,
            'semester' => $data['semester'] ?? null,
            'course_name' => $data['course_name'] ?? null,
        ]);
    }

    public function delete($id) {
        $query = "DELETE FROM {$this->table} WHERE id = :id";

        $stmt = $this->conn->prepare($query);
        return $stmt->execute(['id' => $id]);
    }
}
