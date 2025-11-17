<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Middleware\AuthMiddleware;
use App\Models\expertiesModel;

class ExpertiesController extends Controller
{
    private $expertiesModel;

    public function __construct()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        AuthMiddleware::requireAdmin();
        $this->expertiesModel = new expertiesModel();
    }

    public function index()
    {
        if (isset($_GET['ajax'])) {
            header('Content-Type: application/json; charset=utf-8');

            $experties = $this->expertiesModel->all();
            $data = [];

            foreach ($experties as $r) {
                $data[] = [
                    'name' => $r['name'],
                    'action' => '
                        <div class="btn-group" role="group">
                            <button class="btn btn-sm btn-warning" onclick="editExperties('.$r['id'].')" title="Edit">
                                <i class="fa fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-danger" onclick="deleteExperties('.$r['id'].')" title="Hapus">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                    '
                ];
            }

            echo json_encode(['data' => $data]);
            exit;
        }

        $experties = $this->expertiesModel->all();

        return $this->view('cms/anggota_lab/experties/index', [
            'experties' => $experties   
        ]);
    }

    public function create()
    {
        return include __DIR__ . '/../Views/cms/anggota_lab/experties/create.php';
    }

    public function store()
    {
        $name = trim($_POST['name'] ?? '');

        if ($name !== '') {
            $this->expertiesModel->create($name);
        }
    }

    public function edit($id)
    {
        $experties = $this->expertiesModel->find($id);

        return include __DIR__ . '/../Views/cms/anggota_lab/experties/edit.php';

    }

    public function update()
    {
        $id = $_POST['id'] ?? null;
        $name = trim($_POST['name'] ?? '');

        if ($id && $name) {
            $this->expertiesModel->update($id, $name);
        }
    }

    public function delete($id)
    {
        if ($id) {
            $this->expertiesModel->delete($id);
        }
    }
}
