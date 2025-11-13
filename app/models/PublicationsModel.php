<?php
namespace App\Models;

use PDO;
use App\Config\Database;

class PublicationsModel {

    protected $conn;
    protected $table = 'publications';

    public function __construct() {
        $this->conn = (new Database())->connect();
    }

    public function all() {
        $query = "
            SELECT p.*, m.name AS member_name 
            FROM {$this->table} p
            LEFT JOIN members m ON p.member_id = m.id
            ORDER BY p.id ASC
        ";
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id) {
        $query = "
            SELECT p.*, m.name AS member_name 
            FROM {$this->table} p
            LEFT JOIN members m ON p.member_id = m.id
            WHERE p.id = :id
            LIMIT 1
        ";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function findOrFail($id) {
        $data = $this->find($id);
        return $data ?: null;
    }

    public function create($member_id, $title, $date, $link) {
        $query = "
            INSERT INTO {$this->table} (member_id, title, date, link) 
            VALUES (:member_id, :title, :date, :link)
        ";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            'member_id' => $member_id,
            'title' => $title,
            'date' => $date,
            'link' => $link
        ]);
    }

    public function update($id, $member_id, $title, $date, $link) {
        $query = "
            UPDATE {$this->table}
            SET member_id = :member_id,
                title = :title,
                date = :date,
                link = :link
            WHERE id = :id
        ";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            'id' => $id,
            'member_id' => $member_id,
            'title' => $title,
            'date' => $date,
            'link' => $link
        ]);
    }

    public function delete($id) {
        $query = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute(['id' => $id]);
    }
}
