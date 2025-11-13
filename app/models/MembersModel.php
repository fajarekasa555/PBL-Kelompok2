<?php
namespace App\Models;

use PDO;
use App\Config\Database;

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
            (:nip, :nidn, :name, :title_prefix, :title_suffix, :program_studi, :jabatan, :email, :phone, :address, :photo)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
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

    public function delete($id) {
        $query = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute(['id' => $id]);
    }
}
