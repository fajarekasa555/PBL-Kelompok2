<?php

namespace App\Core;

class Controller
{
    public function view(string $view, array $data = [], bool $useLayout = true)
    {
        if (!empty($data)) {
            extract($data, EXTR_SKIP);
        }

        $viewFile   = __DIR__ . "/../Views/{$view}.php";
        $layoutFile = __DIR__ . "/../Views/cms/layouts/main.php";

        if (!is_file($viewFile)) {
            die("View tidak ditemukan: {$viewFile}");
        }

        // Jika tidak memakai layout → tampilkan langsung
        if ($useLayout === false) {
            include $viewFile;
            return;
        }

        // Ambil konten view
        ob_start();
        include $viewFile;
        $content = ob_get_clean();

        if (!is_file($layoutFile)) {
            die("Layout tidak ditemukan: {$layoutFile}");
        }

        include $layoutFile;
    }

    public function redirect(string $url)
    {
        header("Location: {$url}");
        exit;
    }
}
