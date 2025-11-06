<?php
require_once __DIR__ . '/../models/UserModel.php';

class AuthController {
    public function login() {
        if (session_status() !== PHP_SESSION_ACTIVE) session_start();
        if (isset($_SESSION['user'])) {
            header('Location: index.php?page=dashboard');
            exit;
        }

        $error = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            $model = new UserModel();
            $user = $model->checkLogin($username, $password);

            if ($user && isset($user['role_name']) && $user['role_name'] === 'admin') {
                $_SESSION['user'] = $user;
                header('Location: index.php?page=dashboard');
                exit;
            } else {
                $error = 'Login gagal. Pastikan username/password dan role admin benar.';
            }
        }

        include __DIR__ . '/../views/cms/auth/login.php';
    }

    public function logout() {
        if (session_status() !== PHP_SESSION_ACTIVE) session_start();
        session_unset();
        session_destroy();
        header('Location: index.php?page=login');
        exit;
    }
}
