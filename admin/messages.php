<?php
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/auth.php';
requireAdminLogin();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['message_id'])) {
    $messageId = (int) $_POST['message_id'];
    $messages = $_SESSION['demo_messages'] ?? getMessages();
    foreach ($messages as &$message) {
        if ((int) ($message['id'] ?? 0) === $messageId) {
            $message['status'] = 'read';
            break;
        }
    }
    unset($message);
    $_SESSION['demo_messages'] = $messages;
}

$adminPageTitle = 'Messages';
$adminCurrentPage = 'messages.php';
require __DIR__ . '/../includes/admin-header.php';
$messages = $_SESSION['demo_messages'] ?? getMessages();
?>
<main class="admin-shell">
    <div class="container admin-content">
        <div class="page-title-row">
            <h1>Messages</h1>
        </div>
        <div class="admin-panel">
            <h3>Incoming contact messages</h3>
            <?php if (empty($messages)): ?>
                <p>No messages received yet.</p>
            <?php else: ?>
                <div class="admin-list">
                    <?php foreach ($messages as $message): ?>
                        <div class="admin-list-item">
                            <strong><?php echo e($message['name'] ?? 'Unknown sender'); ?></strong>
                            <p><?php echo e($message['message'] ?? ''); ?></p>
                            <small>
                                <?php echo e($message['email'] ?? ''); ?> · <?php echo e($message['created_at'] ?? date('Y-m-d H:i:s')); ?>
                            </small>
                            <div style="margin-top: 12px;">
                                <span class="status-pill"><?php echo e($message['status'] ?? 'unread'); ?></span>
                                <?php if (($message['status'] ?? 'unread') !== 'read'): ?>
                                    <form method="post" style="display:inline-block; margin-left: 10px;">
                                        <input type="hidden" name="message_id" value="<?php echo (int) ($message['id'] ?? 0); ?>">
                                        <button type="submit" class="btn btn-secondary btn-sm">Mark as read</button>
                                    </form>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>
<?php require __DIR__ . '/../includes/admin-footer.php'; ?>
