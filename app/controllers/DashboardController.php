<?php
require_once __DIR__ . '/../middleware/AuthMiddleware.php';

class DashboardController {
    public function index() {
        AuthMiddleware::requireAdmin();
        if (session_status() !== PHP_SESSION_ACTIVE) session_start();
        $user = $_SESSION['user'] ?? null;

        // you can prepare data here to pass to view
        $content = __DIR__ . '/../views/cms/dashboard/index.php';
        include __DIR__ . '/../views/cms/layouts/main.php';
    }
}
