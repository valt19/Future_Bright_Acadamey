<?php
require_once __DIR__ . '/functions.php';
$adminPageTitle = $adminPageTitle ?? 'Admin Dashboard';
$adminCurrentPage = $adminCurrentPage ?? basename($_SERVER['PHP_SELF']);
$siteHomeUrl = siteUrl();
$adminNav = [
    ['label' => 'Dashboard', 'url' => BASE_URL . '/admin/dashboard.php', 'file' => 'dashboard.php'],
    ['label' => 'News', 'url' => BASE_URL . '/admin/news.php', 'file' => 'news.php'],
    ['label' => 'Events', 'url' => BASE_URL . '/admin/events.php', 'file' => 'events.php'],
    ['label' => 'Gallery', 'url' => BASE_URL . '/admin/gallery.php', 'file' => 'gallery.php'],
    ['label' => 'Messages', 'url' => BASE_URL . '/admin/messages.php', 'file' => 'messages.php'],
    ['label' => 'Settings', 'url' => BASE_URL . '/admin/settings.php', 'file' => 'settings.php'],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($adminPageTitle); ?> | Admin</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/style.css">
</head>
<body class="admin-body">
    <header class="admin-topbar">
        <div class="container admin-topbar-inner">
            <div class="admin-brand">
                <span class="brand-mark">S</span>
                <div>
                    <strong>School Admin</strong>
                    <small>Control panel</small>
                </div>
            </div>

            <nav class="admin-nav" aria-label="Admin navigation">
                <ul>
                    <?php foreach ($adminNav as $item): ?>
                        <li>
                            <a href="<?php echo $item['url']; ?>" class="<?php echo ($item['file'] === $adminCurrentPage) ? 'active' : ''; ?>">
                                <?php echo e($item['label']); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </nav>

            <div class="admin-actions">
                <a href="<?php echo e($siteHomeUrl); ?>" class="btn btn-secondary btn-sm">View site</a>
                <a href="<?php echo BASE_URL; ?>/admin/logout.php" class="btn btn-primary btn-sm">Logout</a>
            </div>
        </div>
    </header>
