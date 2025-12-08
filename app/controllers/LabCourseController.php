<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Middleware\AuthMiddleware;
use App\Models\LabCourseModel;

class LabCourseController extends Controller
{
    private $courseModel;

    public function __construct()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        AuthMiddleware::requireAdmin();
        $this->courseModel = new LabCourseModel();
    }

    public function index()
    {
        $user = $_SESSION['user'] ?? null;
        if (isset($_GET['ajax'])) {
            header('Content-Type: application/json; charset=utf-8');

            $courses = $this->courseModel->all();
            $data = [];

            foreach ($courses as $c) {
                $data[] = [
                    'name' => $c['name'],
                    'description' => $c['description'] ?? '-',
                    'action' => '
                        <div class="btn-group" role="group">
                            <button class="btn btn-sm btn-warning" onclick="editCourse('.$c['id'].')" title="Edit">
                                <i class="fa fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-danger" onclick="deleteCourse('.$c['id'].')" title="Hapus">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                    '
                ];
            }

            echo json_encode(['data' => $data]);
            exit;
        }

        $courses = $this->courseModel->all();

        return $this->view('cms/content/lab_courses/index', [
            'courses' => $courses,
            'user' => $user
        ]);
    }

    public function create()
    {
        return include __DIR__ . '/../Views/cms/content/lab_courses/create.php';
    }

    public function store()
    {
        $name = trim($_POST['name'] ?? '');
        $description = trim($_POST['description'] ?? '');

        if ($name !== '') {
            $this->courseModel->create($name, $description);
        }
    }

    public function edit($id)
    {
        $course = $this->courseModel->find($id);

        return include __DIR__ . '/../Views/cms/content/lab_courses/edit.php';
    }

    public function update()
    {
        $id = $_POST['id'] ?? null;
        $name = trim($_POST['name'] ?? '');
        $description = trim($_POST['description'] ?? '');

        if ($id && $name) {
            $this->courseModel->update($id, $name, $description);
        }
    }

    public function delete($id)
    {
        if ($id) {
            $this->courseModel->delete($id);
        }
    }
}
