<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\UserModel;

class AuthController extends Controller {
    
    public function index(){
        return $this->login();
    }

    public function login() {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        if (isset($_SESSION['user'])) {
            return $this->redirect('index.php?page=dashboard');
        }

        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username'] ?? '');
            $password = trim($_POST['password'] ?? '');

            $model = new UserModel();
            $user = $model->checkLogin($username, $password);

            if ($user && ($user['role_name'] ?? null) === 'admin') {
                $_SESSION['user'] = $user;
                return $this->redirect('index.php?page=dashboard');
            }

            $error = 'Login gagal. Pastikan username/password dan role admin benar.';
        }

        return $this->view('cms/auth/login', [
            'error' => $error
        ], false);
    }

    public function logout() {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
        session_unset();
        session_destroy();
        return $this->redirect('index.php?page=auth');
    }
}
