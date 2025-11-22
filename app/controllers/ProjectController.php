<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Middleware\AuthMiddleware;
use App\Models\ProjectModel;
use App\Models\MembersModel;
use App\Models\ProjectsMemberModel;
use PDOException;

class ProjectController extends Controller
{
    private $projectsModel;
    private $projectMembersModel;
    private $memberModel;
    
    public function __construct()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        AuthMiddleware::requireAdmin();

        $this->projectsModel = new ProjectModel();
        $this->projectMembersModel = new ProjectsMemberModel();
        $this->memberModel = new MembersModel();
    }

    public function index()
    {
        if (isset($_GET['ajax'])) {
            header('Content-Type: application/json; charset=utf-8');
            $projects = $this->projectsModel->all();
            $data = [];

            foreach ($projects as $p) {
                $data[] = [
                    'name' => htmlspecialchars($p['name']),
                    'description' => htmlspecialchars($p['description']),
                    'action' => '
                        <div class="btn-group">
                            <button class="btn btn-sm btn-info" onclick="showProject(' . intval($p['id']) . ')">
                                <i class="fa fa-eye"></i>
                            </button>
                            <button class="btn btn-sm btn-warning" onclick="editProject(' . intval($p['id']) . ')">
                                <i class="fa fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-danger" onclick="deleteProject(' . intval($p['id']) . ')">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>'
                ];
            }

            echo json_encode(['data' => $data]);
            exit;
        }

        return $this->view('cms/content/projects/index');
    }

    public function show($id)
    {
        $project = $this->projectsModel->findOrFail($id);
        $members = $this->projectMembersModel->getDetailedMembersByProject($id);

        return include __DIR__ . '/../Views/cms/content/projects/view.php';
    }

    public function create()
    {
        $allMembers = $this->memberModel->all();
        return include __DIR__ . '/../Views/cms/content/projects/create.php';
    }

    public function store()
    {
        try {
            $db = $this->projectsModel->getConnection();
            $db->beginTransaction();

            $data = [
                'name' => trim($_POST['name'] ?? ''),
                'description' => trim($_POST['description'] ?? ''),
                'start_date' => trim($_POST['start_date'] ?? ''),
                'end_date' => trim($_POST['end_date'] ?? ''),
                'sponsor' => trim($_POST['sponsor'] ?? ''),
                'documentation' => '',
            ];

            if ($data['name'] === '') {
                throw new \Exception("Nama project wajib diisi.");
            }

            if (!empty($_FILES['documentation']['name'])) {
                $this->validateFile($_FILES['documentation']['type']);

                $uploadDir = __DIR__ . '/../../public/uploads/projects/';
                if (!file_exists($uploadDir)) mkdir($uploadDir, 0777, true);

                $filename = time() . '_' . basename($_FILES['documentation']['name']);
                $targetFile = $uploadDir . $filename;

                if (!move_uploaded_file($_FILES['documentation']['tmp_name'], $targetFile)) {
                    throw new \Exception("Gagal mengupload file.");
                }

                $data['documentation'] = 'uploads/projects/' . $filename;
            }

            $projectId = $this->projectsModel->create(
                $data['name'],
                $data['description'],
                $data['start_date'],
                $data['end_date'],
                $data['sponsor'],
                $data['documentation']
            );

            if (!empty($_POST['members'])) {
                $members = $_POST['members'];
                $this->projectMembersModel->insertMany($projectId, $members);
            }

            $db->commit();
            echo "OK";

        } catch (\Exception $e) {
            if ($db->inTransaction()) $db->rollback();
            http_response_code(500);
            echo $e->getMessage();
        }
    }

    public function edit($id)
    {
        $project = $this->projectsModel->findOrFail($id);
        $allMembers = $this->memberModel->all();
        $projectMembers = $this->projectMembersModel->getMembersByProject($id);
        $projectMembers = array_column($projectMembers, 'member_id');

        return include __DIR__ . '/../Views/cms/content/projects/edit.php';
    }

    public function update()
    {
        try {
            $db = $this->projectsModel->getConnection();
            $db->beginTransaction();

            $id = intval($_POST['id']);
            $old = $this->projectsModel->findOrFail($id);
            $documentation = $old['documentation'];

            if (!empty($_FILES['documentation']['name'])) {
                $this->validateFile($_FILES['documentation']['type']);

                $uploadDir = __DIR__ . '/../../public/uploads/projects/';
                if (!file_exists($uploadDir)) mkdir($uploadDir, 0777, true);

                $filename = time() . '_' . basename($_FILES['documentation']['name']);
                $targetFile = $uploadDir . $filename;

                if (!move_uploaded_file($_FILES['documentation']['tmp_name'], $targetFile)) {
                    throw new \Exception("Gagal mengupload file.");
                }

                $documentation = 'uploads/projects/' . $filename;
            }

            $this->projectsModel->update(
                $id,
                $_POST['name'],
                $_POST['description'],
                $_POST['start_date'],
                $_POST['end_date'],
                $_POST['sponsor'],
                $documentation
            );

            $this->projectMembersModel->deleteByProject($id);

            if (!empty($_POST['members'])) {
                $members = $_POST['members'];
                $this->projectMembersModel->insertMany($id, $members);
            }

            $db->commit();
            echo "OK";

        } catch (\Exception $e) {
            if ($db->inTransaction()) $db->rollback();
            http_response_code(500);
            echo $e->getMessage();
        }
    }

    public function delete($id)
    {
        try {
            $db = $this->projectsModel->getConnection();
            $db->beginTransaction();

            $project = $this->projectsModel->findOrFail($id);

            if (!empty($project['documentation'])) {
                $filePath = __DIR__ . '/../../../public/' . $project['documentation'];
                if (file_exists($filePath)) unlink($filePath);
            }

            $this->projectMembersModel->deleteByProject($id);

            $this->projectsModel->delete($id);

            $db->commit();
            echo "OK";

        } catch (\Exception $e) {
            if ($db->inTransaction()) $db->rollback();
            http_response_code(500);
            echo $e->getMessage();
        }
    }

    private function validateFile($mime)
    {
        $allowed = [
            'image/jpeg', 'image/png', 'image/webp',
            'application/pdf',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
        ];

        if (!in_array($mime, $allowed)) {
            throw new \Exception("File tidak diizinkan.");
        }
    }
}
