<?php
class AuthMiddleware {
    public static function requireAdmin() {
        if (session_status() !== PHP_SESSION_ACTIVE) session_start();
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?page=login');
            exit;
        }
        if (!isset($_SESSION['user']['role_name']) || $_SESSION['user']['role_name'] !== 'admin') {
            header('Location: index.php?page=forbidden');
            exit;
        }
    }
}
