<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\LandingPageModel;

class LandingPageController extends Controller
{
    protected $landingPageModel;
    public function __construct()
    {
        $this->landingPageModel = new LandingPageModel();
    }

    public function index()
    {
        $visions = $this->landingPageModel->getVisions();
        $missions = $this->landingPageModel->getMissions();
        $lab_information = $this->landingPageModel->getLabInfo();
        $research_focuses = $this->landingPageModel->getRiset();
        $courses = $this->landingPageModel->getCourses();
        $activities = $this->landingPageModel->getActivity();
        $projects = $this->landingPageModel->getProjects();
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

        return $this->view('landing_page/detail_member', [
            'member' => $member
        ], false);
    }
}
