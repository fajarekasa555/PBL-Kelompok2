<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Middleware\AuthMiddleware;
use App\Models\MemberStudentModel;
use App\Helpers\ViewHelper;
use App\Helpers\MailHelper;

class MemberStudentController extends Controller
{
    private $studentModel;

    public function __construct()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        AuthMiddleware::requireAdmin();

        $this->studentModel = new MemberStudentModel();
    }

    public function index($filter = 'pending')
    {
        $user = $_SESSION['user'] ?? null;

        if (isset($_GET['ajax'])) {

            header('Content-Type: application/json; charset=utf-8');


            if ($filter === 'pending') {
                $students = $this->studentModel->pending();
            } else {
                $students = $this->studentModel->approved();
            }

            $data = [];
            foreach ($students as $s) {

                $badge = match ($s['status']) {
                    'approved' => '<span class="badge bg-success">Approved</span>',
                    'rejected' => '<span class="badge bg-danger">Rejected</span>',
                    default    => '<span class="badge bg-secondary">Pending</span>'
                };

                $action = ($filter === 'pending')
                    ? ($s['status'] === 'pending' ? 
                        '
                        <div class="btn-group">
                            <button class="btn btn-sm btn-info" onclick="showStudent('.$s['id'].')">
                                <i class="fa fa-eye"></i>
                            </button>
                            <button class="btn btn-sm btn-success" onclick="approveStudent('.$s['id'].')">
                                <i class="fa fa-check"></i>
                            </button>
                            <button class="btn btn-sm btn-danger" onclick="rejectStudent('.$s['id'].')">
                                <i class="fa fa-times"></i>
                            </button>
                        </div>' 
                        : 
                        ' <div class="btn-group">
                            <button class="btn btn-sm btn-info" onclick="showStudent('.$s['id'].')">
                                <i class="fa fa-eye"></i>
                            </button>
                        </div>'
                        )
                    : '
                        <div class="btn-group">
                            <button class="btn btn-sm btn-info" onclick="showStudent('.$s['id'].')">
                                <i class="fa fa-eye"></i>
                            </button>
                            <button class="btn btn-sm btn-warning" onclick="deleteStudent('.$s['id'].')">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>';

                $data[] = [
                    'nim'    => htmlspecialchars($s['nim']),
                    'name'   => htmlspecialchars($s['name']),
                    'prodi'  => htmlspecialchars($s['program_studi']),
                    'status' => $badge,
                    'action' => $action
                ];
            }

            echo json_encode([ 'data' => $data ]);
            exit;
        }

        return $this->view($filter === 'pending' ? 'cms/approval/index' : 'cms/anggota_lab/mahasiswa/index', [
            'user'   => $user,
            'filter' => $filter
        ]);
    }


    public function show($id)
    {
        $student = $this->studentModel->findOrFail($id);

        return include __DIR__ . '/../Views/cms/anggota_lab/mahasiswa/view.php';
    }

    public function approve($id)
    {
        header('Content-Type: application/json; charset=utf-8');

        try {
            $adminId = $_SESSION['user']['id'] ?? null;
            $note = htmlspecialchars($_POST['note'] ?? '', ENT_QUOTES);

            // Update status mahasiswa
            $this->studentModel->approve($id, $adminId, 'approved', $note);

            // Ambil data mahasiswa
            $student = $this->studentModel->find($id);

            if (!$student || empty($student['email'])) {
                throw new \Exception("Email mahasiswa tidak ditemukan.");
            }

            // Render template email
            $html = ViewHelper::renderEmail('approved', [
                'name' => $student['name'],
                'note' => $note
            ]);

            // Kirim email
            $emailStatus = MailHelper::sendMail(
                $student['email'],
                "Pendaftaran Anda Disetujui",
                $html
            );

            if ($emailStatus !== true) {
                throw new \Exception("Gagal mengirim email: " . $emailStatus);
            }

            echo json_encode(['status' => 'success']);

        } catch (\Throwable $e) {
            echo json_encode([
                'status'  => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }


    public function reject($id)
    {
        header('Content-Type: application/json; charset=utf-8');

        try {
            $adminId = $_SESSION['user']['id'] ?? null;
            $note = htmlspecialchars($_POST['note'] ?? '', ENT_QUOTES);

            $this->studentModel->approve($id, $adminId, 'rejected', $note);

            $student = $this->studentModel->find($id);

            if (!$student || empty($student['email'])) {
                throw new \Exception("Email mahasiswa tidak ditemukan.");
            }

            $html = ViewHelper::renderEmail('rejected', [
                'name' => $student['name'],
                'note' => $note
            ]);

            $emailStatus = MailHelper::sendMail(
                $student['email'],
                "Pendaftaran Anda Ditolak",
                $html
            );

            if ($emailStatus !== true) {
                throw new \Exception("Gagal mengirim email: " . $emailStatus);
            }

            echo json_encode(['status' => 'success']);

        } catch (\Throwable $e) {
            echo json_encode([
                'status'  => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function destroy($id)
    {
        header('Content-Type: application/json; charset=utf-8');

        try {
            $this->studentModel->delete($id);

            echo json_encode([
                'status'  => 'success',
                'message' => 'Data berhasil dihapus.'
            ]);

        } catch (\Throwable $e) {
            echo json_encode([
                'status'  => 'error',
                'message' => 'Gagal menghapus data: ' . $e->getMessage()
            ]);
        }
    }
}

