<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Middleware\AuthMiddleware;
use App\Models\DashboardModel;

class DashboardController extends Controller
{
    protected $dashboardModel;

    public function __construct()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        AuthMiddleware::requireAdmin();
        $this->dashboardModel = new DashboardModel();
    }

    public function index()
    {
        $user = $_SESSION['user'] ?? null;
        $counts = $this->dashboardModel->getCounts();
        $pubYear = $this->dashboardModel->getPublicationsPerYear();
        $projYear = $this->dashboardModel->getProjectsPerYear();
        $actMonth = $this->dashboardModel->getActivitiesPerMonth();
        $expertise = $this->dashboardModel->getExpertiseStats();

        return $this->view('cms/dashboard/index', [
            'user' => $user,
            'counts' => $counts,
            'pubYear' => $pubYear,
            'projYear' => $projYear,
            'actMonth' => $actMonth,
            'expertise' => $expertise,
        ]);
    }
}
