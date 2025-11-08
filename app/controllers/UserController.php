<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\UserModel;
use App\Models\RoleModel;

class UserController extends Controller
{
    protected $userModel;
    protected $roleModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->roleModel = new RoleModel();
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
        $data = [
            'username' => $_POST['username'] ?? '',
            'password' => $_POST['password'] ?? '',
            'role_id'  => $_POST['role_id'] ?? ''
        ];

        $this->userModel->create($data);

        return $this->redirect('index.php?page=users');
    }

    public function edit()
    {
        $id = $_GET['id'] ?? null;
        $user_edit = $this->userModel->findOrFail($id);
        $roles = $this->roleModel->all();

        return include __DIR__ . '/../Views/cms/user_management/users/edit.php';
    }

    public function update()
    {
        $id = $_POST['id'] ?? null;

        $data = [
            'username' => $_POST['username'] ?? '',
            'password' => $_POST['password'] ?? '',
            'role_id'  => $_POST['role_id'] ?? ''
        ];

        $this->userModel->update($id, $data);

        return $this->redirect('index.php?page=users');
    }

    public function delete()
    {
        $id = $_GET['id'] ?? null;
        $this->userModel->delete($id);

        return $this->redirect('index.php?page=users');
    }
}
