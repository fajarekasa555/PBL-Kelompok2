<?php

use App\Controllers\DashboardController;
use App\Controllers\AuthController;
use App\Controllers\RolesController;
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

    '' => [DashboardController::class, 'index', ['auth']],
    'dashboard' => [DashboardController::class, 'index', ['auth']],

    'login'  => [AuthController::class, 'login', []],
    'logout' => [AuthController::class, 'logout', ['auth']],

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
];
