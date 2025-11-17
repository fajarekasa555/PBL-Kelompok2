<?php
namespace App\Models;

use PDO;
use App\Config\Database;

class MemberExpertisesModel
{
    protected $conn;
    protected $table = 'member_expertises';

    public function __construct()
    {
        $this->conn = (new Database())->connect();
    }

    public function getByMember($memberId)
    {
        $query = "SELECT expertise_id FROM {$this->table} WHERE member_id = :member_id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['member_id' => $memberId]);

        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    public function getExpertisesByMember($memberId)
    {
        $query = "SELECT e.* FROM expertises e
                  JOIN {$this->table} me ON e.id = me.expertise_id
                  WHERE me.member_id = :member_id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['member_id' => $memberId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertMany($memberId, $expertiseIds = [])
    {
        if (empty($expertiseIds)) return;

        $query = "INSERT INTO {$this->table} (member_id, expertise_id)
                  VALUES (:member_id, :expertise_id)";
        $stmt = $this->conn->prepare($query);

        foreach ($expertiseIds as $expId) {
            $stmt->execute([
                'member_id' => $memberId,
                'expertise_id' => $expId
            ]);
        }
    }

    public function deleteByMember($memberId)
    {
        $query = "DELETE FROM {$this->table} WHERE member_id = :member_id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute(['member_id' => $memberId]);
    }
}
