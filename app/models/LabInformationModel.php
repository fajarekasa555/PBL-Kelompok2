<?php
namespace App\Models;

use PDO;
use App\Config\Database;

class LabInformationModel {

    protected $conn;
    protected $table = 'lab_information';

    public function __construct() {
        $this->conn = (new Database())->connect();
    }

    public function getConnection() {
        return $this->conn;
    }

    /**
     * Ambil semua data informasi lab
     */
    public function all() {
        $query = "SELECT * FROM {$this->table} ORDER BY id ASC";
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Cari berdasarkan ID
     */
    public function find($id) {
        $query = "SELECT * FROM {$this->table} WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Ambil info berdasarkan KEY (lebih sering dipakai)
     */
    public function findByKey($key) {
        $query = "SELECT * FROM {$this->table} WHERE key = :key LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['key' => $key]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Jika tidak ditemukan, return null
     */
    public function findOrFail($id) {
        $data = $this->find($id);
        return $data ?: null;
    }

    /**
     * Create data baru
     */
    public function create($key, $value) {
        $query = "INSERT INTO {$this->table} (key, value)
                  VALUES (:key, :value)";

        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            'key'   => $key,
            'value' => $value
        ]);
    }

    /**
     * Update data (berdasarkan ID)
     */
    public function update($id, $key, $value) {
        $query = "UPDATE {$this->table}
                  SET key = :key,
                      value = :value,
                      updated_at = CURRENT_TIMESTAMP
                  WHERE id = :id";

        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            'key'   => $key,
            'value' => $value,
            'id'    => $id
        ]);
    }

    /**
     * Update berdasarkan KEY (opsional, sangat berguna)
     */
    public function updateByKey($key, $value) {
        $query = "UPDATE {$this->table}
                  SET value = :value,
                      updated_at = CURRENT_TIMESTAMP
                  WHERE key = :key";

        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            'key'   => $key,
            'value' => $value
        ]);
    }

    /**
     * Delete data berdasarkan ID
     */
    public function delete($id) {
        $query = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute(['id' => $id]);
    }

    /**
     * Delete berdasarkan KEY (opsional)
     */
    public function deleteByKey($key) {
        $query = "DELETE FROM {$this->table} WHERE key = :key";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute(['key' => $key]);
    }
}
