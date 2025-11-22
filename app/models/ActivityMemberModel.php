<?php
namespace App\Models;

use PDO;
use App\Config\Database;

class ActivityMemberModel
{
    protected $conn;
    protected $table = 'activity_members';

    public function __construct()
    {
        $this->conn = (new Database())->connect();
    }

    public function getConnection() {
        return $this->conn;
    }

    /**
     * Ambil semua member berdasarkan activity_id
     */
    public function getMembersByActivity($activityId)
    {
        $query = "SELECT member_id, role 
                  FROM {$this->table}
                  WHERE activity_id = :activity_id";

        $stmt = $this->conn->prepare($query);
        $stmt->execute(['activity_id' => $activityId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Ambil detail join member + role (jika butuh info member lengkap)
     */
    public function getDetailedMembersByActivity($activityId)
    {
        $query = "SELECT m.*, am.role 
                  FROM members m
                  JOIN {$this->table} am ON m.id = am.member_id
                  WHERE am.activity_id = :activity_id";

        $stmt = $this->conn->prepare($query);
        $stmt->execute(['activity_id' => $activityId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Insert banyak member ke activity
     * Format $members = [ ['id'=>1,'role'=>'leader'], ['id'=>2,'role'=>'staff'], ... ]
     */
    public function insertMany($activityId, $members = [])
    {
        if (empty($members)) return;

        $query = "INSERT INTO {$this->table} (activity_id, member_id, role)
                  VALUES (:activity_id, :member_id, :role)";

        $stmt = $this->conn->prepare($query);

        foreach ($members as $m) {
            $stmt->execute([
                'activity_id' => $activityId,
                'member_id' => $m,
                'role'       => $m['role'] ?? null
            ]);
        }
    }

    /**
     * Hapus semua member pada activity tertentu
     */
    public function deleteByActivity($activityId)
    {
        $query = "DELETE FROM {$this->table} WHERE activity_id = :activity_id";

        $stmt = $this->conn->prepare($query);
        return $stmt->execute(['activity_id' => $activityId]);
    }

    /**
     * Hapus 1 member dari 1 activity
     */
    public function deleteOne($activityId, $memberId)
    {
        $query = "DELETE FROM {$this->table}
                  WHERE activity_id = :activity_id 
                  AND member_id = :member_id";

        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            'activity_id' => $activityId,
            'member_id'   => $memberId
        ]);
    }
}
