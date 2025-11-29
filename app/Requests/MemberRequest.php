<?php

namespace App\Requests;

class MemberRequest
{
    public function validate($data, $isUpdate = false)
    {
        $errors = [];

        if (empty(trim($data['name'] ?? ''))) {
            $errors['name'] = "Nama wajib diisi.";
        }

        if (!$isUpdate) {
            if (empty(trim($data['email'] ?? ''))) {
                $errors['email'] = "Email wajib diisi.";
            }
        }

        if (!empty($data['email']) && !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Format email tidak valid.";
        }

        if (!empty($data['phone']) && strlen($data['phone']) < 10) {
            $errors['phone'] = "Nomor telepon minimal 10 karakter.";
        }

        if (!empty($data['social']) && !is_array($data['social'])) {
            $errors['social'] = "Data social media harus berupa array.";
        }

        if (!empty($data['courses']) && !is_array($data['courses'])) {
            $errors['courses'] = "Data kursus harus berupa array.";
        }

        return $errors;
    }
}
