<?php
namespace App\Models;

use PDO;
use App\Config\Database;

class MemberStudentModel
{
    protected $conn;
    protected $table = 'member_student';
    protected $tableApproval = 'student_member_approval';

    public function __construct() {
        $this->conn = (new Database())->connect();
    }

    public function all() {
        $query = "SELECT * FROM {$this->table} ORDER BY id DESC";
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function pending() {
        $query = "SELECT * FROM {$this->table} WHERE status != 'approved' ORDER BY id DESC";
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function approved() {
        $query = "SELECT * FROM {$this->table} WHERE status = 'approved' ORDER BY id DESC";
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id)
    {
        $query = "
            SELECT ms.*, sma.note
            FROM {$this->table} ms
            LEFT JOIN student_member_approval sma ON sma.student_id = ms.id
            WHERE ms.id = :id
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

    public function create($data) {
        $query = "
            INSERT INTO {$this->table}
            (nim, name, program_studi, semester, ipk, cv_path, portfolio_path, motivation, email, phone)
            VALUES
            (:nim, :name, :program_studi, :semester, :ipk, :cv_path, :portfolio_path, :motivation, :email, :phone)
        ";

        $stmt = $this->conn->prepare($query);

        return $stmt->execute([
            'nim'            => $data['nim'],
            'name'           => $data['name'],
            'program_studi'  => $data['program_studi'],
            'semester'       => $data['semester'],
            'ipk'            => $data['ipk'],
            'cv_path'        => $data['cv_path'],
            'portfolio_path' => $data['portfolio_path'] ?? null,
            'motivation'     => $data['motivation'],
            'email'          => $data['email'],
            'phone'          => $data['phone']
        ]);
    }

    public function updateStatus($id, $status) {
        $query = "UPDATE {$this->table} SET status = :status, updated_at = NOW() WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            'status' => $status,
            'id'     => $id
        ]);
    }

    public function delete($id) {
        $query = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute(['id' => $id]);
    }

    public function approve($studentId, $approvedBy, $status, $note = null)
    {
        try {
            $this->conn->beginTransaction();

            $this->updateStatus($studentId, $status);

            $query = "
                INSERT INTO {$this->tableApproval}
                (student_id, approved_by, status, note)
                VALUES
                (:student_id, :approved_by, :status, :note)
            ";

            $stmt = $this->conn->prepare($query);

            $stmt->execute([
                'student_id' => $studentId,
                'approved_by' => $approvedBy,
                'status' => $status,
                'note' => $note
            ]);

            $this->conn->commit();
            return true;

        } catch (\Exception $e) {
            $this->conn->rollBack();
            throw $e;
        }
    }
}
