<?php
namespace App\Models;

use PDO;
use App\Config\Database;

class CertificationModel {

    protected $conn;
    protected $table = 'certifications';

    public function __construct() {
        $this->conn = (new Database())->connect();
    }

    public function all() {
        $query = "SELECT c.*, m.name AS member_name 
                  FROM {$this->table} c
                  LEFT JOIN members m ON c.member_id = m.id
                  ORDER BY c.issue_date DESC";
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
                  ORDER BY issue_date DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute(['member_id' => $member_id]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $query = "INSERT INTO {$this->table} 
            (member_id, title, issuer, issue_date, expiration_date, credential_id, credential_url)
            VALUES 
            (:member_id, :title, :issuer, :issue_date, :expiration_date, :credential_id, :credential_url)";

        $stmt = $this->conn->prepare($query);

        return $stmt->execute([
            'member_id' => $data['member_id'] ?? null,
            'title' => $data['title'] ?? null,
            'issuer' => $data['issuer'] ?? null,
            'issue_date' => $data['issue_date'] ?? null,
            'expiration_date' => $data['expiration_date'] ?? null,
            'credential_id' => $data['credential_id'] ?? null,
            'credential_url' => $data['credential_url'] ?? null,
        ]);
    }

    public function update($id, $data) {
        $query = "UPDATE {$this->table} SET 
            member_id = :member_id,
            title = :title,
            issuer = :issuer,
            issue_date = :issue_date,
            expiration_date = :expiration_date,
            credential_id = :credential_id,
            credential_url = :credential_url
            WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        return $stmt->execute([
            'id' => $id,
            'member_id' => $data['member_id'] ?? null,
            'title' => $data['title'] ?? null,
            'issuer' => $data['issuer'] ?? null,
            'issue_date' => $data['issue_date'] ?? null,
            'expiration_date' => $data['expiration_date'] ?? null,
            'credential_id' => $data['credential_id'] ?? null,
            'credential_url' => $data['credential_url'] ?? null,
        ]);
    }

    public function delete($id) {
        $query = "DELETE FROM {$this->table} WHERE id = :id";

        $stmt = $this->conn->prepare($query);
        return $stmt->execute(['id' => $id]);
    }
}
