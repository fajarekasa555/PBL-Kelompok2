<?php
namespace App\Core;

class Router {
    public function handle() {
        session_start();

        $page = $_GET['page'] ?? 'dashboard';
        $action = $_GET['action'] ?? 'index';

        // Cek apakah sudah login
        $isLoggedIn = isset($_SESSION['user']);

        // Daftar halaman publik (boleh diakses tanpa login)
        $publicPages = ['auth'];

        // Jika belum login dan bukan halaman publik → redirect ke login
        if (!$isLoggedIn && !in_array($page, $publicPages)) {
            header('Location: index.php?page=auth');
            exit;
        }

        // Tentukan controller dan method
        $controllerName = ucfirst($page) . 'Controller';
        $controllerClass = "App\\Controllers\\$controllerName";

        if (!class_exists($controllerClass)) {
            die("Controller $controllerClass not found");
        }

        $controller = new $controllerClass();

        if (!method_exists($controller, $action)) {
            die("Method $action not found in $controllerClass");
        }

        // Jalankan method pada controller
        $controller->$action();
    }
}
