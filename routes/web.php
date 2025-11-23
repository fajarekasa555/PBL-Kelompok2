<?php

use App\Controllers\ActivitiesController;
use App\Controllers\DashboardController;
use App\Controllers\AuthController;
use App\Controllers\CertificationController;
use App\Controllers\CourseController;
use App\Controllers\EducationController;
use App\Controllers\ExpertiesController;
use App\Controllers\LabCourseController;
use App\Controllers\LabInformationController;
use App\Controllers\LabMissionController;
use App\Controllers\LabVisionController;
use App\Controllers\LandingPageController;
use App\Controllers\MembersController;
use App\Controllers\ProjectController;
use App\Controllers\PublicationsController;
use App\Controllers\ResearchFocusController;
use App\Controllers\RolesController;
use App\Controllers\SocialMediaController;
use App\Controllers\UserController;
/**
 * Format:
 * 'path' => [ControllerClass, 'method', ['middleware1', 'middleware2']]
 * 
 * Catatan:
 * - Gunakan {id} untuk segment dinamis.
 * - Router akan otomatis menggantinya dengan parameter method controller.
 */

return [

    'landing_page' => [LandingPageController::class, 'index', []],
    '' => [DashboardController::class, 'index', ['auth']],
    'dashboard' => [DashboardController::class, 'index', ['auth']],

    'login'  => [AuthController::class, 'login', []],
    'logout' => [AuthController::class, 'logout', ['auth']],

    // user management

    'users'             => [UserController::class, 'index', ['auth', 'admin']],
    'users/create'      => [UserController::class, 'create', ['auth', 'admin']],
    'users/store'       => [UserController::class, 'store', ['auth', 'admin']],
    'users/edit/{id}'   => [UserController::class, 'edit', ['auth', 'admin']],
    'users/update'      => [UserController::class, 'update', ['auth', 'admin']],
    'users/delete/{id}' => [UserController::class, 'delete', ['auth', 'admin']],

    'roles'             => [RolesController::class, 'index', ['auth', 'admin']],
    'roles/create'      => [RolesController::class, 'create', ['auth', 'admin']],
    'roles/store'       => [RolesController::class, 'store', ['auth', 'admin']],
    'roles/edit/{id}'   => [RolesController::class, 'edit', ['auth', 'admin']],
    'roles/update'      => [RolesController::class, 'update', ['auth', 'admin']],
    'roles/delete/{id}' => [RolesController::class, 'delete', ['auth', 'admin']],

    // anggota lab
    'members'             => [MembersController::class, 'index', ['auth', 'admin']],
    'members/show/{id}'   => [MembersController::class, 'show', ['auth', 'admin']],
    'members/create'      => [MembersController::class, 'create', ['auth', 'admin']],
    'members/store'       => [MembersController::class, 'store', ['auth', 'admin']],
    'members/edit/{id}'   => [MembersController::class, 'edit', ['auth', 'admin']],
    'members/update'      => [MembersController::class, 'update', ['auth', 'admin']],
    'members/delete/{id}' => [MembersController::class, 'delete', ['auth', 'admin']],

    'publications'             => [PublicationsController::class, 'index', ['auth', 'admin']],
    'publications/create'      => [PublicationsController::class, 'create', ['auth', 'admin']],
    'publications/store'       => [PublicationsController::class, 'store', ['auth', 'admin']],
    'publications/edit/{id}'   => [PublicationsController::class, 'edit', ['auth', 'admin']],
    'publications/update'      => [PublicationsController::class, 'update', ['auth', 'admin']],
    'publications/delete/{id}' => [PublicationsController::class, 'delete', ['auth', 'admin']],

    'social_media'             => [SocialMediaController::class, 'index', ['auth', 'admin']],
    'social_media/create'      => [SocialMediaController::class, 'create', ['auth', 'admin']],
    'social_media/store'       => [SocialMediaController::class, 'store', ['auth', 'admin']],
    'social_media/edit/{id}'   => [SocialMediaController::class, 'edit', ['auth', 'admin']],
    'social_media/update'      => [SocialMediaController::class, 'update', ['auth', 'admin']],
    'social_media/delete/{id}' => [SocialMediaController::class, 'delete', ['auth', 'admin']],

    'educations'             => [EducationController::class, 'index', ['auth', 'admin']],
    'educations/create'      => [EducationController::class, 'create', ['auth', 'admin']],
    'educations/store'       => [EducationController::class, 'store', ['auth', 'admin']],
    'educations/edit/{id}'   => [EducationController::class, 'edit', ['auth', 'admin']],
    'educations/update'      => [EducationController::class, 'update', ['auth', 'admin']],
    'educations/delete/{id}' => [EducationController::class, 'delete', ['auth', 'admin']],

    'experties'             => [ExpertiesController::class, 'index', ['auth', 'admin']],
    'experties/create'      => [ExpertiesController::class, 'create', ['auth', 'admin']],
    'experties/store'       => [ExpertiesController::class, 'store', ['auth', 'admin']],
    'experties/edit/{id}'   => [ExpertiesController::class, 'edit', ['auth', 'admin']],
    'experties/update'      => [ExpertiesController::class, 'update', ['auth', 'admin']],
    'experties/delete/{id}' => [ExpertiesController::class, 'delete', ['auth', 'admin']],

    'certifications'             => [CertificationController::class, 'index', ['auth', 'admin']],
    'certifications/create'      => [CertificationController::class, 'create', ['auth', 'admin']],
    'certifications/store'       => [CertificationController::class, 'store', ['auth', 'admin']],
    'certifications/edit/{id}'   => [CertificationController::class, 'edit', ['auth', 'admin']],
    'certifications/update'      => [CertificationController::class, 'update', ['auth', 'admin']],
    'certifications/delete/{id}' => [CertificationController::class, 'delete', ['auth', 'admin']],

    'courses'             => [CourseController::class, 'index', ['auth', 'admin']],
    'courses/create'      => [CourseController::class, 'create', ['auth', 'admin']],
    'courses/store'       => [CourseController::class, 'store', ['auth', 'admin']],
    'courses/edit/{id}'   => [CourseController::class, 'edit', ['auth', 'admin']],
    'courses/update'      => [CourseController::class, 'update', ['auth', 'admin']],
    'courses/delete/{id}' => [CourseController::class, 'delete', ['auth', 'admin']],

    // content management
    'lab-courses'             => [LabCourseController::class, 'index', ['auth', 'admin']],
    'lab-courses/create'      => [LabCourseController::class, 'create', ['auth', 'admin']],
    'lab-courses/store'       => [LabCourseController::class, 'store', ['auth', 'admin']],
    'lab-courses/edit/{id}'   => [LabCourseController::class, 'edit', ['auth', 'admin']],
    'lab-courses/update'      => [LabCourseController::class, 'update', ['auth', 'admin']],
    'lab-courses/delete/{id}' => [LabCourseController::class, 'delete', ['auth', 'admin']],

    'research-focuses'             => [ResearchFocusController::class, 'index', ['auth', 'admin']],
    'research-focuses/create'      => [ResearchFocusController::class, 'create', ['auth', 'admin']],
    'research-focuses/store'       => [ResearchFocusController::class, 'store', ['auth', 'admin']],
    'research-focuses/edit/{id}'   => [ResearchFocusController::class, 'edit', ['auth', 'admin']],
    'research-focuses/update'      => [ResearchFocusController::class, 'update', ['auth', 'admin']],
    'research-focuses/delete/{id}' => [ResearchFocusController::class, 'delete', ['auth', 'admin']],

    'activities'             => [ActivitiesController::class, 'index', ['auth', 'admin']],
    'activities/show/{id}'   => [ActivitiesController::class, 'show', ['auth', 'admin']],
    'activities/create'      => [ActivitiesController::class, 'create', ['auth', 'admin']],
    'activities/store'       => [ActivitiesController::class, 'store', ['auth', 'admin']],
    'activities/edit/{id}'   => [ActivitiesController::class, 'edit', ['auth', 'admin']],
    'activities/update'      => [ActivitiesController::class, 'update', ['auth', 'admin']],
    'activities/delete/{id}' => [ActivitiesController::class, 'delete', ['auth', 'admin']],

    'projects'             => [ProjectController::class, 'index', ['auth', 'admin']],
    'projects/show/{id}'   => [ProjectController::class, 'show', ['auth', 'admin']],
    'projects/create'      => [ProjectController::class, 'create', ['auth', 'admin']],
    'projects/store'       => [ProjectController::class, 'store', ['auth', 'admin']],
    'projects/edit/{id}'   => [ProjectController::class, 'edit', ['auth', 'admin']],
    'projects/update'      => [ProjectController::class, 'update', ['auth', 'admin']],
    'projects/delete/{id}' => [ProjectController::class, 'delete', ['auth', 'admin']],

    'vision'             => [LabVisionController::class, 'index', ['auth', 'admin']],
    'vision/create'      => [LabVisionController::class, 'create', ['auth', 'admin']],
    'vision/store'       => [LabVisionController::class, 'store', ['auth', 'admin']],
    'vision/edit/{id}'   => [LabVisionController::class, 'edit', ['auth', 'admin']],
    'vision/update'      => [LabVisionController::class, 'update', ['auth', 'admin']],
    'vision/delete/{id}' => [LabVisionController::class, 'delete', ['auth', 'admin']],

    'mission'             => [LabMissionController::class, 'index', ['auth', 'admin']],
    'mission/create'      => [LabMissionController::class, 'create', ['auth', 'admin']],
    'mission/store'       => [LabMissionController::class, 'store', ['auth', 'admin']],
    'mission/edit/{id}'   => [LabMissionController::class, 'edit', ['auth', 'admin']],
    'mission/update'      => [LabMissionController::class, 'update', ['auth', 'admin']],
    'mission/delete/{id}' => [LabMissionController::class, 'delete', ['auth', 'admin']],

    'lab_information'             => [LabInformationController::class, 'index', ['auth', 'admin']],
    'lab_information/store'       => [LabInformationController::class, 'store', ['auth', 'admin']],
    'lab_information/edit/{id}'   => [LabInformationController::class, 'edit', ['auth', 'admin']],
    'lab_information/update/{id}'      => [LabInformationController::class, 'update', ['auth', 'admin']],
    'lab_information/delete/{id}' => [LabInformationController::class, 'delete', ['auth', 'admin']],
];
