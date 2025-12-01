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
}
