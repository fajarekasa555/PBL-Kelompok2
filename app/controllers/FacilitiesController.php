<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Middleware\AuthMiddleware;
use App\Models\FacilitiesModel;
use App\Requests\FacilityRequest;
use PDOException;

class FacilitiesController extends Controller
{
    private $facilitiesModel;
    private $request;

    public function __construct()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        AuthMiddleware::requireAdmin();

        $this->facilitiesModel = new FacilitiesModel();
        $this->request = new FacilityRequest();
    }

    public function index()
    {
        if (isset($_GET['ajax'])) {
            header('Content-Type: application/json; charset=utf-8');

            $facilities = $this->facilitiesModel->all();
            $data = [];

            foreach ($facilities as $f) {
                $data[] = [
                    'slug' => htmlspecialchars($f['slug']),
                    'description' => htmlspecialchars($f['description']),
                    'action' => '
                        <div class="btn-group" role="group">
                            <button class="btn btn-sm btn-info" onclick="showFacility(' . intval($f['id']) . ')" title="Detail">
                                <i class="fa fa-eye"></i>
                            </button>
                            <button class="btn btn-sm btn-warning" onclick="editFacility(' . intval($f['id']) . ')" title="Edit">
                                <i class="fa fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-danger" onclick="deleteFacility(' . intval($f['id']) . ')" title="Hapus">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>'
                ];
            }

            echo json_encode(['data' => $data]);
            exit;
        }

        return $this->view('cms/content/facilities/index');
    }

    public function show($id)
    {
        $facility = $this->facilitiesModel->findOrFail($id);
        return include __DIR__ . '/../Views/cms/content/facilities/view.php';
    }

    public function create()
    {
        return include __DIR__ . '/../Views/cms/content/facilities/create.php';
    }

    public function store()
    {
        header('Content-Type: application/json; charset=utf-8');

        try {
            $db = $this->facilitiesModel->getConnection();
            $db->beginTransaction();

            $data = [
                'slug' => trim($_POST['slug'] ?? ''),
                'description' => trim($_POST['description'] ?? ''),
                'image' => ''
            ];

            $errors = $this->request->validate($data);

            if (!empty($errors)) {
                throw new \Exception(json_encode([
                    'status' => 'error',
                    'message' => 'Validasi gagal.',
                    'errors' => $errors
                ]));
            }

            if (!empty($_FILES['image']['name'])) {
                $this->validateFile($_FILES['image']['type']);

                $uploadDir = __DIR__ . '/../../public/uploads/facilities/';
                if (!file_exists($uploadDir)) mkdir($uploadDir, 0777, true);

                $filename = time() . '_' . basename($_FILES['image']['name']);
                $targetFile = $uploadDir . $filename;

                if (!move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                    throw new \Exception(json_encode([
                        'status' => 'error',
                        'message' => 'Gagal mengupload file.'
                    ]));
                }

                $data['image'] = 'uploads/facilities/' . $filename;
            }

            $this->facilitiesModel->create($data['slug'], $data['description'], $data['image']);

            $db->commit();

            echo json_encode([
                'status' => 'success',
                'message' => 'Fasilitas berhasil ditambahkan.'
            ]);

        } catch (\Exception $e) {
            if ($db->inTransaction()) $db->rollback();

            $msg = $e->getMessage();
            if ($this->isJson($msg)) {
                echo $msg;
            } else {
                echo json_encode([
                    'status' => 'error',
                    'message' => $msg
                ]);
            }
        }
    }

    public function edit($id)
    {
        $facility = $this->facilitiesModel->findOrFail($id);
        return include __DIR__ . '/../Views/cms/content/facilities/edit.php';
    }

    public function update()
    {
        header('Content-Type: application/json; charset=utf-8');

        try {
            $db = $this->facilitiesModel->getConnection();
            $db->beginTransaction();

            $id = intval($_POST['id']);
            $old = $this->facilitiesModel->findOrFail($id);
            $image = $old['image'];

            $data = [
                'slug' => trim($_POST['slug'] ?? ''),
                'description' => trim($_POST['description'] ?? ''),
                'image' => $image
            ];

            $errors = $this->request->validate($data);

            if (!empty($errors)) {
                throw new \Exception(json_encode([
                    'status' => 'error',
                    'message' => 'Validasi gagal.',
                    'errors' => $errors
                ]));
            }

            if (!empty($_FILES['image']['name'])) {
                $this->validateFile($_FILES['image']['type']);

                $uploadDir = __DIR__ . '/../../public/uploads/facilities/';
                if (!file_exists($uploadDir)) mkdir($uploadDir, 0777, true);

                $filename = time() . '_' . basename($_FILES['image']['name']);
                $targetFile = $uploadDir . $filename;

                if (!move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                    throw new \Exception(json_encode([
                        'status' => 'error',
                        'message' => 'Gagal mengupload file.'
                    ]));
                }

                if ($image && file_exists(__DIR__ . '/../../../public/' . $image)) {
                    unlink(__DIR__ . '/../../../public/' . $image);
                }

                $data['image'] = 'uploads/facilities/' . $filename;
            }

            $this->facilitiesModel->update($id, $data['slug'], $data['description'], $data['image']);

            $db->commit();

            echo json_encode([
                'status' => 'success',
                'message' => 'Fasilitas berhasil diperbarui.'
            ]);

        } catch (\Exception $e) {
            if ($db->inTransaction()) $db->rollback();

            $msg = $e->getMessage();
            if ($this->isJson($msg)) {
                echo $msg;
            } else {
                echo json_encode([
                    'status' => 'error',
                    'message' => $msg
                ]);
            }
        }
    }

    public function delete($id)
    {
        try {
            $db = $this->facilitiesModel->getConnection();
            $db->beginTransaction();

            $facility = $this->facilitiesModel->findOrFail($id);

            if (!empty($facility['image'])) {
                $filePath = __DIR__ . '/../../../public/' . $facility['image'];
                if (file_exists($filePath)) unlink($filePath);
            }

            $this->facilitiesModel->delete($id);

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
        $allowed = ['image/jpeg', 'image/png', 'image/webp'];
        if (!in_array($mime, $allowed)) {
            throw new \Exception("File tidak diizinkan. Hanya JPG, PNG, WEBP.");
        }
    }

    private function isJson($string)
    {
        json_decode($string);
        return (json_last_error() === JSON_ERROR_NONE);
    }
}
