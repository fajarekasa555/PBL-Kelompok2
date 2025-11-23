<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Middleware\AuthMiddleware;
use App\Models\LabMissionModel;

class LabMissionController extends Controller
{
    private $missionModel;

    public function __construct()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        AuthMiddleware::requireAdmin();
        $this->missionModel = new LabMissionModel();
    }

    public function index()
    {
        if (isset($_GET['ajax'])) {
            header('Content-Type: application/json; charset=utf-8');

            $missions = $this->missionModel->all();
            $data = [];

            foreach ($missions as $m) {
                $statusBadge = $m['is_active']
                    ? '<span class="badge badge-success">Aktif</span>'
                    : '<span class="badge badge-secondary">Nonaktif</span>';

                $data[] = [
                    'mission' => $m['mission'],
                    'order_number' => $m['order_number'],
                    // 'is_active' => $statusBadge,
                    'action' => '
                        <div class="btn-group" role="group">
                            <button class="btn btn-sm btn-warning" onclick="editMission('.$m['id'].')" title="Edit">
                                <i class="fa fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-danger" onclick="deleteMission('.$m['id'].')" title="Hapus">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                    '
                ];
            }

            echo json_encode(['data' => $data]);
            exit;
        }

        $missions = $this->missionModel->all();

        return $this->view('cms/content/mission/index', [
            'missions' => $missions
        ]);
    }

    public function create()
    {
        $maxOrder = $this->missionModel->getMaxOrder();
        $nextOrder = $maxOrder + 1;
        $order_number = $nextOrder;

        return include __DIR__ . '/../Views/cms/content/mission/create.php';
    }

    public function store()
    {
        $data['mission'] = trim($_POST['mission'] ?? '');
        $data['order_number'] = intval($_POST['order_number'] ?? 1);
        // $data['is_active'] = isset($_POST['is_active']) ?? true;

        if ($data['mission'] !== '') {
            $this->missionModel->create($data);
        }
    }

    public function edit($id)
    {
        $mission = $this->missionModel->find($id);

        return include __DIR__ . '/../Views/cms/content/mission/edit.php';
    }

    public function update()
    {
        $id = $_POST['id'] ?? null;
        $data['mission'] = trim($_POST['mission'] ?? '');
        $data['order_number'] = intval($_POST['order_number'] ?? 1);
        // $data['is_active'] = isset($_POST['is_active']) ?? true;

        if ($id && $data['mission'] !== '') {
            $this->missionModel->update($id, $data);
        }
    }

    public function delete($id)
    {
        if ($id) {
            $this->missionModel->delete($id);
        }
    }
}
