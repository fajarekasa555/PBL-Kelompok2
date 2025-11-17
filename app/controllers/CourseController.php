<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Middleware\AuthMiddleware;
use App\Models\CourseModel;
use App\Models\MembersModel;

class CourseController extends Controller
{
    private $courseModel;
    private $membersModel;

    public function __construct()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        AuthMiddleware::requireAdmin();
        $this->courseModel = new CourseModel();
        $this->membersModel = new MembersModel();
    }

    public function index()
    {
        if (isset($_GET['ajax'])) {
            header('Content-Type: application/json; charset=utf-8');

            $courses = $this->courseModel->all();
            $data = [];

            foreach ($courses as $c) {
                $data[] = [
                    'member_name' => htmlspecialchars($c['member_name'] ?? '-'),
                    'semester'    => htmlspecialchars($c['semester'] ?? '-'),
                    'course_name' => htmlspecialchars($c['course_name'] ?? '-'),
                    'action' => '
                        <div class="btn-group">
                            <button class="btn btn-sm btn-warning" onclick="editCourse(' . intval($c['id']) . ')">
                                <i class="fa fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-danger" onclick="deleteCourse(' . intval($c['id']) . ')">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                    '
                ];
            }

            echo json_encode(['data' => $data]);
            exit;
        }

        return $this->view('cms/anggota_lab/courses/index');
    }

    public function create()
    {
        $members = $this->membersModel->all();
        return include __DIR__ . '/../Views/cms/anggota_lab/courses/create.php';
    }

    public function store()
    {
        $member_id = intval($_POST['member_id'] ?? 0);
        $semester = trim($_POST['semester'] ?? '');
        $course_name = trim($_POST['course_name'] ?? '');

        if ($member_id > 0 && in_array($semester, ['Ganjil', 'Genap']) && $course_name !== '') {
            $this->courseModel->create([
                'member_id' => $member_id,
                'semester' => $semester,
                'course_name' => $course_name
            ]);
        } else {
            http_response_code(400);
            echo "Invalid input data.";
        }
    }

    public function edit($id)
    {
        $id = intval($id);
        $course = $this->courseModel->find($id);
        $members = $this->membersModel->all();

        return include __DIR__ . '/../Views/cms/anggota_lab/courses/edit.php';
    }

    public function update()
    {
        $id = intval($_POST['id'] ?? 0);
        $member_id = intval($_POST['member_id'] ?? 0);
        $semester = trim($_POST['semester'] ?? '');
        $course_name = trim($_POST['course_name'] ?? '');

        if ($id > 0 && $member_id > 0 && in_array($semester, ['Ganjil', 'Genap']) && $course_name !== '') {
            $this->courseModel->update($id, [
                'member_id' => $member_id,
                'semester' => $semester,
                'course_name' => $course_name
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
            $this->courseModel->delete($id);
        } else {
            http_response_code(400);
            echo "Invalid ID.";
        }
    }
}
