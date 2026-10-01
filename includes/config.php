<?php
session_start();

if (!defined('BASE_URL')) {
    $scriptName = $_SERVER['SCRIPT_NAME'] ?? '';
    $basePath = '';

    if ($scriptName !== '') {
        $normalizedScript = str_replace('\\', '/', $scriptName);

        if (preg_match('#/admin/[^/]+$#', $normalizedScript)) {
            $basePath = dirname(dirname($normalizedScript));
        } else {
            $basePath = dirname($normalizedScript);
        }

        $basePath = rtrim($basePath, '/');
    }

    if ($basePath === '.' || $basePath === '/' || $basePath === '\\') {
        $basePath = '';
    }

    define('BASE_URL', $basePath);
}

date_default_timezone_set('UTC');

if (!defined('DB_HOST')) {
    define('DB_HOST', 'localhost');
}

if (!defined('DB_NAME')) {
    define('DB_NAME', 'school_website');
}

if (!defined('DB_USER')) {
    define('DB_USER', 'root');
}

if (!defined('DB_PASS')) {
    define('DB_PASS', '');
}

$defaultSettings = [
    'school_name' => 'Future Bright Academy',
    'school_tagline' => 'Learning with Purpose and Heart',
    'school_email' => 'info@futurebrightacademy.edu',
    'school_phone' => '+1 (555) 123-4567',
    'school_address' => '123 Learning Avenue, Town Center, Country',
    'school_vision' => 'To inspire confident learners and responsible global citizens.',
    'school_mission' => 'To provide quality education in a nurturing and inclusive environment.'
];
