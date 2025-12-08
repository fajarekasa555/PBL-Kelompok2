<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Middleware\AuthMiddleware;
use App\Models\LabInformationModel;
use PDOException;

class LabInformationController extends Controller
{
    private $labInfo;

    public function __construct()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        AuthMiddleware::requireAdmin();
        $this->labInfo = new LabInformationModel();
    }

    public function index()
    {
        $user = $_SESSION['user'] ?? null;
        if (isset($_GET['ajax'])) {
            header('Content-Type: application/json; charset=utf-8');

            $rows = $this->labInfo->all();
            $data = [];

            foreach ($rows as $r) {
                $data[] = [
                    'id'      => intval($r['id']),
                    'key'     => htmlspecialchars($r['key']),
                    'value'   => nl2br(htmlspecialchars($r['value'])),
                    'action'  => '
                        <button class="btn btn-warning btn-sm" onclick="editRow('.intval($r['id']).')" title="Edit">
                            <i class="fa fa-edit"></i>
                        </button>
                        <button class="btn btn-danger btn-sm" onclick="deleteRow('.intval($r['id']).')" title="Hapus">
                            <i class="fa fa-trash"></i>
                        </button>
                    '
                ];
            }

            echo json_encode(['data' => $data]);
            exit;
        }

        return $this->view('cms/lab_information/index', [
            'user' => $user
        ]);
    }


    public function store()
    {
        try {
            $db = $this->labInfo->getConnection();
            $db->beginTransaction();

            $key  = trim($_POST['key'] ?? '');
            $value = trim($_POST['value'] ?? '');

            if ($key === '' || $value === '') {
                throw new \Exception("Key dan value wajib diisi.");
            }

            $this->labInfo->create($key, $value);

            $db->commit();
            echo "OK";

        } catch (PDOException $e) {
            if ($db->inTransaction()) $db->rollback();
            http_response_code(500);
            echo "Database error: " . $e->getMessage();

        } catch (\Exception $e) {
            if ($db->inTransaction()) $db->rollback();
            http_response_code(400);
            echo $e->getMessage();
        }
    }

    public function edit($id)
    {
        header('Content-Type: application/json');

        $row = $this->labInfo->find($id);

        if (!$row) {
            echo json_encode([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ]);
            return;
        }

        echo json_encode([
            'success' => true,
            'data' => $row
        ]);
    }

    public function update($id)
    {
        try {
            $db = $this->labInfo->getConnection();
            $db->beginTransaction();

            $key   = trim($_POST['key'] ?? '');
            $value = trim($_POST['value'] ?? '');

            if ($key === '' || $value === '') {
                throw new \Exception("Key dan value wajib diisi.");
            }

            $this->labInfo->update($id, $key, $value);

            $db->commit();
            echo json_encode(['success' => true]);

        } catch (\Exception $e) {

            if ($db->inTransaction()) $db->rollback();
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function delete($id)
    {
        try {
            $db = $this->labInfo->getConnection();
            $db->beginTransaction();

            $this->labInfo->delete($id);

            $db->commit();
            echo "OK";

        } catch (PDOException $e) {
            if ($db->inTransaction()) $db->rollback();
            http_response_code(500);
            echo "Database error: " . $e->getMessage();

        } catch (\Exception $e) {
            if ($db->inTransaction()) $db->rollback();
            http_response_code(400);
            echo $e->getMessage();
        }
    }
}

