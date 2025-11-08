<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Middleware\AuthMiddleware;

class DashboardController extends Controller
{
    public function __construct()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        AuthMiddleware::requireAdmin();
    }

    public function index()
    {
        $user = $_SESSION['user'] ?? null;
        return $this->view('cms/dashboard/index', [
            'user' => $user
        ]);
    }
}
