<?php
require_once __DIR__ . '/functions.php';
$settings = fetchSchoolSettings();
$siteName = $settings['school_name'] ?? 'School Website';
$pageTitle = $pageTitle ?? 'School Website';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo e($siteName); ?> - school website and dashboard.">
    <title><?php echo e($pageTitle); ?> | <?php echo e($siteName); ?></title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
    <?php require __DIR__ . '/navbar.php'; ?>
