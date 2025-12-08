<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Middleware\AuthMiddleware;
use App\Models\LabVisionModel;

class LabVisionController extends Controller
{
    private $visionModel;

    public function __construct()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        AuthMiddleware::requireAdmin();
        $this->visionModel = new LabVisionModel();
    }

    public function index()
    {
        $user = $_SESSION['user'] ?? null;
        if (isset($_GET['ajax'])) {
            header('Content-Type: application/json; charset=utf-8');

            $visions = $this->visionModel->all();
            $data = [];

            foreach ($visions as $v) {
                $data[] = [
                    'vision' => $v['vision'],
                    'action' => '
                        <div class="btn-group" role="group">
                            <button class="btn btn-sm btn-warning" onclick="editVision('.$v['id'].')" title="Edit">
                                <i class="fa fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-danger" onclick="deleteVision('.$v['id'].')" title="Hapus">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                    '
                ];
            }

            echo json_encode(['data' => $data]);
            exit;
        }

        $visions = $this->visionModel->all();

        return $this->view('cms/content/vision/index', [
            'visions' => $visions,
            'user' => $user
        ]);
    }

    public function create()
    {
        return include __DIR__ . '/../Views/cms/content/vision/create.php';
    }

    public function store()
    {
        $vision = trim($_POST['vision'] ?? '');

        if ($vision !== '') {
            $this->visionModel->create($vision);
        }
    }

    public function edit($id)
    {
        $vision = $this->visionModel->find($id);

        return include __DIR__ . '/../Views/cms/content/vision/edit.php';
    }

    public function update()
    {
        $id = $_POST['id'] ?? null;
        $vision = trim($_POST['vision'] ?? '');

        if ($id && $vision !== '') {
            $this->visionModel->update($id, $vision);
        }
    }

    public function delete($id)
    {
        if ($id) {
            $this->visionModel->delete($id);
        }
    }
}
