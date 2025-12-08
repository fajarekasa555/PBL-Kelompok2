<?php

namespace App\Requests;

class MemberStudentRequest
{
    public function validate($data, $files, $isUpdate = false)
    {
        $errors = [];

        if (empty(trim($data['nim'] ?? ''))) {
            $errors['nim'] = "NIM wajib diisi.";
        } elseif (strlen($data['nim']) > 20) {
            $errors['nim'] = "NIM maksimal 20 karakter.";
        }

        if (empty(trim($data['name'] ?? ''))) {
            $errors['name'] = "Nama lengkap wajib diisi.";
        }

        if (!$isUpdate && empty(trim($data['email'] ?? ''))){
            $errors['email'] = "Email wajib diisi.";
        }

        if (!empty($data['email']) && !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Email tidak valid.";
        }

        if (!empty($data['phone']) && strlen($data['phone']) < 8) {
            $errors['phone'] = "Nomor telepon minimal 8 karakter.";
        }

        if (empty(trim($data['ipk'] ?? ''))) {
            $errors['ipk'] = "IPK wajib diisi.";
        } elseif (!is_numeric($data['ipk'])) {
            $errors['ipk'] = "IPK harus berupa angka.";
        } elseif ($data['ipk'] < 3.00 || $data['ipk'] > 4.00) {
            $errors['ipk'] = "IPK harus berada antara 3.00 - 4.00.";
        }

        if (!empty($data['program_studi']) && strlen($data['program_studi']) > 100) {
            $errors['program_studi'] = "Program studi maksimal 100 karakter.";
        }

        if (!empty($data['semester']) && !in_array($data['semester'], range(1, 10))) {
            $errors['semester'] = "Semester tidak valid.";
        }

        if (empty(trim($data['motivation'] ?? ''))) {
            $errors['motivation'] = "Motivasi wajib diisi.";
        } elseif (strlen($data['motivation']) > 1000) {
            $errors['motivation'] = "Motivasi maksimal 1000 karakter.";
        }

        if (!$isUpdate) {
            if (empty($files['cv']['name'])) {
                $errors['cv'] = "CV wajib diunggah.";
            }
        }

        if (!empty($files['cv']['name'])) {
            $errors = array_merge($errors, $this->validateFile(
                $files['cv'],
                ['pdf', 'doc', 'docx'],
                5,
                "cv"
            ));
        }

        if (!empty($files['portfolio']['name'])) {
            $errors = array_merge($errors, $this->validateFile(
                $files['portfolio'],
                ['pdf', 'doc', 'docx', 'zip'],
                10,
                "portfolio"
            ));
        }

        return $errors;
    }


    private function validateFile($file, $allowedExt, $maxMb, $keyName)
    {
        $errors = [];

        if ($file['error'] !== UPLOAD_ERR_OK) {
            $errors[$keyName] = "Gagal mengunggah file $keyName.";
            return $errors;
        }

        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, $allowedExt)) {
            $errors[$keyName] = "Format file $keyName tidak didukung.";
        }

        $maxBytes = $maxMb * 1024 * 1024;
        if ($file['size'] > $maxBytes) {
            $errors[$keyName] = "Ukuran file $keyName maksimal {$maxMb}MB.";
        }

        return $errors;
    }
}
