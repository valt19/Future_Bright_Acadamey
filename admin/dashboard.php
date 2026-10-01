<?php
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/auth.php';
requireAdminLogin();

$pdo = getDbConnection();
$counts = [
    'news' => 0,
    'events' => 0,
    'gallery' => 0,
    'messages' => 0,
    'admins' => 1,
];

if ($pdo) {
    foreach ($counts as $key => $value) {
        $table = [
            'news' => 'news',
            'events' => 'events',
            'gallery' => 'gallery',
            'messages' => 'messages',
            'admins' => 'admins',
        ][$key] ?? null;

        if ($table && tableExists($pdo, $table)) {
            $stmt = $pdo->query('SELECT COUNT(*) AS total FROM ' . $table);
            $counts[$key] = (int) ($stmt->fetch()['total'] ?? 0);
        }
    }
}

if (!empty($_SESSION['demo_news'])) {
    $counts['news'] = count($_SESSION['demo_news']);
}
if (!empty($_SESSION['demo_events'])) {
    $counts['events'] = count($_SESSION['demo_events']);
}
if (!empty($_SESSION['school_settings'])) {
    $counts['admins'] = max(1, $counts['admins']);
}

$adminPageTitle = 'Dashboard';
$adminCurrentPage = 'dashboard.php';
require __DIR__ . '/../includes/admin-header.php';
?>

<main class="admin-shell">
    <div class="container admin-content">
        <div class="page-title-row">
            <div>
                <h1>Dashboard</h1>
                <p class="meta">Welcome back. Manage your school website content from here.</p>
            </div>
        </div>

        <div class="admin-grid">
            <div class="dashboard-stat"><span class="value"><?php echo (int) $counts['news']; ?></span> News posts</div>
            <div class="dashboard-stat"><span class="value"><?php echo (int) $counts['events']; ?></span> Events</div>
            <div class="dashboard-stat"><span class="value"><?php echo (int) $counts['gallery']; ?></span> Gallery items</div>
            <div class="dashboard-stat"><span class="value"><?php echo (int) $counts['messages']; ?></span> Messages</div>
            <div class="dashboard-stat"><span class="value"><?php echo (int) $counts['admins']; ?></span> Administrators</div>
            <div class="dashboard-stat"><span class="value">4</span> Quick actions</div>
        </div>

        <div class="admin-panel">
            <h3>Quick actions</h3>
            <div class="hero-actions">
                <a class="btn btn-primary" href="<?php echo BASE_URL; ?>/admin/news.php">Add News</a>
                <a class="btn btn-primary" href="<?php echo BASE_URL; ?>/admin/events.php">Add Event</a>
                <a class="btn btn-secondary" href="<?php echo BASE_URL; ?>/admin/gallery.php">Upload Image</a>
                <a class="btn btn-secondary" href="<?php echo BASE_URL; ?>/admin/messages.php">View Messages</a>
            </div>
        </div>
    </div>
</main>

<?php require __DIR__ . '/../includes/admin-footer.php'; ?>
