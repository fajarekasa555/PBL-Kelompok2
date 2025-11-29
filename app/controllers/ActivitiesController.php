<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Middleware\AuthMiddleware;
use App\Models\ActivitiesModel;
use App\Models\MembersModel;
use App\Models\ActivityMemberModel;
use App\Requests\ActivityRequest;
use PDOException;

class ActivitiesController extends Controller
{
    private $activitiesModel;
    private $memberModel;
    private $activityMembersModel;
    private $requet;

    public function __construct()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        AuthMiddleware::requireAdmin();

        $this->activitiesModel = new ActivitiesModel();
        $this->memberModel = new MembersModel();
        $this->activityMembersModel = new ActivityMemberModel();
        $this->requet = new ActivityRequest();
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
        $members = $this->activityMembersModel->getDetailedMembersByActivity($id);

        return include __DIR__ . '/../Views/cms/content/activities/view.php';
    }

    public function create()
    {
        $allMembers = $this->memberModel->all();
        return include __DIR__ . '/../Views/cms/content/activities/create.php';
    }

    public function store()
    {
        header('Content-Type: application/json; charset=utf-8');

        try {
            $db = $this->activitiesModel->getConnection();
            $db->beginTransaction();

            $data = [
                'title'        => trim($_POST['title'] ?? ''),
                'date'         => trim($_POST['date'] ?? ''),
                'location'     => trim($_POST['location'] ?? ''),
                'description'  => trim($_POST['description'] ?? ''),
                'documentation' => ''
            ];

            $validator = new ActivityRequest();
            $errors = $validator->validate($data, false);

            if (!empty($errors)) {
                throw new \Exception(json_encode([
                    'status'  => 'error',
                    'message' => 'Validasi gagal.',
                    'errors'  => $errors
                ]));
            }

            if (!empty($_FILES['documentation']['name'])) {
                $this->validateFile($_FILES['documentation']['type']);

                $uploadDir = __DIR__ . '/../../public/uploads/activities/';
                if (!file_exists($uploadDir)) mkdir($uploadDir, 0777, true);

                $filename = time() . '_' . basename($_FILES['documentation']['name']);
                $targetFile = $uploadDir . $filename;

                if (!move_uploaded_file($_FILES['documentation']['tmp_name'], $targetFile)) {
                    throw new \Exception(json_encode([
                        'status'  => 'error',
                        'message' => 'Gagal mengupload file.'
                    ]));
                }

                $data['documentation'] = 'uploads/activities/' . $filename;
            }

            $members = $_POST['members'] ?? [];
            $membersFormatted = [];

            foreach ($members as $m) {
                $membersFormatted[] = [
                    'member_id' => (int)$m,
                    'role'      => null
                ];
            }

            $this->activitiesModel->createWithMembers(
                $data['title'],
                $data['description'],
                $data['location'],
                $data['date'],
                $data['documentation'],
                $membersFormatted
            );

            $db->commit();

            echo json_encode([
                'status'  => 'success',
                'message' => 'Kegiatan berhasil ditambahkan.'
            ]);
            return;

        } catch (\Exception $e) {

            if ($db->inTransaction()) $db->rollback();

            $msg = $e->getMessage();

            if ($this->isJson($msg)) {
                echo $msg;
            } else {
                echo json_encode([
                    'status'  => 'error',
                    'message' => $msg
                ]);
            }
        }
    }

    private function isJson($string)
    {
        json_decode($string);
        return (json_last_error() === JSON_ERROR_NONE);
    }


    public function edit($id)
    {
        $allMembers = $this->memberModel->all();
        $activity = $this->activitiesModel->findOrFail($id);
        $activityMembers = $this->activityMembersModel->getMembersByActivity($id);
        $activityMembers = array_column($activityMembers, 'member_id');
        
        return include __DIR__ . '/../Views/cms/content/activities/edit.php';
    }

    public function update()
    {
        header('Content-Type: application/json; charset=utf-8');

        try {
            $db = $this->activitiesModel->getConnection();
            $db->beginTransaction();

            $id = intval($_POST['id']);
            $old = $this->activitiesModel->findOrFail($id);
            $documentation = $old['documentation'];

            $data = [
                'title'        => trim($_POST['title'] ?? ''),
                'date'         => trim($_POST['date'] ?? ''),
                'location'     => trim($_POST['location'] ?? ''),
                'description'  => trim($_POST['description'] ?? ''),
                'documentation'=> $documentation
            ];

            $validator = new ActivityRequest();
            $errors = $validator->validate($data, true);

            if (!empty($errors)) {
                throw new \Exception(json_encode([
                    'status'  => 'error',
                    'message' => 'Validasi gagal.',
                    'errors'  => $errors
                ]));
            }

            if (!empty($_FILES['documentation']['name'])) {
                $this->validateFile($_FILES['documentation']['type']);

                $uploadDir = __DIR__ . '/../../public/uploads/activities/';
                if (!file_exists($uploadDir)) mkdir($uploadDir, 0777, true);

                $filename = time() . '_' . basename($_FILES['documentation']['name']);
                $targetFile = $uploadDir . $filename;

                if (!move_uploaded_file($_FILES['documentation']['tmp_name'], $targetFile)) {
                    throw new \Exception(json_encode([
                        'status'  => 'error',
                        'message' => 'Gagal mengupload file.'
                    ]));
                }

                $data['documentation'] = 'uploads/activities/' . $filename;
            }

            $this->activitiesModel->update(
                $id,
                $data['title'],
                $data['description'],
                $data['location'],
                $data['date'],
                $data['documentation']
            );

            $this->activityMembersModel->deleteByActivity($id);
            $this->activityMembersModel->insertMany($id, $_POST['members'] ?? []);

            $db->commit();

            echo json_encode([
                'status'  => 'success',
                'message' => 'Kegiatan berhasil diperbarui.'
            ]);
            return;

        } catch (\Exception $e) {
            if ($db->inTransaction()) $db->rollback();

            $msg = $e->getMessage();
            if ($this->isJson($msg)) {
                echo $msg;
            } else {
                echo json_encode([
                    'status'  => 'error',
                    'message' => $msg
                ]);
            }
        }
    }

    public function delete($id)
    {
        try {
            $db = $this->activitiesModel->getConnection();
            $db->beginTransaction();

            $activity = $this->activitiesModel->findOrFail($id);

            if (!empty($activity['documentation'])) {
                $filePath = __DIR__ . '/../../../public/' . $activity['documentation'];
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }

            $this->activityMembersModel->deleteByActivity($id);
            $this->activitiesModel->delete($id);

            $db->commit();
            echo "OK";

        } catch (PDOException $e) {
            $db->rollback();
            http_response_code(500);
            echo "Database error: " . $e->getMessage();
        } catch (\Exception $e) {
            if ($db->inTransaction()) $db->rollback();
            http_response_code(400);
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
