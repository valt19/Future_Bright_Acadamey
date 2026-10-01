<?php
$pageTitle = 'Contact';
$currentPage = 'contact.php';
require __DIR__ . '/includes/header.php';

$notice = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $message = trim($_POST['message'] ?? '');

    $entry = [
        'id' => time(),
        'name' => $name,
        'email' => $email,
        'phone' => $phone,
        'message' => $message,
        'status' => 'unread',
        'created_at' => date('Y-m-d H:i:s'),
    ];

    $pdo = getDbConnection();
    if ($pdo && tableExists($pdo, 'messages')) {
        $stmt = $pdo->prepare('INSERT INTO messages (name, email, phone, message, created_at, status) VALUES (:name, :email, :phone, :message, NOW(), "unread")');
        $stmt->execute([
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'message' => $message,
        ]);
    } else {
        $_SESSION['demo_messages'] = array_values(array_merge($_SESSION['demo_messages'] ?? [], [$entry]));
    }

    $notice = 'Thank you. Your message has been submitted successfully.';
}
?>

<main>
    <section class="page-banner">
        <div class="container">
            <h1>Contact us</h1>
        </div>
    </section>

    <section class="page-content">
        <div class="container contact-layout">
            <div class="card">
                <h2>Get in touch</h2>
                <?php if ($notice !== ''): ?>
                    <div class="notice"><?php echo e($notice); ?></div>
                <?php endif; ?>
                <form method="post" class="form-wrap">
                    <div class="form-row">
                        <div>
                            <label for="name">Name</label>
                            <input id="name" name="name" type="text" required>
                        </div>
                        <div>
                            <label for="email">Email</label>
                            <input id="email" name="email" type="email" required>
                        </div>
                    </div>

                    <div>
                        <label for="phone">Phone</label>
                        <input id="phone" name="phone" type="tel">
                    </div>

                    <div>
                        <label for="message">Message</label>
                        <textarea id="message" name="message" required></textarea>
                    </div>

                    <button class="btn btn-primary" type="submit">Send message</button>
                </form>
            </div>

            <aside class="card">
                <h3>School contact details</h3>
                <p><strong>Address:</strong> <?php echo e($settings['school_address'] ?? 'Address not set yet'); ?></p>
                <p><strong>Phone:</strong> <?php echo e($settings['school_phone'] ?? 'Phone not set yet'); ?></p>
                <p><strong>Email:</strong> <?php echo e($settings['school_email'] ?? 'Email not set yet'); ?></p>
                <p><strong>Office hours:</strong> Monday to Friday, 8:00 am to 4:00 pm</p>
            </aside>
        </div>
    </section>
</main>

<?php require __DIR__ . '/includes/footer.php'; ?>
