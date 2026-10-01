<?php
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/auth.php';
requireAdminLogin();

$notice = '';
$settings = fetchSchoolSettings();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $updated = [
        'school_name' => trim($_POST['school_name'] ?? ''),
        'school_tagline' => trim($_POST['school_tagline'] ?? ''),
        'school_email' => trim($_POST['school_email'] ?? ''),
        'school_phone' => trim($_POST['school_phone'] ?? ''),
        'school_address' => trim($_POST['school_address'] ?? ''),
    ];

    $pdo = getDbConnection();
    if ($pdo && tableExists($pdo, 'school_settings')) {
        $stmt = $pdo->prepare('INSERT INTO school_settings (school_name, school_tagline, school_email, school_phone, school_address) VALUES (:school_name, :school_tagline, :school_email, :school_phone, :school_address)');
        $stmt->execute($updated);
        $notice = 'School details saved to the database.';
    } else {
        $_SESSION['school_settings'] = $updated;
        $notice = 'School details saved in the demo session and displayed on the public site.';
    }

    $settings = array_merge($settings, $updated);
}

$adminPageTitle = 'School Settings';
$adminCurrentPage = 'settings.php';
require __DIR__ . '/../includes/admin-header.php';
?>
<main class="admin-shell">
    <div class="container admin-content">
        <div class="page-title-row">
            <h1>School Settings</h1>
        </div>

        <div class="admin-panel">
            <h3>Website configuration</h3>
            <?php if ($notice !== ''): ?>
                <div class="notice"><?php echo e($notice); ?></div>
            <?php endif; ?>
            <form method="post" class="form-wrap">
                <div class="form-row">
                    <div>
                        <label for="school_name">School Name</label>
                        <input id="school_name" name="school_name" type="text" value="<?php echo e($settings['school_name'] ?? ''); ?>" required>
                    </div>
                    <div>
                        <label for="school_tagline">School Tagline</label>
                        <input id="school_tagline" name="school_tagline" type="text" value="<?php echo e($settings['school_tagline'] ?? ''); ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div>
                        <label for="school_email">Email</label>
                        <input id="school_email" name="school_email" type="email" value="<?php echo e($settings['school_email'] ?? ''); ?>">
                    </div>
                    <div>
                        <label for="school_phone">Phone</label>
                        <input id="school_phone" name="school_phone" type="text" value="<?php echo e($settings['school_phone'] ?? ''); ?>">
                    </div>
                </div>
                <div>
                    <label for="school_address">Address</label>
                    <textarea id="school_address" name="school_address"><?php echo e($settings['school_address'] ?? ''); ?></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Save settings</button>
            </form>
        </div>
    </div>
</main>
<?php require __DIR__ . '/../includes/admin-footer.php'; ?>
