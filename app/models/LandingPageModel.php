<?php
namespace App\Models;

use PDO;
use App\Config\Database;

class LandingPageModel {
    protected $conn;

    public function __construct() {
        $this->conn = (new Database())->connect();
    }

    public function getLabInfo() {
        $query = "SELECT * FROM lab_information";
        $stmt = $this->conn->query($query);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $data = [];
        foreach ($rows as $row) {
            $data[$row['key']] = $row['value'];
        }

        return $data;
    }

    public function getVisions() {
        $query = "SELECT * FROM lab_vision ORDER BY id ASC";
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getMissions() {
        $query = "SELECT * FROM lab_missions WHERE is_active = TRUE ORDER BY order_number ASC";
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getRiset() {
        $query = "SELECT * FROM research_focuses ORDER BY id ASC";
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCourses() {
        $query = "SELECT * FROM lab_courses ORDER BY id ASC";
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getActivity() {
        $query = "SELECT * FROM activity_with_members ORDER BY id ASC";
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProjects() {
        $query = "SELECT * FROM project_with_members ORDER BY id ASC";
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getFacilities() {
        $query = "SELECT * FROM facilities ORDER BY id ASC";
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPublications() {
        $query = "
            SELECT p.*, m.name AS member_name 
            FROM publications p
            LEFT JOIN members m ON p.member_id = m.id
            ORDER BY p.id ASC
        ";
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getMembers() {
        $query = "SELECT * FROM members ORDER BY id ASC";
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMemberById($id) {
        $query = "SELECT * FROM v_member_full WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
