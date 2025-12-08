<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Middleware\AuthMiddleware;
use App\Models\ResearchFocusModel;

class ResearchFocusController extends Controller
{
    private $focusModel;

    public function __construct()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        AuthMiddleware::requireAdmin();
        $this->focusModel = new ResearchFocusModel();
    }

    public function index()
    {
        $user = $_SESSION['user'] ?? null;
        if (isset($_GET['ajax'])) {
            header('Content-Type: application/json; charset=utf-8');

            $focuses = $this->focusModel->all();
            $data = [];

            foreach ($focuses as $f) {
                $data[] = [
                    'title' => $f['title'],
                    'field' => $f['field'] ?: '-',
                    'description' => $f['description'] ?: '-',
                    'action' => '
                        <div class="btn-group" role="group">
                            <button class="btn btn-sm btn-warning" onclick="editFocus('.$f['id'].')" title="Edit">
                                <i class="fa fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-danger" onclick="deleteFocus('.$f['id'].')" title="Hapus">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                    '
                ];
            }

            echo json_encode(['data' => $data]);
            exit;
        }

        $focuses = $this->focusModel->all();

        return $this->view('cms/content/research_focuses/index', [
            'focuses' => $focuses,
            'user' => $user
        ]);
    }

    public function create()
    {
        return include __DIR__ . '/../Views/cms/content/research_focuses/create.php';
    }

    public function store()
    {
        $title = trim($_POST['title'] ?? '');
        $field = trim($_POST['field'] ?? '');
        $description = trim($_POST['description'] ?? '');

        if ($title !== '') {
            $this->focusModel->create($title, $field, $description);
        }
    }

    public function edit($id)
    {
        $focus = $this->focusModel->find($id);

        return include __DIR__ . '/../Views/cms/content/research_focuses/edit.php';
    }

    public function update()
    {
        $id = $_POST['id'] ?? null;
        $title = trim($_POST['title'] ?? '');
        $field = trim($_POST['field'] ?? '');
        $description = trim($_POST['description'] ?? '');

        if ($id && $title) {
            $this->focusModel->update($id, $title, $field, $description);
        }
    }

    public function delete($id)
    {
        if ($id) {
            $this->focusModel->delete($id);
        }
    }
}
