<?php
namespace App\Requests;

class UserRequest
{
    public static function validate(array $data)
    {
        $errors = [];

        if (!isset($data['username']) || trim($data['username']) === '') {
            $errors['username'] = 'Username wajib diisi.';
        } else {
            $username = trim($data['username']);

            if (strlen($username) < 3) {
                $errors['username'] = 'Username minimal 3 karakter.';
            }

            if (strlen($username) > 50) {
                $errors['username'] = 'Username maksimal 50 karakter.';
            }
        }

        if (!isset($data['id'])) {
            if (!isset($data['password']) || trim($data['password']) === '') {
                $errors['password'] = 'Password wajib diisi.';
            } else {
                if (strlen($data['password']) < 6) {
                    $errors['password'] = 'Password minimal 6 karakter.';
                }

                if (strlen($data['password']) > 255) {
                    $errors['password'] = 'Password terlalu panjang.';
                }
            }
        }

        if (isset($data['role_id']) && trim($data['role_id']) !== '') {
            if (!ctype_digit((string)$data['role_id'])) {
                $errors['role_id'] = 'Role ID harus berupa angka.';
            }
        }

        return $errors;
    }
}
