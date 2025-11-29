<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\UserModel;
use App\Models\RoleModel;
use App\Requests\UserRequest;

class UserController extends Controller
{
    protected $userModel;
    protected $roleModel;
    protected $request;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->roleModel = new RoleModel();
        $this->request = new UserRequest();
    }

    public function index()
    {
        if (isset($_GET['ajax'])) {
            header('Content-Type: application/json; charset=utf-8');

            $users = $this->userModel->all();
            $data = [];

            foreach ($users as $r) {
                $data[] = [
                    'username' => $r['username'],
                    'role_name' => $r['role_name'],
                    'action' => '
                        <div class="btn-group" role="group">
                            <button class="btn btn-sm btn-warning" onclick="editUser('.$r['id'].')" title="Edit">
                                <i class="fa fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-danger" onclick="deleteUser('.$r['id'].')" title="Hapus">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                    '
                ];
            }

            echo json_encode(['data' => $data]);
            exit;
        }

        $users = $this->userModel->all();

        return $this->view('cms/user_management/users/index', [
            'users' => $users
        ]);
    }

    public function create()
    {
        $user_edit = '';
        $roles = $this->roleModel->all();

        return include __DIR__ . '/../Views/cms/user_management/users/create.php';
    }

    public function store()
    {
        header('Content-Type: application/json; charset=utf-8');

        $data = [
            'username' => $_POST['username'] ?? '',
            'password' => $_POST['password'] ?? '',
            'role_id'  => $_POST['role_id'] ?? null
        ];

        $errors = $this->request->validate($data);
        if (!empty($errors)) {
            echo json_encode(['status' => 'error', 'errors' => $errors]);
            return;
        }

        $this->userModel->create($data);

        echo json_encode([
            'status' => 'success',
            'message' => 'User berhasil dibuat.'
        ]);
    }

    public function edit($id)
    {
        $user_edit = $this->userModel->findOrFail($id);
        $roles = $this->roleModel->all();

        return include __DIR__ . '/../Views/cms/user_management/users/edit.php';
    }

    public function update()
    {
        header('Content-Type: application/json; charset=utf-8');

        $id = $_POST['id'] ?? null;

        $data = [
            'id'       => $_POST['id'] ?? null,
            'username' => $_POST['username'] ?? '',
            'password' => $_POST['password'] ?? '',
            'role_id'  => $_POST['role_id'] ?? null
        ];

        $errors = $this->request->validate($data);
        if (!empty($errors)) {
            echo json_encode(['status' => 'error', 'errors' => $errors]);
            return;
        }

        $this->userModel->update($id, $data);

        echo json_encode([
            'status' => 'success',
            'message' => 'User berhasil diperbarui.'
        ]);
    }

    public function delete($id)
    {
        $this->userModel->delete($id);
    }
}
