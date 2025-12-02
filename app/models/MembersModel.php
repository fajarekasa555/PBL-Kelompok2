<?php
namespace App\Models;

use PDO;
use App\Config\Database;
use PDOException;

class MembersModel {

    protected $conn;
    protected $table = 'members';

    public function __construct() {
        $this->conn = (new Database())->connect();
    }

    public function all() {
        $query = "SELECT * FROM {$this->table} ORDER BY name ASC";
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id) {
        $query = "SELECT * FROM {$this->table} WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function findOrFail($id) {
        $data = $this->find($id);
        return $data ?: null;
    }

    public function create($data) {
        $query = "INSERT INTO {$this->table} 
            (nip, nidn, name, title_prefix, title_suffix, program_studi, jabatan, email, phone, address, photo) 
            VALUES 
            (:nip, :nidn, :name, :title_prefix, :title_suffix, :program_studi, :jabatan, :email, :phone, :address, :photo)
            RETURNING id";

        $stmt = $this->conn->prepare($query);
        $stmt->execute([
            'nip' => $data['nip'] ?? null,
            'nidn' => $data['nidn'] ?? null,
            'name' => $data['name'] ?? null,
            'title_prefix' => $data['title_prefix'] ?? null,
            'title_suffix' => $data['title_suffix'] ?? null,
            'program_studi' => $data['program_studi'] ?? null,
            'jabatan' => $data['jabatan'] ?? null,
            'email' => $data['email'] ?? null,
            'phone' => $data['phone'] ?? null,
            'address' => $data['address'] ?? null,
            'photo' => $data['photo'] ?? null,
        ]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row && isset($row['id'])) {
            return $row['id'];
        }

        return false;
    }

    public function createWithStoredProcedure($data)
    {
        try {
            $query = "
                SELECT sp_insert_member_full(
                    :nip,
                    :nidn,
                    :name,
                    :title_prefix,
                    :title_suffix,
                    :program_studi,
                    :jabatan,
                    :email,
                    :phone,
                    :address,
                    :photo,

                    :soc_platform,
                    :soc_icon,
                    :soc_url,

                    :degree,
                    :major,
                    :institution,
                    :start_year,
                    :end_year,

                    :course_name,
                    :semester,

                    :cert_title,
                    :cert_issuer,
                    :cert_issue_date,
                    :cert_exp_date,
                    :cred_id,
                    :cred_url
                ) AS id
            ";

            $stmt = $this->conn->prepare($query);

            $stmt->bindValue(':nip', $data['nip']);
            $stmt->bindValue(':nidn', $data['nidn']);
            $stmt->bindValue(':name', $data['name']);
            $stmt->bindValue(':title_prefix', $data['title_prefix']);
            $stmt->bindValue(':title_suffix', $data['title_suffix']);
            $stmt->bindValue(':program_studi', $data['program_studi']);
            $stmt->bindValue(':jabatan', $data['jabatan']);
            $stmt->bindValue(':email', $data['email']);
            $stmt->bindValue(':phone', $data['phone']);
            $stmt->bindValue(':address', $data['address']);
            $stmt->bindValue(':photo', $data['photo']);

            $stmt->bindValue(':soc_platform', $this->toPgArray($data['soc_platform'] ?? []));
            $stmt->bindValue(':soc_icon', $this->toPgArray($data['soc_icon'] ?? []));
            $stmt->bindValue(':soc_url', $this->toPgArray($data['soc_url'] ?? []));

            $stmt->bindValue(':degree', $this->toPgArray($data['degree'] ?? []));
            $stmt->bindValue(':major', $this->toPgArray($data['major'] ?? []));
            $stmt->bindValue(':institution', $this->toPgArray($data['institution'] ?? []));
            $stmt->bindValue(':start_year', $this->toPgArray($data['start_year'] ?? [], 'int'));
            $stmt->bindValue(':end_year', $this->toPgArray($data['end_year'] ?? [], 'int'));

            $stmt->bindValue(':course_name', $this->toPgArray($data['course_name'] ?? []));
            $stmt->bindValue(':semester', $this->toPgArray($data['semester'] ?? []));
            $stmt->bindValue(':cert_title', $this->toPgArray($data['cert_title'] ?? []));
            $stmt->bindValue(':cert_issuer', $this->toPgArray($data['cert_issuer'] ?? []));
            $stmt->bindValue(':cert_issue_date', $this->toPgArray($data['cert_issue_date'] ?? [], 'date'));
            $stmt->bindValue(':cert_exp_date', $this->toPgArray($data['cert_exp_date'] ?? [], 'date'));
            $stmt->bindValue(':cred_id', $this->toPgArray($data['cred_id'] ?? []));
            $stmt->bindValue(':cred_url', $this->toPgArray($data['cred_url'] ?? []));

            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['id'] ?? false;

        } catch (PDOException $e) {
            error_log("SP ERROR: " . $e->getMessage());
            return false;
        }
    }

    public function update($id, $data) {
        $query = "UPDATE {$this->table} SET 
            nip = :nip,
            nidn = :nidn,
            name = :name,
            title_prefix = :title_prefix,
            title_suffix = :title_suffix,
            program_studi = :program_studi,
            jabatan = :jabatan,
            email = :email,
            phone = :phone,
            address = :address,
            photo = :photo,
            updated_at = CURRENT_TIMESTAMP
            WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $data['id'] = $id;
        return $stmt->execute([
            'id' => $data['id'],
            'nip' => $data['nip'] ?? null,
            'nidn' => $data['nidn'] ?? null,
            'name' => $data['name'] ?? null,
            'title_prefix' => $data['title_prefix'] ?? null,
            'title_suffix' => $data['title_suffix'] ?? null,
            'program_studi' => $data['program_studi'] ?? null,
            'jabatan' => $data['jabatan'] ?? null,
            'email' => $data['email'] ?? null,
            'phone' => $data['phone'] ?? null,
            'address' => $data['address'] ?? null,
            'photo' => $data['photo'] ?? null,
        ]);
    }

