<?php
namespace App\Models;

use PDO;
use App\Config\Database;

class UserModel {

    protected $conn;
    protected $table = 'users';

    public function __construct() {
        $this->conn = (new Database())->connect();
    }

    public function checkLogin($username, $password) {
        $query = "
            SELECT u.*, r.name AS role_name
            FROM {$this->table} u
            JOIN roles r ON r.id = u.role_id
            WHERE u.username = :username
              AND u.password = crypt(:password, u.password)
            LIMIT 1
        ";

        $stmt = $this->conn->prepare($query);
        $stmt->execute([
            'username' => $username,
            'password' => $password
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function all() {
        $query = "SELECT u.*, r.name AS role_name
                  FROM {$this->table} u
                  LEFT JOIN roles r ON r.id = u.role_id
                  ORDER BY u.id DESC";

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
        if (!$data) {
            die("Data tidak ditemukan");
        }
        return $data;
    }

    public function create($data) {
        $role_id = ($data['role_id'] === '' || $data['role_id'] === null)
            ? null
            : (int)$data['role_id'];

        $query = "INSERT INTO {$this->table} (username, password, role_id)
                VALUES (:username, crypt(:password, gen_salt('bf')), :role_id)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(':username', $data['username'], \PDO::PARAM_STR);
        $stmt->bindValue(':password', $data['password'], \PDO::PARAM_STR);

        if ($role_id === null) {
            $stmt->bindValue(':role_id', null, \PDO::PARAM_NULL);
        } else {
            $stmt->bindValue(':role_id', $role_id, \PDO::PARAM_INT);
        }

        return $stmt->execute();
    }

    public function update($id, $data) {
        if (!empty($data['password'])) {
            $query = "UPDATE {$this->table}
                      SET 
                          username = :username,
                          password = crypt(:password, gen_salt('bf')),
                          role_id = :role_id
                      WHERE id = :id";
        } else {
            $query = "UPDATE {$this->table}
                      SET 
                          username = :username,
                          role_id = :role_id
                      WHERE id = :id";
        }

        $stmt = $this->conn->prepare($query);

        $params = [
            'username' => $data['username'],
            'role_id' => $data['role_id'],
            'id' => $id
        ];

        if (!empty($data['password'])) {
            $params['password'] = $data['password'];
        }

        return $stmt->execute($params);
    }

    public function delete($id) {
        $query = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute(['id' => $id]);
    }
}
