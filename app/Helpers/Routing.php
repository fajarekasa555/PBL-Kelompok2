<?php

namespace App\Helpers;

class Routing {
    function base_url($path = '') {
        $base = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
        return $base . '/' . ltrim($path, '/');
    }
}

