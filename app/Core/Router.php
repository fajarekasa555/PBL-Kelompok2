<?php
namespace App\Core;

class Router
{
    private array $routes;

    public function __construct()
    {
        $this->routes = require __DIR__ . '/../../routes/web.php';
    }

    public function handle()
    {
        session_start();

        $route = $_GET['route'] ?? 'dashboard';
        $route = trim($route, '/');

        foreach ($this->routes as $path => $config) {
            $pattern = preg_replace('/\{[a-zA-Z_]+\}/', '([0-9a-zA-Z_-]+)', $path);
            $pattern = "#^" . $pattern . "$#";

            if (preg_match($pattern, $route, $matches)) {
                array_shift($matches);

                [$controllerClass, $method, $middlewares] = $config;

                if (in_array('auth', $middlewares) && empty($_SESSION['user'])) {
                    header('Location: index.php?route=login');
                    exit;
                }

                if (in_array('admin', $middlewares)) {
                    if (empty($_SESSION['user']) || $_SESSION['user']['role_name'] !== 'admin') {
                        http_response_code(403);
                        echo "403 | Akses ditolak";
                        exit;
                    }
                }

                if (!class_exists($controllerClass)) {
                    http_response_code(500);
                    echo "Controller <b>$controllerClass</b> tidak ditemukan.";
                    exit;
                }

                $controller = new $controllerClass();

                if (!method_exists($controller, $method)) {
                    http_response_code(500);
                    echo "Method <b>$method</b> tidak ditemukan di $controllerClass.";
                    exit;
                }

                return call_user_func_array([$controller, $method], $matches);
            }
        }

        http_response_code(404);
        echo "404 | Halaman tidak ditemukan";
        exit;
    }
}
