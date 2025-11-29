<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Middleware\AuthMiddleware;
use App\Models\MembersModel;
use App\Models\ExpertiesModel;
use App\Models\MemberExpertisesModel;
use App\Requests\MemberRequest;

class MembersController extends Controller
{
    private $membersModel;
    private $expertiesModel;
    private $memberExpertisesModel;
    private $requestValidator;

    public function __construct()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        AuthMiddleware::requireAdmin();

        $this->membersModel = new MembersModel();
        $this->expertiesModel = new ExpertiesModel();
        $this->memberExpertisesModel = new MemberExpertisesModel();
        $this->requestValidator = new MemberRequest();
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
        $social = $this->membersModel->getSocialMedia($id);
        $education = $this->membersModel->getEducations($id);
        $courses = $this->membersModel->getCourses($id);
        $certifications = $this->membersModel->getCertifications($id);

        return include __DIR__ . '/../Views/cms/anggota_lab/members/view.php';
    }

    public function create()
    {
        $allExpertises = $this->expertiesModel->all();
        return $this->view('cms/anggota_lab/members/create', ['allExpertises' => $allExpertises]);
    }

    public function store()
    {
        header('Content-Type: application/json; charset=utf-8');
        try {

            $data = [
                'nip'           => trim($_POST['nip'] ?? ''),
                'nidn'          => trim($_POST['nidn'] ?? ''),
                'name'          => trim($_POST['name'] ?? ''),
                'title_prefix'  => trim($_POST['title_prefix'] ?? ''),
                'title_suffix'  => trim($_POST['title_suffix'] ?? ''),
                'program_studi' => trim($_POST['program_studi'] ?? ''),
                'jabatan'       => trim($_POST['jabatan'] ?? ''),
                'email'         => trim($_POST['email'] ?? ''),
                'phone'         => trim($_POST['phone'] ?? ''),
                'address'       => trim($_POST['address'] ?? ''),
                'photo'         => ''
            ];

            $errors = $this->requestValidator->validate($data);

            if (!empty($errors)) {
                http_response_code(422);
                echo json_encode([
                    'status' => 'error',
                    'errors' => $errors
                ]);
                return;
            }

            if ($data['name'] === '' || $data['jabatan'] === '' || $data['email'] === '') {
                http_response_code(400);
                echo json_encode([
                    'status'  => 'error',
                    'message' => 'Nama, jabatan, dan email wajib diisi.'
                ]);
                return;
            }

            if (!empty($_FILES['photo']['name'])) {
                $uploadDir = __DIR__ . '/../../public/uploads/members/';
                if (!file_exists($uploadDir)) mkdir($uploadDir, 0777, true);

                $filename = time() . '_' . basename($_FILES['photo']['name']);
                $targetFile = $uploadDir . $filename;

                if (move_uploaded_file($_FILES['photo']['tmp_name'], $targetFile)) {
                    $data['photo'] = 'uploads/members/' . $filename;
                }
            }

            $social    = $this->prepareSocialMediaData($_POST['social'] ?? []);
            $education = $this->prepareEducationData($_POST['edu'] ?? []);
            $courses   = $this->prepareCoursesData($_POST['course'] ?? []);
            $cert      = $this->prepareCertificationsData($_POST['cert'] ?? []);

            $data['soc_platform'] = $social['platforms'] ?? [];
            $data['soc_icon']     = $social['icons'] ?? [];
            $data['soc_url']      = $social['urls'] ?? [];

            $data['degree']      = $education['degrees'] ?? [];
            $data['major']       = $education['majors'] ?? [];
            $data['institution'] = $education['institutions'] ?? [];
            $data['start_year']  = $education['start_years'] ?? [];
            $data['end_year']    = $education['end_years'] ?? [];

            $data['course_name'] = $courses['course_names'] ?? [];
            $data['semester']    = $courses['semesters'] ?? [];

            $data['cert_title']      = $cert['titles'] ?? [];
            $data['cert_issuer']     = $cert['issuers'] ?? [];
            $data['cert_issue_date'] = $cert['issue_dates'] ?? [];
            $data['cert_exp_date']   = $cert['expiration_dates'] ?? [];
            $data['cred_id']         = $cert['credential_ids'] ?? [];
            $data['cred_url']        = $cert['credential_urls'] ?? [];

            $memberId = $this->membersModel->createWithStoredProcedure($data);

            $expertises = $_POST['expertises'] ?? [];
            if ($memberId && !empty($expertises)) {
                $this->memberExpertisesModel->insertMany($memberId, $expertises);
            }

            echo json_encode([
                'status'    => 'success',
                'message'   => 'Anggota berhasil ditambahkan.',
                'member_id' => $memberId
            ]);

        } catch (\Throwable $e) {
            http_response_code(500);
            echo json_encode([
                'status'  => 'error',
                'message' => 'Gagal menambahkan anggota: ' . $e->getMessage()
            ]);
        }
    }

    private function prepareSocialMediaData($socialData)
    {
        if (empty($socialData['platform'])) {
            return ['platforms' => [], 'icons' => [], 'urls' => []];
        }

        $platforms = [];
        $icons = [];
        $urls = [];

        foreach ($socialData['platform'] as $index => $platform) {
            if (!empty($platform) && !empty($socialData['url'][$index])) {
                $platforms[] = $platform;
                $icons[] = $socialData['icon'][$index] ?? '';
                $urls[] = $socialData['url'][$index];
            }
        }

        return [
            'platforms' => $platforms,
            'icons' => $icons,
            'urls' => $urls
        ];
    }

    private function prepareEducationData($eduData)
    {
        if (empty($eduData['degree'])) {
            return ['degrees' => [], 'majors' => [], 'institutions' => [], 'strart_years' => [], 'end_years' => []];
        }

        $degrees = [];
        $majors = [];
        $institutions = [];
        $startYears = [];
        $endYears = [];

        foreach ($eduData['degree'] as $index => $degree) {
            if (!empty($degree) && !empty($eduData['major'][$index]) && !empty($eduData['institution'][$index])) {
                $degrees[] = $degree;
                $majors[] = $eduData['major'][$index];
                $institutions[] = $eduData['institution'][$index];
                $startYears[] = !empty($eduData['start_year'][$index]) ? (int)$eduData['start_year'][$index] : null;
                $endYears[] = !empty($eduData['end_year'][$index]) ? (int)$eduData['end_year'][$index] : null;
            }
        }

        return [
            'degrees' => $degrees,
            'majors' => $majors,
            'institutions' => $institutions,
            'start_years' => $startYears,
            'end_years' => $endYears
        ];
    }

    private function prepareCoursesData($courseData)
    {
        if (empty($courseData['course_name'])) {
            return ['course_names' => [], 'semesters' => [], 'codes' => [], 'credits' => []];
        }

        $courseNames = [];
        $semesters = [];
        $codes = [];
        $credits = [];

        foreach ($courseData['course_name'] as $index => $courseName) {
            if (!empty($courseName) && !empty($courseData['semester'][$index])) {
                $courseNames[] = $courseName;
                $semesters[] = $courseData['semester'][$index];
                $codes[] = $courseData['course_code'][$index] ?? '';
                $credits[] = !empty($courseData['credits'][$index]) ? (int)$courseData['credits'][$index] : null;
            }
        }

        return [
            'course_names' => $courseNames,
            'semesters' => $semesters,
            'codes' => $codes,
            'credits' => $credits
        ];
    }

    private function prepareCertificationsData($certData)
    {
        if (empty($certData['title'])) {
            return ['titles' => [], 'issuers' => [], 'issue_dates' => [], 'expiration_dates' => [], 'credential_ids' => [], 'credential_urls' => []];
        }

        $titles = [];
        $issuers = [];
        $issueDates = [];
        $expirationDates = [];
        $credentialIds = [];
        $credentialUrls = [];

        foreach ($certData['title'] as $index => $title) {
            if (!empty($title) && !empty($certData['issuer'][$index])) {
                $titles[] = $title;
                $issuers[] = $certData['issuer'][$index];
                $issueDates[] = $certData['issue_date'][$index] ?? null;
                $expirationDates[] = $certData['expiration_date'][$index] ?? null;
                $credentialIds[] = $certData['credential_id'][$index] ?? null;
                $credentialUrls[] = $certData['credential_url'][$index] ?? null;
            }
        }

        return [
            'titles' => $titles,
            'issuers' => $issuers,
            'issue_dates' => $issueDates,
            'expiration_dates' => $expirationDates,
            'credential_ids' => $credentialIds,
            'credential_urls' => $credentialUrls
        ];
    }

    public function edit($id)
    {
        $member = $this->membersModel->findOrFail($id);

        $allExpertises = $this->expertiesModel->all();
        $memberExpertises = $this->memberExpertisesModel->getByMember($id);

        $social        = $this->membersModel->getSocialMedia($id);
        $education     = $this->membersModel->getEducations($id);
        $courses       = $this->membersModel->getCourses($id);
        $certifications = $this->membersModel->getCertifications($id);

        return $this->view('cms/anggota_lab/members/edit', [
            'members'          => $member,
            'allExpertises'    => $allExpertises,
            'memberExpertises' => $memberExpertises,
            'social'           => $social,
            'education'        => $education,
            'courses'          => $courses,
            'certifications'   => $certifications
        ]);
    }


    public function update()
    {
        header("Content-Type: application/json; charset=utf-8");

        $id = intval($_POST['id']);
        $old = $this->membersModel->findOrFail($id);

        try {

            $data = [
                'id'            => $id,
                'nip'           => trim($_POST['nip'] ?? ''),
                'nidn'          => trim($_POST['nidn'] ?? ''),
                'name'          => trim($_POST['name'] ?? ''),
                'title_prefix'  => trim($_POST['title_prefix'] ?? ''),
                'title_suffix'  => trim($_POST['title_suffix'] ?? ''),
                'program_studi' => trim($_POST['program_studi'] ?? ''),
                'jabatan'       => trim($_POST['jabatan'] ?? ''),
                'email'         => trim($_POST['email'] ?? ''),
                'phone'         => trim($_POST['phone'] ?? ''),
                'address'       => trim($_POST['address'] ?? ''),
                'photo'         => $old['photo']
            ];

            $errors = $this->requestValidator->validate($data, isUpdate: true);

            if (!empty($errors)) {
                http_response_code(422);
                echo json_encode([
                    'status' => 'error',
                    'errors' => $errors
                ]);
                return;
            }

            if (!empty($_FILES['photo']['name'])) {

                $uploadDir = __DIR__ . '/../../public/uploads/members/';
                if (!file_exists($uploadDir)) mkdir($uploadDir, 0777, true);

                $filename = time() . '_' . basename($_FILES['photo']['name']);
                $target = $uploadDir . $filename;

                if (move_uploaded_file($_FILES['photo']['tmp_name'], $target)) {
                    $data['photo'] = 'uploads/members/' . $filename;
                }
            }

            $social = $this->prepareSocialMediaData($_POST['social'] ?? []);
            $data['soc_platform'] = $social['platforms'];
            $data['soc_icon']     = $social['icons'];
            $data['soc_url']      = $social['urls'];

            $edu = $this->prepareEducationData($_POST['edu'] ?? []);
            $data['degree']      = $edu['degrees'];
            $data['major']       = $edu['majors'];
            $data['institution'] = $edu['institutions'];
            $data['start_year']  = $edu['start_years'] ?? [];
            $data['end_year']    = $edu['end_years'];

            $courses = $this->prepareCoursesData($_POST['course'] ?? []);
            $data['course_name'] = $courses['course_names'];
            $data['semester']    = $courses['semesters'];
            $data['course_code'] = $courses['codes'];
            $data['credits']     = $courses['credits'];

            $cert = $this->prepareCertificationsData($_POST['cert'] ?? []);
            $data['cert_title']      = $cert['titles'];
            $data['cert_issuer']     = $cert['issuers'];
            $data['cert_issue_date'] = $cert['issue_dates'];
            $data['cert_exp_date']   = $cert['expiration_dates'];
            $data['cred_id']         = $cert['credential_ids'];
            $data['cred_url']        = $cert['credential_urls'];

            $expertises = $_POST['expertises'] ?? [];

            $this->membersModel->updateWithStoredProcedure($id, $data);

            $this->memberExpertisesModel->deleteByMember($id);
            if (!empty($expertises)) {
                $this->memberExpertisesModel->insertMany($id, $expertises);
            }

            echo json_encode([
                'status'  => 'success',
                'message' => 'Anggota berhasil diperbarui.'
            ]);

        } catch (\Throwable $e) {

            http_response_code(500);
            echo json_encode([
                'status'  => 'error',
                'message' => 'Gagal mengupdate: ' . $e->getMessage()
            ]);
        }
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
