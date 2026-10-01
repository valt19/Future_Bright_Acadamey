<?php
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/auth.php';
adminLogout();
redirectTo(BASE_URL . '/admin/login.php');
