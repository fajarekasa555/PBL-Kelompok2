<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Middleware\AuthMiddleware;
use App\Models\RoleModel;
use App\Requests\RoleRequest;

class RolesController extends Controller
{
    private $roleModel;
    private $request;

    public function __construct()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        AuthMiddleware::requireAdmin();
        $this->roleModel = new RoleModel();
        $this->request = new RoleRequest();
    }

    public function index()
    {
        $user = $_SESSION['user'] ?? null;
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
            'roles' => $roles,
            'user' => $user
        ]);
    }

    public function create()
    {
        return include __DIR__ . '/../Views/cms/user_management/roles/create.php';
    }

    public function store()
    {
        header('Content-Type: application/json; charset=utf-8');

        $data['name'] = trim($_POST['name'] ?? '');

        $errors = $this->request->validate($data);
        if (!empty($errors)) {
            echo json_encode(['status' => 'error', 'errors' => $errors]);
            return;
        }

        $this->roleModel->create($data['name']);

        echo json_encode([
            'status' => 'success',
            'message' => 'Role berhasil dibuat.'
        ]);
    }

    public function edit($id)
    {
        $role = $this->roleModel->find($id);

        return include __DIR__ . '/../Views/cms/user_management/roles/edit.php';

    }

    public function update()
    {
        header('Content-Type: application/json; charset=utf-8');

        $data['id'] = $_POST['id'] ?? null;
        $data['name'] = trim($_POST['name'] ?? '');

        $errors = $this->request->validate($data);
        if (!empty($errors)) {
            echo json_encode(['status' => 'error', 'errors' => $errors]);
            return;
        }

        $this->roleModel->update($data['id'], $data['name']);

        echo json_encode([
            'status' => 'success',
            'message' => 'Role berhasil diperbarui.'
        ]);
    }

    public function delete($id)
    {
        if ($id) {
            $this->roleModel->delete($id);
        }
    }
}
