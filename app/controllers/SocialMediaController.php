<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Middleware\AuthMiddleware;
use App\Models\MembersModel;
use App\Models\SocialMediaModel;

class SocialMediaController extends Controller
{
    private $socialMediaModel;
    private $membersModel;

    public function __construct()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        AuthMiddleware::requireAdmin();
        $this->socialMediaModel = new SocialMediaModel();
        $this->membersModel = new MembersModel();
    }

    public function index()
    {
        if (isset($_GET['ajax'])) {
            header('Content-Type: application/json; charset=utf-8');

            $social_media = $this->socialMediaModel->all();
            $data = [];

            foreach ($social_media as $p) {
                $data[] = [
                    'icon' => '<i class="' . htmlspecialchars($p['icon']) . ' fa-lg"></i>',
                    'platform' => htmlspecialchars($p['platform']),
                    'member_name' => htmlspecialchars($p['member_name']),
                    'action' => '
                        <div class="btn-group" role="group">
                            <button class="btn btn-sm btn-primary" onclick="showSocialmedia(`' . htmlspecialchars($p['url']) . '`)" title="Show">
                                <i class="fa fa-eye"></i>
                            </button>
                            <button class="btn btn-sm btn-warning" onclick="editSocialMedia(' . intval($p['id']) . ')" title="Edit">
                                <i class="fa fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-danger" onclick="deleteSocialMedia(' . intval($p['id']) . ')" title="Hapus">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                    '
                ];
            }

            echo json_encode(['data' => $data]);
            exit;
        }

        $social_media = $this->socialMediaModel->all();

        return $this->view('cms/anggota_lab/social_media/index', [
            'social_media' => $social_media
        ]);
    }

    public function create()
    {
        $members = $this->membersModel->all();
        return include __DIR__ . '/../Views/cms/anggota_lab/social_media/create.php';
    }

    public function store()
    {
        $member_id = intval($_POST['member_id'] ?? 0);
        $platform  = trim($_POST['platform'] ?? '');
        $icon      = trim($_POST['icon'] ?? '');
        $url       = trim($_POST['url'] ?? '');

        if ($member_id > 0 && $platform !== '' && $url !== '') {
            $this->socialMediaModel->create($member_id, $platform, $icon, $url);
            echo "success";
        } else {
            http_response_code(400);
            echo "Invalid input data.";
        }
    }

    public function edit($id)
    {
        $id = intval($id);
        $social_media = $this->socialMediaModel->find($id);
        $members = $this->membersModel->all();

        return include __DIR__ . '/../Views/cms/anggota_lab/social_media/edit.php';
    }

    public function update()
    {
        $id = intval($_POST['id'] ?? 0);
        $member_id = intval($_POST['member_id'] ?? 0);
        $platform  = trim($_POST['platform'] ?? '');
        $icon      = trim($_POST['icon'] ?? '');
        $url       = trim($_POST['url'] ?? '');

        if ($id > 0 && $member_id > 0 && $platform !== '' && $url !== '') {
            $this->socialMediaModel->update($id, $member_id, $platform, $icon, $url);
            echo "success";
        } else {
            http_response_code(400);
            echo "Invalid input data.";
        }
    }

    public function delete($id)
    {
        $id = intval($id);
        if ($id > 0) {
            $this->socialMediaModel->delete($id);
            echo "success";
        } else {
            http_response_code(400);
            echo "Invalid ID.";
        }
    }
}
