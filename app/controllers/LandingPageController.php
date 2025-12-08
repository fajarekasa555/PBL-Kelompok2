<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\LandingPageModel;
use App\Models\MemberStudentModel;
use App\Requests\MemberStudentRequest;

class LandingPageController extends Controller
{
    protected $landingPageModel;
    protected $memberStudentModel;

    public function __construct()
    {
        $this->landingPageModel = new LandingPageModel();
        $this->memberStudentModel = new MemberStudentModel();
    }

    public function index()
    {
        $visions = $this->landingPageModel->getVisions();
        $missions = $this->landingPageModel->getMissions();
        $lab_information = $this->landingPageModel->getLabInfo();
        $research_focuses = $this->landingPageModel->getRiset();
        $courses = $this->landingPageModel->getCourses();
        $activities = $this->landingPageModel->getActivity();

        foreach ($activities as &$activity) {
            $activity['members'] = json_decode($activity['members']);
        }

        $projects = $this->landingPageModel->getProjects();
        foreach ($projects as &$project) {
            $project['members'] = json_decode($project['members']);
        }

        $facilities = $this->landingPageModel->getFacilities();
        $publications = $this->landingPageModel->getPublications();
        $members = $this->landingPageModel->getMembers();
        
        return $this->view('landing_page/index', [
            'visions' => $visions,
            'missions' => $missions,
            'lab_information' => $lab_information,
            'research_focuses' => $research_focuses,
            'courses' => $courses,
            'activities' => $activities,
            'projects' => $projects,
            'facilities' => $facilities,
            'publications' => $publications,
            'members' => $members
        ], false);
    }

    public function detailMember($id)
    {
        $member = $this->landingPageModel->getMemberById($id);
        if (!$member) {
            return $this->view('errors/404', [], false);
        }

        $member['social_media'] = json_decode($member['social_media'], true);
        $member['educations'] = json_decode($member['educations'], true);
        $member['courses'] = json_decode($member['courses'], true);
        $member['certifications'] = json_decode($member['certifications'], true);
        $member['publications'] = json_decode($member['publications'], true);
        $member['expertises'] = json_decode($member['expertises'], true);

        return $this->view('landing_page/members/detail_member', [
            'member' => $member
        ], false);
    }

    public function pendaftaran()
    {
        return $this->view('landing_page/pendaftaran/form_pendaftaran', [], false);
    }

    public function daftar()
    {
        header('Content-Type: application/json');

        try {
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                throw new \Exception('Method not allowed');
            }

            $request = new MemberStudentRequest();
            $errors = $request->validate($_POST, $_FILES);

            if (!empty($errors)) {
                http_response_code(422);
                echo json_encode([
                    'success' => false,
                    'errors' => $errors
                ]);
                exit;
            }

            $cv_path = $this->handleFileUpload($_FILES['cv'], 'cv');

            $portfolio_path = null;
            if (!empty($_FILES['portfolio']['name'])) {
                $portfolio_path = $this->handleFileUpload($_FILES['portfolio'], 'portfolio');
            }

            $data = [
                'nim' => trim($_POST['nim']),
                'name' => trim($_POST['name']),
                'program_studi' => $_POST['program_studi'] ?? null,
                'semester' => !empty($_POST['semester']) ? intval($_POST['semester']) : null,
                'ipk' => floatval($_POST['ipk']),
                'cv_path' => $cv_path,
                'portfolio_path' => $portfolio_path,
                'motivation' => trim($_POST['motivation']),
                'email' => trim($_POST['email']),
                'phone' => $_POST['phone'] ?? null,
                'status' => 'pending'
            ];

            $result = $this->memberStudentModel->create($data);

            if (!$result) {
                throw new \Exception('Gagal menyimpan data pendaftaran');
            }

            echo json_encode([
                'success' => true,
                'message' => 'Pendaftaran berhasil dikirim! Proses verifikasi akan dilakukan maksimal 3x24 jam.'
            ]);

        } catch (\Exception $e) {
            http_response_code(400);
            echo json_encode([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
        exit;
    }


    private function handleFileUpload($file, $type = 'document')
    {
        $max_size = ($type === 'cv') ? 5 * 1024 * 1024 : 10 * 1024 * 1024;

        if ($file['size'] > $max_size) {
            throw new \Exception('Ukuran file terlalu besar');
        }

        $allowed_types = [
            'application/pdf',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'application/zip',
            'application/x-zip-compressed'
        ];

        $finfo = new \finfo(FILEINFO_MIME_TYPE);
        $mime_type = $finfo->file($file['tmp_name']);

        if (!in_array($mime_type, $allowed_types)) {
            throw new \Exception('Tipe file tidak valid');
        }

        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename = $type . '_' . time() . '_' . uniqid() . '.' . $extension;

        $upload_dir = __DIR__ . '/../../public/uploads/member_students/';

        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        $destination = $upload_dir . $filename;
        if (move_uploaded_file($file['tmp_name'], $destination)) {
            return 'public/uploads/member_students/' . $filename;
        }

        return false;
    }

    public function activities(){
        $activities = $this->landingPageModel->getActivity();
        foreach ($activities as &$activity) {
            $activity['members'] = json_decode($activity['members']);
        }

        $projects = $this->landingPageModel->getProjects();
        foreach ($projects as &$project) {
            $project['members'] = json_decode($project['members']);
        }

        return $this->view('landing_page/activities/index', [
            'activities' => $activities,
            'projects' => $projects
        ], false);
    }
}
