<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Middleware\AuthMiddleware;
use App\Models\MembersModel;
use App\Models\PublicationsModel;
use App\Requests\PublicationRequest;

class PublicationsController extends Controller
{
    private $publicationsModel;
    private $membersModel;
    private $request;

    public function __construct()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        AuthMiddleware::requireAdmin();
        $this->publicationsModel = new PublicationsModel();
        $this->membersModel = new MembersModel();
        $this->request = new PublicationRequest();
    }

    public function index()
    {
        if (isset($_GET['ajax'])) {
            header('Content-Type: application/json; charset=utf-8');

            $publications = $this->publicationsModel->all();
            $data = [];

            foreach ($publications as $p) {
                $data[] = [
                    'title' => htmlspecialchars($p['title']),
                    'date' => htmlspecialchars(date('d F Y', strtotime($p['date']))),
                    'member_name' => htmlspecialchars($p['member_name']),
                    'action' => '
                        <div class="btn-group" role="group">
                            <button class="btn btn-sm btn-primary" onclick="showPublications(`' . htmlspecialchars($p['link']) . '`)" title="Show">
                                <i class="fa fa-eye"></i>
                            </button>
                            <button class="btn btn-sm btn-warning" onclick="editPublications(' . intval($p['id']) . ')" title="Edit">
                                <i class="fa fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-danger" onclick="deletePublications(' . intval($p['id']) . ')" title="Hapus">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                    '
                ];
            }

            echo json_encode(['data' => $data]);
            exit;
        }

        $publications = $this->publicationsModel->all();

        return $this->view('cms/anggota_lab/publication/index', [
            'publications' => $publications
        ]);
    }

    public function create()
    {
        $members = $this->membersModel->all();
        return include __DIR__ . '/../Views/cms/anggota_lab/publication/create.php';
    }

    public function store()
    {
        header('Content-Type: application/json; charset=utf-8');

        $data = [
            'title'     => trim($_POST['title'] ?? ''),
            'date'      => $_POST['date'] ?? '',
            'link'      => trim($_POST['link'] ?? ''),
            'member_id' => intval($_POST['member_id'] ?? 0)
        ];

        $errors = $this->request->validateStore($data);

        if (!empty($errors)) {
            echo json_encode([
                'status' => 'error',
                'errors' => $errors
            ]);
            return;
        }

        $this->publicationsModel->create($data['member_id'], $data['title'], $data['date'], $data['link']);

        echo json_encode([
            'status'  => 'success',
            'message' => 'Publikasi berhasil ditambahkan.'
        ]);
    }

    public function edit($id)
    {
        $id = intval($id);
        $publications = $this->publicationsModel->find($id);
        $members = $this->membersModel->all();

        $publications['date'] = date_format(date_create($publications['date']), "Y-m-d");

        return include __DIR__ . '/../Views/cms/anggota_lab/publication/edit.php';
    }

    public function update()
    {
        header('Content-Type: application/json; charset=utf-8');

        $data = [
            'id'        => $_POST['id'] ?? '',
            'title'     => trim($_POST['title'] ?? ''),
            'date'      => $_POST['date'] ?? '',
            'link'      => trim($_POST['link'] ?? ''),
            'member_id' => intval($_POST['member_id'] ?? 0)
        ];

        $errors = $this->request->validateUpdate($data);

        if (!empty($errors)) {
            echo json_encode([
                'status' => 'error',
                'errors' => $errors
            ]);
            return;
        }

        $this->publicationsModel->update($data['id'], $data['member_id'], $data['title'], $data['date'], $data['link']);

        echo json_encode([
            'status'  => 'success',
            'message' => 'Publikasi berhasil diperbarui.'
        ]);
    }

    public function delete($id)
    {
        $id = intval($id);
        if ($id > 0) {
            $this->publicationsModel->delete($id);
        } else {
            http_response_code(400);
            echo "Invalid ID.";
        }
    }
}
