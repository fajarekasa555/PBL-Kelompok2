<?php
namespace App\Requests;

class RoleRequest
{
    public static function validate(array $data)
    {
        $errors = [];

        if (!isset($data['name']) || trim($data['name']) === '') {
            $errors['name'] = 'Nama role wajib diisi.';
        } else {
            if (strlen($data['name']) < 3) {
                $errors['name'] = 'Nama role minimal 3 karakter.';
            }

            if (strlen($data['name']) > 100) {
                $errors['name'] = 'Nama role maksimal 100 karakter.';
            }
        }

        return $errors;
    }
}
