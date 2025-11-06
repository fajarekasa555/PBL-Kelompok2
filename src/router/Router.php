<?php
class Router {
    public static function route($page, $action) {
        switch ($page) {
            case 'login':
                require_once __DIR__ . '/../../app/controllers/AuthController.php';
                $c = new AuthController();
                $c->login();
                break;
            case 'logout':
                require_once __DIR__ . '/../../app/controllers/AuthController.php';
                $c = new AuthController();
                $c->logout();
                break;
            case 'dashboard':
                require_once __DIR__ . '/../../app/controllers/DashboardController.php';
                $c = new DashboardController();
                $c->index();
                break;
            case 'roles':
                require_once __DIR__ . '/../../app/controllers/RoleController.php';
                $c = new RoleController();
                if($action == 'delete'){
                    $c->delete();
                }elseif($action == 'create'){
                    $c->create();
                }elseif($action == 'store'){
                    $c->store();
                }elseif($action == 'edit'){
                    $c->edit();
                }elseif($action == 'update'){
                    $c->update();
                }else{
                    $c->index();
                }
                break;
            case 'home':
            default:
                include __DIR__ . '/../../app/views/main.php';
                break;
        }
    }
}
