<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/functions.php';

function isLoggedIn(): bool
{
    return !empty($_SESSION['admin_id']);
}

function requireAdminLogin(): void
{
    if (!isLoggedIn()) {
        redirectTo(BASE_URL . '/admin/login.php');
    }
}

function adminLogout(): void
{
    $_SESSION = [];
    if (ini_get('session.use_cookies')) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
    }
    session_destroy();
}
