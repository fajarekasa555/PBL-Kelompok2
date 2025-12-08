<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Middleware\AuthMiddleware;
use App\Models\CertificationModel;
use App\Models\MembersModel;

class CertificationController extends Controller
{
    private $certModel;
    private $membersModel;

    public function __construct()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        AuthMiddleware::requireAdmin();
        $this->certModel = new CertificationModel();
        $this->membersModel = new MembersModel();
    }

    public function index()
    {
        $user = $_SESSION['user'] ?? null;
        if (isset($_GET['ajax'])) {
            header('Content-Type: application/json; charset=utf-8');

            $certs = $this->certModel->all();
            $data = [];

            foreach ($certs as $c) {

                // Format periode

                $data[] = [
                    'member_name' => htmlspecialchars($c['member_name'] ?? '-'),
                    'title' => htmlspecialchars($c['title'] ?? '-'),
                    'issuer' => htmlspecialchars($c['issuer'] ?? '-'),
                    'issue_date' => htmlspecialchars(date('d F Y', strtotime($c['issue_date']))),
                    'expiration_date' => htmlspecialchars($c['expiration_date'] ? date('d F Y', strtotime($c['expiration_date'])) : '-'),
                    'action' => '
                        <div class="btn-group">
                            <button class="btn btn-sm btn-warning" onclick="editCertification(' . intval($c['id']) . ')">
                                <i class="fa fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-danger" onclick="deleteCertification(' . intval($c['id']) . ')">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                    '
                ];
            }

            echo json_encode(['data' => $data]);
            exit;
        }

        return $this->view('cms/anggota_lab/certifications/index', [
            'user' => $user
        ]);
    }

    public function create()
    {
        $members = $this->membersModel->all();
        return include __DIR__ . '/../Views/cms/anggota_lab/certifications/create.php';
    }

    public function store()
    {
        $member_id = intval($_POST['member_id'] ?? 0);
        $title = trim($_POST['title'] ?? '');
        $issuer = trim($_POST['issuer'] ?? '');
        $issue_date = $_POST['issue_date'] ?? null;
        $expiration_date = $_POST['expiration_date'] ?? null;
        $credential_id = trim($_POST['credential_id'] ?? '');
        $credential_url = trim($_POST['credential_url'] ?? '');

        if ($member_id > 0 && $title !== '' && $issuer !== '' && $issue_date !== '') {
            $this->certModel->create([
                'member_id' => $member_id,
                'title' => $title,
                'issuer' => $issuer,
                'issue_date' => $issue_date,
                'expiration_date' => $expiration_date,
                'credential_id' => $credential_id,
                'credential_url' => $credential_url
            ]);
        } else {
            http_response_code(400);
            echo "Invalid input data.";
        }
    }

    public function edit($id)
    {
        $id = intval($id);
        $cert = $this->certModel->find($id);
        $members = $this->membersModel->all();
        $cert['issue_date'] = date_format(date_create($cert['issue_date']), "Y-m-d");
        if ($cert['expiration_date']) {
            $cert['expiration_date'] = date_format(date_create($cert['expiration_date']), "Y-m-d");
        }

        return include __DIR__ . '/../Views/cms/anggota_lab/certifications/edit.php';
    }

    public function update()
    {
        $id = intval($_POST['id'] ?? 0);
        $member_id = intval($_POST['member_id'] ?? 0);
        $title = trim($_POST['title'] ?? '');
        $issuer = trim($_POST['issuer'] ?? '');
        $issue_date = $_POST['issue_date'] ?? null;
        $expiration_date = $_POST['expiration_date'] ?? null;
        $credential_id = trim($_POST['credential_id'] ?? '');
        $credential_url = trim($_POST['credential_url'] ?? '');

        if ($id > 0 && $member_id > 0 && $title !== '' && $issuer !== '' && $issue_date !== '') {
            $this->certModel->update($id, [
                'member_id' => $member_id,
                'title' => $title,
                'issuer' => $issuer,
                'issue_date' => $issue_date,
                'expiration_date' => $expiration_date,
                'credential_id' => $credential_id,
                'credential_url' => $credential_url
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
            $this->certModel->delete($id);
        } else {
            http_response_code(400);
            echo "Invalid ID.";
        }
    }
}
