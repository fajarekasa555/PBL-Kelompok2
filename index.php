<?php
require_once __DIR__ . '/src/router/Router.php';
$page = $_GET['page'] ?? 'dashboard';
$action = $_GET['action'] ?? '';
Router::route($page, $action);
