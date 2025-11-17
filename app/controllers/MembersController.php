<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Middleware\AuthMiddleware;
use App\Models\MembersModel;
use App\Models\ExpertiesModel;
use App\Models\MemberExpertisesModel;

class MembersController extends Controller
{
    private $membersModel;
    private $expertiesModel;
    private $memberExpertisesModel;

    public function __construct()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        AuthMiddleware::requireAdmin();

        $this->membersModel = new MembersModel();
        $this->expertiesModel = new ExpertiesModel();
        $this->memberExpertisesModel = new MemberExpertisesModel();
    }

    public function index()
    {
        if (isset($_GET['ajax'])) {
            header('Content-Type: application/json; charset=utf-8');

            $members = $this->membersModel->all();
            $data = [];

            foreach ($members as $m) {
                $data[] = [
                    'name' => htmlspecialchars($m['name']),
                    'jabatan' => htmlspecialchars($m['jabatan']),
                    'email' => htmlspecialchars($m['email']),
                    'phone' => htmlspecialchars($m['phone']),
                    'action' => '
                        <div class="btn-group" role="group">
                            <button class="btn btn-sm btn-info" onclick="showMember(' . intval($m['id']) . ')" title="Detail">
                                <i class="fa fa-eye"></i>
                            </button>
                            <button class="btn btn-sm btn-warning" onclick="editMember(' . intval($m['id']) . ')" title="Edit">
                                <i class="fa fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-danger" onclick="deleteMember(' . intval($m['id']) . ')" title="Hapus">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>'
                ];
            }

            echo json_encode(['data' => $data]);
            exit;
        }

        return $this->view('cms/anggota_lab/members/index');
    }

    public function show($id)
    {
        $member = $this->membersModel->findOrFail($id);
        $expertises = $this->memberExpertisesModel->getExpertisesByMember($id);

        return include __DIR__ . '/../Views/cms/anggota_lab/members/view.php';
    }

    public function create()
    {
        $allExpertises = $this->expertiesModel->all();
        return include __DIR__ . '/../Views/cms/anggota_lab/members/create.php';
    }

    public function store()
    {
        $data = [
            'nip' => trim($_POST['nip'] ?? ''),
            'nidn' => trim($_POST['nidn'] ?? ''),
            'name' => trim($_POST['name'] ?? ''),
            'title_prefix' => trim($_POST['title_prefix'] ?? ''),
            'title_suffix' => trim($_POST['title_suffix'] ?? ''),
            'program_studi' => trim($_POST['program_studi'] ?? ''),
            'jabatan' => trim($_POST['jabatan'] ?? ''),
            'email' => trim($_POST['email'] ?? ''),
            'phone' => trim($_POST['phone'] ?? ''),
            'address' => trim($_POST['address'] ?? ''),
            'photo' => ''
        ];

        $expertises = $_POST['expertises'] ?? [];

        if ($data['name'] === '' || $data['jabatan'] === '') {
            http_response_code(400);
            echo "Nama dan jabatan wajib diisi.";
            exit;
        }

        // Upload Foto
        if (!empty($_FILES['photo']['name'])) {
            $uploadDir = __DIR__ . '/../../public/uploads/members/';
            if (!file_exists($uploadDir)) mkdir($uploadDir, 0777, true);

            $filename = time() . '_' . basename($_FILES['photo']['name']);
            $targetFile = $uploadDir . $filename;

            if (move_uploaded_file($_FILES['photo']['tmp_name'], $targetFile)) {
                $data['photo'] = 'uploads/members/' . $filename;
            }
        }

        // Insert anggota
        $memberId = $this->membersModel->create($data);

        // Insert expertises
        if ($memberId && !empty($expertises)) {
            $this->memberExpertisesModel->insertMany($memberId, $expertises);
        }

        echo "OK";
    }

    public function edit($id)
    {
        $members = $this->membersModel->findOrFail($id);
        $allExpertises = $this->expertiesModel->all();
        $memberExpertises = $this->memberExpertisesModel->getByMember($id);

        return include __DIR__ . '/../Views/cms/anggota_lab/members/edit.php';
    }

    public function update()
    {
        $id = intval($_POST['id']);
        $old = $this->membersModel->findOrFail($id);

        $data = [
            'nip' => trim($_POST['nip'] ?? ''),
            'nidn' => trim($_POST['nidn'] ?? ''),
            'name' => trim($_POST['name'] ?? ''),
            'title_prefix' => trim($_POST['title_prefix'] ?? ''),
            'title_suffix' => trim($_POST['title_suffix'] ?? ''),
            'program_studi' => trim($_POST['program_studi'] ?? ''),
            'jabatan' => trim($_POST['jabatan'] ?? ''),
            'email' => trim($_POST['email'] ?? ''),
            'phone' => trim($_POST['phone'] ?? ''),
            'address' => trim($_POST['address'] ?? ''),
            'photo' => $old['photo']
        ];

        $expertises = $_POST['expertises'] ?? [];

        if (!empty($_FILES['photo']['name'])) {
            $uploadDir = __DIR__ . '/../../public/uploads/members/';
            if (!file_exists($uploadDir)) mkdir($uploadDir, 0777, true);

            $filename = time() . '_' . basename($_FILES['photo']['name']);
            $targetFile = $uploadDir . $filename;

            if (move_uploaded_file($_FILES['photo']['tmp_name'], $targetFile)) {
                $data['photo'] = 'uploads/members/' . $filename;
            }
        }

        $this->membersModel->update($id, $data);

        $this->memberExpertisesModel->deleteByMember($id);

        if (!empty($expertises)) {
            $this->memberExpertisesModel->insertMany($id, $expertises);
        }

        echo "OK";
    }

    public function delete($id)
    {
        $id = intval($id);
        $member = $this->membersModel->findOrFail($id);

        if (!$member) {
            http_response_code(404);
            echo "Data tidak ditemukan";
            exit;
        }

        // Hapus foto
        if (!empty($member['photo']) && file_exists(__DIR__ . '/../../../public/' . $member['photo'])) {
            unlink(__DIR__ . '/../../../public/' . $member['photo']);
        }

        // Hapus relasi expertises
        $this->memberExpertisesModel->deleteByMember($id);

        // Hapus member
        $this->membersModel->delete($id);

        echo "OK";
    }
}
