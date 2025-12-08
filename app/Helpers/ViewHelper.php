<?php

namespace App\Helpers;

class ViewHelper
{
    public static function renderEmail($template, $data = [])
    {
        extract($data);

        ob_start();
        include __DIR__ . "/../Views/email/" . $template . ".php";
        return ob_get_clean();
    }
}