    public function updateWithStoredProcedure($memberId, $data)
    {
        try {
            $sql = "
                SELECT sp_update_member_full(
                    :member_id,
                    :nip,
                    :nidn,
                    :name,
                    :title_prefix,
                    :title_suffix,
                    :program_studi,
                    :jabatan,
                    :email,
                    :phone,
                    :address,
                    :photo,

                    :soc_platform,
                    :soc_icon,
                    :soc_url,

                    :degree,
                    :major,
                    :institution,
                    :start_year,
                    :end_year,

                    :course_name,
                    :semester,

                    :cert_title,
                    :cert_issuer,
                    :cert_issue_date,
                    :cert_exp_date,
                    :cred_id,
                    :cred_url
                );
            ";

            $stmt = $this->conn->prepare($sql);

            $stmt->bindValue(':member_id', $memberId, PDO::PARAM_INT);
            $stmt->bindValue(':nip', $data['nip']);
            $stmt->bindValue(':nidn', $data['nidn']);
            $stmt->bindValue(':name', $data['name']);
            $stmt->bindValue(':title_prefix', $data['title_prefix']);
            $stmt->bindValue(':title_suffix', $data['title_suffix']);
            $stmt->bindValue(':program_studi', $data['program_studi']);
            $stmt->bindValue(':jabatan', $data['jabatan']);
            $stmt->bindValue(':email', $data['email']);
            $stmt->bindValue(':phone', $data['phone']);
            $stmt->bindValue(':address', $data['address']);
            $stmt->bindValue(':photo', $data['photo']);

            $stmt->bindValue(':soc_platform', $this->toPgArray($data['soc_platform'] ?? []));
            $stmt->bindValue(':soc_icon',     $this->toPgArray($data['soc_icon'] ?? []));
            $stmt->bindValue(':soc_url',      $this->toPgArray($data['soc_url'] ?? []));

            $stmt->bindValue(':degree',      $this->toPgArray($data['degree'] ?? []));
            $stmt->bindValue(':major',       $this->toPgArray($data['major'] ?? []));
            $stmt->bindValue(':institution', $this->toPgArray($data['institution'] ?? []));
            $stmt->bindValue(':start_year',  $this->toPgArray($data['start_year'] ?? [], 'int'));
            $stmt->bindValue(':end_year',    $this->toPgArray($data['end_year'] ?? [], 'int'));

            $stmt->bindValue(':course_name', $this->toPgArray($data['course_name'] ?? []));
            $stmt->bindValue(':semester',    $this->toPgArray($data['semester'] ?? []));

            $stmt->bindValue(':cert_title',      $this->toPgArray($data['cert_title'] ?? []));
            $stmt->bindValue(':cert_issuer',     $this->toPgArray($data['cert_issuer'] ?? []));
            $stmt->bindValue(':cert_issue_date', $this->toPgArray($data['cert_issue_date'] ?? [], 'date'));
            $stmt->bindValue(':cert_exp_date',   $this->toPgArray($data['cert_exp_date'] ?? [], 'date'));
            $stmt->bindValue(':cred_id',         $this->toPgArray($data['cred_id'] ?? []));
            $stmt->bindValue(':cred_url',        $this->toPgArray($data['cred_url'] ?? []));

            $stmt->execute();

            return true;

        } catch (\PDOException $e) {
            echo "<pre>SP ERROR:\n" . $e->getMessage() . "</pre>";
            return false;
        }
    }

    public function delete($id) {
        $query = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute(['id' => $id]);
    }

    private function toPgArray($phpArray)
    {
        if (empty($phpArray)) {
            return null;
        }

        $converted = array_map(function ($item) {

            if (is_null($item)) {
                return 'NULL';
            }

            if (is_int($item)) {
                return $item;
            }

            $escaped = str_replace('"', '\"', (string)$item);

            return '"' . $escaped . '"';
        }, $phpArray);

        return '{' . implode(',', $converted) . '}';
    }

    public function getSocialMedia($memberId)
    {
        $sql = "SELECT id, platform, icon, url 
                FROM social_media 
                WHERE member_id = :id
                ORDER BY id ASC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $memberId]);
        return $stmt->fetchAll();
    }

    public function getEducations($memberId)
    {
        $sql = "SELECT id, degree, major, institution, start_year, end_year
                FROM educations
                WHERE member_id = :id
                ORDER BY start_year ASC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $memberId]);
        return $stmt->fetchAll();
    }

    public function getCourses($memberId)
    {
        $sql = "SELECT id, course_name, semester
                FROM courses
                WHERE member_id = :id
                ORDER BY course_name ASC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $memberId]);
        return $stmt->fetchAll();
    }

    public function getCertifications($memberId)
    {
        $sql = "SELECT 
                    id, 
                    title,
                    issuer,
                    issue_date,
                    expiration_date,
                    credential_id,
                    credential_url
                FROM certifications
                WHERE member_id = :id
                ORDER BY issue_date DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $memberId]);
        return $stmt->fetchAll();
    }
}
