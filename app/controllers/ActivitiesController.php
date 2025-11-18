<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Middleware\AuthMiddleware;
use App\Models\ActivitiesModel;

class ActivitiesController extends Controller
{
    private $activitiesModel;

    public function __construct()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        AuthMiddleware::requireAdmin();

        $this->activitiesModel = new ActivitiesModel();
    }

    public function index()
    {
        if (isset($_GET['ajax'])) {
            header('Content-Type: application/json; charset=utf-8');

            $activities = $this->activitiesModel->all();
            $data = [];

            foreach ($activities as $a) {
                $data[] = [
                    'title' => htmlspecialchars($a['title']),
                    'description' => htmlspecialchars($a['description']),
                    'date' => htmlspecialchars($a['date']),
                    'location' => htmlspecialchars($a['location']),
                    'action' => '
                        <div class="btn-group" role="group">
                            <button class="btn btn-sm btn-info" onclick="showActivity(' . intval($a['id']) . ')" title="Detail">
                                <i class="fa fa-eye"></i>
                            </button>
                            <button class="btn btn-sm btn-warning" onclick="editActivity(' . intval($a['id']) . ')" title="Edit">
                                <i class="fa fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-danger" onclick="deleteActivity(' . intval($a['id']) . ')" title="Hapus">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>'
                ];
            }

            echo json_encode(['data' => $data]);
            exit;
        }

        return $this->view('cms/content/activities/index');
    }

    public function show($id)
    {
        $activity = $this->activitiesModel->findOrFail($id);
        return include __DIR__ . '/../Views/cms/content/activities/view.php';
    }

    public function create()
    {
        return include __DIR__ . '/../Views/cms/content/activities/create.php';
    }

    public function store()
    {
        $data = [
            'title' => trim($_POST['title'] ?? ''),
            'date' => trim($_POST['date'] ?? ''),
            'location' => trim($_POST['location'] ?? ''),
            'description' => trim($_POST['description'] ?? ''),
            'documentation' => ''
        ];

        if ($data['title'] === '') {
            http_response_code(400);
            echo "Judul kegiatan wajib diisi.";
            exit;
        }

        $allowed = [
            'image/jpeg', 'image/png', 'image/webp',
            'application/pdf',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
        ];

        if (!in_array($_FILES['documentation']['type'], $allowed)) {
            die("File tidak diizinkan.");
        }

        if (!empty($_FILES['documentation']['name'])) {
            $uploadDir = __DIR__ . '/../../public/uploads/activities/';
            if (!file_exists($uploadDir)) mkdir($uploadDir, 0777, true);

            $filename = time() . '_' . basename($_FILES['documentation']['name']);
            $targetFile = $uploadDir . $filename;

            if (move_uploaded_file($_FILES['documentation']['tmp_name'], $targetFile)) {
                $data['documentation'] = 'uploads/activities/' . $filename;
            }
        }

        $this->activitiesModel->create($data);

        echo "OK";
    }

    public function edit($id)
    {
        $activity = $this->activitiesModel->findOrFail($id);
        return include __DIR__ . '/../Views/cms/content/activities/edit.php';
    }

    public function update()
    {
        $id = intval($_POST['id']);
        $old = $this->activitiesModel->findOrFail($id);

        $documentation = $old['documentation'];

        $allowed = [
            'image/jpeg', 'image/png', 'image/webp',
            'application/pdf',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
        ];

        if (!in_array($_FILES['documentation']['type'], $allowed)) {
            die("File tidak diizinkan.");
        }

        if (!empty($_FILES['documentation']['name'])) {

            $uploadDir = __DIR__ . '/../../public/uploads/activities/';
            if (!file_exists($uploadDir)) mkdir($uploadDir, 0777, true);

            $filename = time() . '_' . basename($_FILES['documentation']['name']);
            $targetFile = $uploadDir . $filename;

            if (move_uploaded_file($_FILES['documentation']['tmp_name'], $targetFile)) {
                $documentation = 'uploads/activities/' . $filename;
            }
        }

        $this->activitiesModel->update(
            $id,
            $_POST['title'],
            $_POST['description'],
            $_POST['location'],
            $_POST['date'],
            $documentation
        );

        echo "OK";
    }

    public function delete($id)
    {
        $id = intval($id);
        $activity = $this->activitiesModel->findOrFail($id);

        if (!$activity) {
            http_response_code(404);
            echo "Data tidak ditemukan";
            exit;
        }

        if (!empty($activity['documentation']) && file_exists(__DIR__ . '/../../../public/' . $activity['documentation'])) {
            unlink(__DIR__ . '/../../../public/' . $activity['documentation']);
        }

        $this->activitiesModel->delete($id);

        echo "OK";
    }
}
