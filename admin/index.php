<?php
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/auth.php';

if (isLoggedIn()) {
    redirectTo(BASE_URL . '/admin/dashboard.php');
}

redirectTo(BASE_URL . '/admin/login.php');
