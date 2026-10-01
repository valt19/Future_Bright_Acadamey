<?php
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/auth.php';
requireAdminLogin();

$notice = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $eventDate = $_POST['event_date'] ?? date('Y-m-d');
    $location = trim($_POST['location'] ?? '');
    $isPublished = isset($_POST['is_published']) ? 1 : 0;

    if ($title !== '') {
        $entry = [
            'id' => time(),
            'title' => $title,
            'description' => $description,
            'event_date' => $eventDate,
            'location' => $location,
            'is_published' => $isPublished,
        ];

        $pdo = getDbConnection();
        if ($pdo && tableExists($pdo, 'events')) {
            $stmt = $pdo->prepare('INSERT INTO events (title, description, event_date, location, is_published, created_at) VALUES (:title, :description, :event_date, :location, :published, NOW())');
            $stmt->execute([
                'title' => $title,
                'description' => $description,
                'event_date' => $eventDate,
                'location' => $location,
                'published' => $isPublished,
            ]);
            $notice = 'Event saved to the database.';
        } else {
            $_SESSION['demo_events'] = array_values(array_merge($_SESSION['demo_events'] ?? [], [$entry]));
            $notice = 'Event saved in the demo session and appears on the website.';
        }
    }
}

$adminPageTitle = 'Manage Events';
$adminCurrentPage = 'events.php';
require __DIR__ . '/../includes/admin-header.php';
$eventsList = $_SESSION['demo_events'] ?? getUpcomingEvents(10);
?>
<main class="admin-shell">
    <div class="container admin-content">
        <div class="page-title-row">
            <h1>Events Management</h1>
        </div>

        <div class="admin-panel">
            <h3>Add Event</h3>
            <?php if ($notice !== ''): ?>
                <div class="notice"><?php echo e($notice); ?></div>
            <?php endif; ?>
            <form method="post" class="form-wrap">
                <div>
                    <label for="event_title">Title</label>
                    <input id="event_title" name="title" type="text" required>
                </div>
                <div class="form-row">
                    <div>
                        <label for="event_date">Date</label>
                        <input id="event_date" name="event_date" type="date" value="<?php echo date('Y-m-d'); ?>" required>
                    </div>
                    <div>
                        <label for="event_location">Location</label>
                        <input id="event_location" name="location" type="text" required>
                    </div>
                </div>
                <div>
                    <label for="event_description">Description</label>
                    <textarea id="event_description" name="description" required></textarea>
                </div>
                <label><input type="checkbox" name="is_published" checked> Publish immediately</label>
                <button type="submit" class="btn btn-primary">Save event</button>
            </form>
        </div>

        <div class="admin-panel">
            <h3>Upcoming Events</h3>
            <?php if (empty($eventsList)): ?>
                <p>No events yet.</p>
            <?php else: ?>
                <div class="admin-list">
                    <?php foreach ($eventsList as $event): ?>
                        <div class="admin-list-item">
                            <strong><?php echo e($event['title'] ?? 'Untitled event'); ?></strong>
                            <p><?php echo e($event['description'] ?? 'No description available'); ?></p>
                            <small><?php echo e($event['event_date'] ?? date('Y-m-d')); ?> • <?php echo e($event['location'] ?? 'Location unavailable'); ?></small>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>
<?php require __DIR__ . '/../includes/admin-footer.php'; ?>
