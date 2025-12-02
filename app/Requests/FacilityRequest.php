<?php

namespace App\Requests;

class FacilityRequest
{
    public function validate($data, $isUpdate = false)
    {
        $errors = [];

        if (empty(trim($data['slug'] ?? ''))) {
            $errors['slug'] = "Slug fasilitas wajib diisi.";
        } else {
            if (strlen($data['slug']) < 3) {
                $errors['slug'] = "Slug minimal 3 karakter.";
            }
            if (strlen($data['slug']) > 50) {
                $errors['slug'] = "Slug maksimal 50 karakter.";
            }
        }

        if (empty(trim($data['description'] ?? ''))) {
            $errors['description'] = "Deskripsi fasilitas wajib diisi.";
        } else {
            if (strlen(trim($data['description'])) < 5) {
                $errors['description'] = "Deskripsi minimal 5 karakter.";
            }
        }

        // if (!empty($data['image'])) {
        //     if (strlen($data['image']) > 255) {
        //         $errors['image'] = "Nama file gambar maksimal 255 karakter.";
        //     }
        // } else {
        //     if (!$isUpdate) {
        //         $errors['image'] = "Gambar fasilitas wajib diupload.";
        //     }
        // }

        return $errors;
    }
}
