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
        
        return $this->view('landing_page/index', [], false);
    }
}
