<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Middleware\AuthMiddleware;
use App\Models\RoleModel;

class RolesController extends Controller
{
    private $roleModel;

    public function __construct()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        AuthMiddleware::requireAdmin();
        $this->roleModel = new RoleModel();
    }

    public function index()
    {
        if (isset($_GET['ajax'])) {
            header('Content-Type: application/json; charset=utf-8');

            $roles = $this->roleModel->all();
            $data = [];

            foreach ($roles as $r) {
                $data[] = [
                    'name' => $r['name'],
                    'action' => '
                        <div class="btn-group" role="group">
                            <button class="btn btn-sm btn-warning" onclick="editRole('.$r['id'].')" title="Edit">
                                <i class="fa fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-danger" onclick="deleteRole('.$r['id'].')" title="Hapus">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                    '
                ];
            }

            echo json_encode(['data' => $data]);
            exit;
        }

        $roles = $this->roleModel->all();

        return $this->view('cms/user_management/roles/index', [
            'roles' => $roles
        ]);
    }

    public function create()
    {
        return include __DIR__ . '/../Views/cms/user_management/roles/create.php';
    }

    public function store()
    {
        $name = trim($_POST['name'] ?? '');

        if ($name !== '') {
            $this->roleModel->create($name);
        }
    }

    public function edit($id)
    {
        $role = $this->roleModel->find($id);

        return include __DIR__ . '/../Views/cms/user_management/roles/edit.php';

    }

    public function update()
    {
        $id = $_POST['id'] ?? null;
        $name = trim($_POST['name'] ?? '');

        if ($id && $name) {
            $this->roleModel->update($id, $name);
        }
    }

    public function delete($id)
    {
        if ($id) {
            $this->roleModel->delete($id);
        }
    }
}
