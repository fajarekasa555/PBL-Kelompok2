<?php
require_once __DIR__ . '/../middleware/AuthMiddleware.php';
require_once __DIR__ . '/../models/RoleModel.php';

class RoleController {

    private $roleModel;

    public function __construct() {
        $this->roleModel = new RoleModel();
    }

    // List Roles
    public function index() {
        AuthMiddleware::requireAdmin();
        $user = $_SESSION['user'] ?? null;

        if (isset($_GET['ajax']) && !isset($_GET['action'])) {
            header('Content-Type: application/json; charset=utf-8');
            ob_clean(); // 
            $roles = $this->roleModel->getAll();
            $data = [];

            foreach ($roles as $r) {
                $data[] = [
                    'name' => $r['name'],
                    'action' => '
                        <div class="btn-group" role="group">
                            <button class="btn btn-sm btn-warning" title="Edit" onclick="editRole('.$r['id'].')">
                                <i class="fa fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-danger" title="Hapus" onclick="deleteRole('.$r['id'].')">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                    '
                ];
            }

            echo json_encode([
                'data' => $data
            ]);
            exit;
        }

        $content = __DIR__ . '/../views/cms/user_management/roles/index.php';
        include __DIR__ . '/../views/cms/layouts/main.php';
    }

    // Show Form Create
    public function create() {
        AuthMiddleware::requireAdmin();
        if (session_status() !== PHP_SESSION_ACTIVE) session_start();
        $user = $_SESSION['user'] ?? null;
        $user_role = $user['role_name'] ?? null;

        include __DIR__ . '/../views/cms/user_management/roles/create.php';
        // include __DIR__ . '/../views/cms/layouts/main.php';
    }

    // Handle Form Submission Insert
    public function store() {
        AuthMiddleware::requireAdmin();
        $name = $_POST['name'] ?? '';

        if (!empty($name)) {
            $this->roleModel->create($name);
        }

        header('Location: index.php?controller=role&action=index');
        exit;
    }

    // Show Form Edit
    public function edit() {
        AuthMiddleware::requireAdmin();
        if (session_status() !== PHP_SESSION_ACTIVE) session_start();

        $id = $_GET['id'] ?? null;
        $role = $this->roleModel->getById($id);

        include __DIR__ . '/../views/cms/user_management/roles/edit.php';
        // include __DIR__ . '/../views/cms/layouts/main.php';
    }

    // Handle Update
    public function update() {
        AuthMiddleware::requireAdmin();
        $id = $_POST['id'] ?? null;
        $name = $_POST['name'] ?? '';

        if ($id && $name) {
            $this->roleModel->update($id, $name);
        }

        header('Location: index.php?controller=role&action=index');
        exit;
    }

    // Delete Role
    public function delete() {
        AuthMiddleware::requireAdmin();
        $id = $_GET['id'] ?? null;

        if ($id) {
            $this->roleModel->delete($id);
        }

        header('Location: index.php?controller=role&action=index');
        exit;
    }
}
