<?php
namespace App\Models;

use PDO;
use App\Config\Database;

class DashboardModel {
    protected $conn;

    public function __construct() {
        $this->conn = (new Database())->connect();
    }

    public function getCounts() {
        $query = "SELECT * FROM dashboard_counts LIMIT 1";
        return $this->conn->query($query)->fetch(PDO::FETCH_ASSOC);
    }

    public function getPublicationsPerYear() {
        $query = "SELECT * FROM view_publications_per_year";
        return $this->conn->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProjectsPerYear() {
        $query = "SELECT * FROM view_projects_per_year";
        return $this->conn->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getActivitiesPerMonth() {
        $query = "SELECT * FROM view_activities_per_month";
        return $this->conn->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getExpertiseStats() {
        $query = "SELECT * FROM view_member_expertise";
        return $this->conn->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }
}
