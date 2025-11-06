<?php
require_once __DIR__ . '/src/router/Router.php';
$page = $_GET['page'] ?? 'dashboard';
Router::route($page);
