<?php
namespace App\Models;

use PDO;
use App\Config\Database;

class SocialMediaModel {

    protected $conn;
    protected $table = 'social_media';

    public function __construct() {
        $this->conn = (new Database())->connect();
    }

    public function all() {
        $query = "
            SELECT sm.*, m.name AS member_name 
            FROM {$this->table} sm
            LEFT JOIN members m ON sm.member_id = m.id
            ORDER BY sm.id ASC
        ";
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id) {
        $query = "
            SELECT sm.*, m.name AS member_name 
            FROM {$this->table} sm
            LEFT JOIN members m ON sm.member_id = m.id
            WHERE sm.id = :id
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

    public function create($member_id, $platform, $icon, $url) {
        $query = "
            INSERT INTO {$this->table} (member_id, platform, icon, url) 
            VALUES (:member_id, :platform, :icon, :url)
        ";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            'member_id' => $member_id,
            'platform' => $platform,
            'icon' => $icon,
            'url' => $url
        ]);
    }

    public function update($id, $member_id, $platform, $icon, $url) {
        $query = "
            UPDATE {$this->table}
            SET member_id = :member_id,
                platform = :platform,
                icon = :icon,
                url = :url
            WHERE id = :id
        ";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            'id' => $id,
            'member_id' => $member_id,
            'platform' => $platform,
            'icon' => $icon,
            'url' => $url
        ]);
    }

    public function delete($id) {
        $query = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute(['id' => $id]);
    }
}
