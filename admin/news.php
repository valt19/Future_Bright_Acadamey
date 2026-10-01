<?php
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/auth.php';
requireAdminLogin();

$notice = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $summary = trim($_POST['summary'] ?? '');
    $content = trim($_POST['content'] ?? '');
    $published = isset($_POST['is_published']) ? 1 : 0;

    if ($title !== '') {
        $entry = [
            'id' => time(),
            'title' => $title,
            'summary' => $summary !== '' ? $summary : substr($content, 0, 160),
            'content' => $content,
            'is_published' => $published,
            'created_at' => date('Y-m-d H:i:s'),
        ];

        $pdo = getDbConnection();
        if ($pdo && tableExists($pdo, 'news')) {
            $stmt = $pdo->prepare('INSERT INTO news (title, summary, content, is_published, created_at) VALUES (:title, :summary, :content, :published, NOW())');
            $stmt->execute([
                'title' => $title,
                'summary' => $entry['summary'],
                'content' => $content,
                'published' => $published,
            ]);
            $notice = 'News item saved to the database.';
        } else {
            $_SESSION['demo_news'] = array_values(array_merge($_SESSION['demo_news'] ?? [], [$entry]));
            $notice = 'News item saved in the demo session and is now visible on the public site.';
        }
    }
}

$adminPageTitle = 'Manage News';
$adminCurrentPage = 'news.php';
require __DIR__ . '/../includes/admin-header.php';
$newsItems = $_SESSION['demo_news'] ?? getLatestNews(10);
?>
<main class="admin-shell">
    <div class="container admin-content">
        <div class="page-title-row">
            <h1>News Management</h1>
        </div>

        <div class="admin-panel">
            <h3>Add News Item</h3>
            <?php if ($notice !== ''): ?>
                <div class="notice"><?php echo e($notice); ?></div>
            <?php endif; ?>
            <form method="post" class="form-wrap">
                <div>
                    <label for="news_title">Title</label>
                    <input id="news_title" name="title" type="text" required>
                </div>
                <div>
                    <label for="news_summary">Summary</label>
                    <textarea id="news_summary" name="summary" placeholder="Short description"></textarea>
                </div>
                <div>
                    <label for="news_content">Content</label>
                    <textarea id="news_content" name="content" required></textarea>
                </div>
                <label><input type="checkbox" name="is_published" checked> Publish immediately</label>
                <button type="submit" class="btn btn-primary">Save news</button>
            </form>
        </div>

        <div class="admin-panel">
            <h3>Current News</h3>
            <?php if (empty($newsItems)): ?>
                <p>No news items yet.</p>
            <?php else: ?>
                <div class="admin-list">
                    <?php foreach ($newsItems as $item): ?>
                        <div class="admin-list-item">
                            <strong><?php echo e($item['title'] ?? 'Untitled'); ?></strong>
                            <p><?php echo e($item['summary'] ?? ($item['content'] ?? 'No summary available')); ?></p>
                            <small><?php echo e($item['created_at'] ?? date('Y-m-d')); ?></small>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>
<?php require __DIR__ . '/../includes/admin-footer.php'; ?>
