<?php

namespace App\Requests;

class ExpertiseRequest
{
    public static function validate(array $data)
    {
        $errors = [];

        if (!isset($data['name']) || trim($data['name']) === '') {
            $errors['name'] = 'Nama keahlian wajib diisi.';
        } else {
            if (strlen($data['name']) < 3) {
                $errors['name'] = 'Nama keahlian minimal 3 karakter.';
            }

            if (strlen($data['name']) > 100) {
                $errors['name'] = 'Nama keahlian maksimal 100 karakter.';
            }
        }

        return $errors;
    }
}
