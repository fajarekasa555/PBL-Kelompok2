<?php
namespace App\Models;

use PDO;
use App\Config\Database;

class ProjectsMemberModel
{
    protected $conn;
    protected $table = 'project_members';

    public function __construct()
    {
        $this->conn = (new Database())->connect();
    }

    public function getConnection() {
        return $this->conn;
    }

    /**
     * Ambil semua member berdasarkan project_id
     */
    public function getMembersByProject($projectId)
    {
        $query = "SELECT member_id, role
                  FROM {$this->table}
                  WHERE project_id = :project_id";

        $stmt = $this->conn->prepare($query);
        $stmt->execute(['project_id' => $projectId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Ambil detail join ke tabel members
     */
    public function getDetailedMembersByProject($projectId)
    {
        $query = "SELECT m.*, pm.role
                  FROM members m
                  JOIN {$this->table} pm ON m.id = pm.member_id
                  WHERE pm.project_id = :project_id";

        $stmt = $this->conn->prepare($query);
        $stmt->execute(['project_id' => $projectId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Insert banyak member ke project
     * Format $members = [
     *   ['id'=>1, 'role'=>'Manager'],
     *   ['id'=>2, 'role'=>'Developer']
     * ]
     */
    public function insertMany($projectId, $members = [])
    {
        if (empty($members)) return;

        $query = "INSERT INTO {$this->table} (project_id, member_id, role)
                  VALUES (:project_id, :member_id, :role)";

        $stmt = $this->conn->prepare($query);

        foreach ($members as $m) {
            $stmt->execute([
                'project_id' => $projectId,
                'member_id'  => $m,
                'role'       => $m['role'] ?? null
            ]);
        }
    }

    /**
     * Hapus semua member pada project tertentu
     */
    public function deleteByProject($projectId)
    {
        $query = "DELETE FROM {$this->table} WHERE project_id = :project_id";

        $stmt = $this->conn->prepare($query);
        return $stmt->execute(['project_id' => $projectId]);
    }

    /**
     * Hapus satu member dari suatu project
     */
    public function deleteOne($projectId, $memberId)
    {
        $query = "DELETE FROM {$this->table}
                  WHERE project_id = :project_id
                  AND member_id = :member_id";

        $stmt = $this->conn->prepare($query);

        return $stmt->execute([
            'project_id' => $projectId,
            'member_id'  => $memberId
        ]);
    }
}
