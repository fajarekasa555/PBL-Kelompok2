<?php

namespace App\Requests;

class ActivityRequest
{
    public function validate($data, $isUpdate = false)
    {
        $errors = [];

        if (empty(trim($data['title'] ?? ''))) {
            $errors['title'] = "Judul kegiatan wajib diisi.";
        } else {
            if (strlen($data['title']) < 3) {
                $errors['title'] = "Judul minimal 3 karakter.";
            }
            if (strlen($data['title']) > 255) {
                $errors['title'] = "Judul maksimal 255 karakter.";
            }
        }

        if (!empty($data['description']) && strlen(trim($data['description'])) < 5) {
            $errors['description'] = "Deskripsi minimal 5 karakter.";
        }

        if (!empty($data['location']) && strlen(trim($data['location'])) > 255) {
            $errors['location'] = "Lokasi maksimal 255 karakter.";
        }

        if (!empty($data['date'])) {
            if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $data['date'])) {
                $errors['date'] = "Format tanggal harus YYYY-MM-DD.";
            }
        } else {
            if (!$isUpdate) {
                $errors['date'] = "Tanggal kegiatan wajib diisi.";
            }
        }

        if (!empty($data['documentation'])) {
            if (strlen($data['documentation']) > 255) {
                $errors['documentation'] = "Nama file dokumentasi maksimal 255 karakter.";
            }
        }

        return $errors;
    }
}
