<?php
namespace App\Requests;

class PublicationRequest
{
    public static function validateStore(array $data)
    {
        $errors = [];

        if (empty($data['title'])) {
            $errors['title'] = "Judul publikasi wajib diisi.";
        }

        if (empty($data['date'])) {
            $errors['date'] = "Tanggal publikasi wajib diisi.";
        } elseif (!self::isVaildDate($data['date'])) {
            $errors['date'] = "Format tanggal tidak valid. Gunakan format YYYY-MM-DD.";
        }

        if (empty($data['link'])) {
            $errors['link'] = "Link publikasi wajib diisi.";
        } elseif (!filter_var($data['link'], FILTER_VALIDATE_URL)) {
            $errors['link'] = "Link publikasi harus berupa URL yang valid.";
        }

        if (empty($data['member_id'])) {
            $errors['member_id'] = "Member wajib dipilih.";
        } elseif (!ctype_digit((string)$data['member_id'])) {
            $errors['member_id'] = "Member ID harus berupa angka.";
        }

        return $errors;
    }

    public static function validateUpdate(array $data)
    {
        $errors = [];

        if (empty($data['id']) || !ctype_digit((string)$data['id'])) {
            $errors['id'] = "ID publikasi tidak valid.";
        }

        if (empty($data['title'])) {
            $errors['title'] = "Judul publikasi wajib diisi.";
        }

        if (empty($data['date'])) {
            $errors['date'] = "Tanggal publikasi wajib diisi.";
        } elseif (!self::isVaildDate($data['date'])) {
            $errors['date'] = "Format tanggal tidak valid. Gunakan format YYYY-MM-DD.";
        }

        if (empty($data['link'])) {
            $errors['link'] = "Link publikasi wajib diisi.";
        } elseif (!filter_var($data['link'], FILTER_VALIDATE_URL)) {
            $errors['link'] = "Link publikasi harus berupa URL yang valid.";
        }

        if (empty($data['member_id'])) {
            $errors['member_id'] = "Member wajib dipilih.";
        } elseif (!ctype_digit((string)$data['member_id'])) {
            $errors['member_id'] = "Member ID harus berupa angka.";
        }

        return $errors;
    }

    private static function isVaildDate($date)
    {
        return (bool)strtotime($date);
    }
}
