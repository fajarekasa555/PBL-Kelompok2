<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Middleware\AuthMiddleware;
use App\Models\EducationModel;
use App\Models\MembersModel;

class EducationController extends Controller
{
    private $educationsModel;
    private $membersModel;

    public function __construct()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        AuthMiddleware::requireAdmin();
        $this->educationsModel = new EducationModel();
        $this->membersModel = new MembersModel();
    }

    public function index()
    {
        if (isset($_GET['ajax'])) {
            header('Content-Type: application/json; charset=utf-8');

            $educations = $this->educationsModel->all();
            $data = [];

            foreach ($educations as $e) {
                $periode = ($e['start_year'] ?? '-') . ' - ' . ($e['end_year'] ?? '-');

                $data[] = [
                    'member_name' => htmlspecialchars($e['member_name'] ?? '-'),
                    'degree' => htmlspecialchars($e['degree'] ?? '-'),
                    'major' => htmlspecialchars($e['major'] ?? '-'),
                    'institution' => htmlspecialchars($e['institution'] ?? '-'),
                    'periode' => htmlspecialchars($periode),
                    'action' => '
                        <div class="btn-group" role="group">
                            <button class="btn btn-sm btn-warning" onclick="editEducation(' . intval($e['id']) . ')" title="Edit">
                                <i class="fa fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-danger" onclick="deleteEducation(' . intval($e['id']) . ')" title="Hapus">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                    '
                ];
            }

            echo json_encode(['data' => $data]);
            exit;
        }

        $educations = $this->educationsModel->all();

        return $this->view('cms/anggota_lab/education/index', [
            'educations' => $educations
        ]);
    }

    public function create()
    {
        $members = $this->membersModel->all();
        return include __DIR__ . '/../Views/cms/anggota_lab/education/create.php';
    }

    public function store()
    {
        $member_id = intval($_POST['member_id'] ?? 0);
        $degree = trim($_POST['degree'] ?? '');
        $major = trim($_POST['major'] ?? '');
        $institution = trim($_POST['institution'] ?? '');
        $start_year = intval($_POST['start_year'] ?? 0);
        $end_year = intval($_POST['end_year'] ?? 0);

        if ($member_id > 0 && $degree !== '' && $major !== '' && $institution !== '' && $start_year > 0 && $end_year > 0) {
            $this->educationsModel->create([
                'member_id' => $member_id,
                'degree' => $degree,
                'major' => $major,
                'institution' => $institution,
                'start_year' => $start_year,
                'end_year' => $end_year
            ]);
        } else {
            http_response_code(400);
            echo "Invalid input data.";
        }
    }

    public function edit($id)
    {
        $id = intval($id);
        $education = $this->educationsModel->find($id);
        $members = $this->membersModel->all();

        return include __DIR__ . '/../Views/cms/anggota_lab/education/edit.php';
    }

    public function update()
    {
        $id = intval($_POST['id'] ?? 0);
        $member_id = intval($_POST['member_id'] ?? 0);
        $degree = trim($_POST['degree'] ?? '');
        $major = trim($_POST['major'] ?? '');
        $institution = trim($_POST['institution'] ?? '');
        $start_year = intval($_POST['start_year'] ?? 0);
        $end_year = intval($_POST['end_year'] ?? 0);

        if ($id > 0 && $member_id > 0 && $degree !== '' && $major !== '' && $institution !== '' && $start_year > 0 && $end_year > 0) {
            $this->educationsModel->update($id, [
                'member_id' => $member_id,
                'degree' => $degree,
                'major' => $major,
                'institution' => $institution,
                'start_year' => $start_year,
                'end_year' => $end_year
            ]);
        } else {
            http_response_code(400);
            echo "Invalid input data.";
        }
    }

    public function delete($id)
    {
        $id = intval($id);
        if ($id > 0) {
            $this->educationsModel->delete($id);
        } else {
            http_response_code(400);
            echo "Invalid ID.";
        }
    }
}
