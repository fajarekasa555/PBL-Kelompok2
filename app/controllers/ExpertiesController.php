<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Middleware\AuthMiddleware;
use App\Models\expertiesModel;
use App\Requests\ExpertiseRequest;

class ExpertiesController extends Controller
{
    private $expertiesModel;
    private $expertiseRequest;

    public function __construct()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        AuthMiddleware::requireAdmin();
        $this->expertiesModel = new expertiesModel();
        $this->expertiseRequest = new ExpertiseRequest();
    }

    public function index()
    {
        $user = $_SESSION['user'] ?? null;
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
            'experties' => $experties,
            'user' => $user
        ]);
    }

    public function create()
    {
        return include __DIR__ . '/../Views/cms/anggota_lab/experties/create.php';
    }

    public function store()
    {
        header('Content-Type: application/json; charset=utf-8');

        $data = ['name' => trim($_POST['name'] ?? '')];

        $errors = $this->expertiseRequest->validate($data);

        if (!empty($errors)) {
            echo json_encode(['status' => 'error', 'errors' => $errors]);
            return;
        }

        $this->expertiesModel->create($data['name']);

        echo json_encode([
            'status' => 'success',
            'message' => 'Keahlian berhasil ditambahkan.'
        ]);
    }

    public function edit($id)
    {
        $experties = $this->expertiesModel->find($id);

        return include __DIR__ . '/../Views/cms/anggota_lab/experties/edit.php';

    }

    public function update()
    {
        header('Content-Type: application/json; charset=utf-8');

        $id = intval($_POST['id']);
        $data = ['name' => trim($_POST['name'] ?? '')];

        $errors = $this->expertiseRequest->validate($data);
        if (!empty($errors)) {
            echo json_encode(['status' => 'error', 'errors' => $errors]);
            return;
        }

        $this->expertiesModel->update($id, $data['name']);

        echo json_encode([
            'status' => 'success',
            'message' => 'Keahlian berhasil diperbarui.'
        ]);
    }

    public function delete($id)
    {
        if ($id) {
            $this->expertiesModel->delete($id);
        }
    }
}
