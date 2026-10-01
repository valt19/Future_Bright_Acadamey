<?php
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/auth.php';

if (isLoggedIn()) {
    redirectTo(BASE_URL . '/admin/dashboard.php');
}

$errorMessage = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    $pdo = getDbConnection();
    if ($pdo && tableExists($pdo, 'admins')) {
        $stmt = $pdo->prepare('SELECT * FROM admins WHERE email = :email LIMIT 1');
        $stmt->execute(['email' => $email]);
        $admin = $stmt->fetch();

        if ($admin && password_verify($password, $admin['password_hash'])) {
            $_SESSION['admin_id'] = (int) $admin['id'];
            $_SESSION['admin_email'] = $admin['email'];
            redirectTo(BASE_URL . '/admin/dashboard.php');
        }

        $errorMessage = 'Invalid email or password.';
    } elseif ($email === 'admin@example.com' && $password === 'password123') {
        $_SESSION['admin_id'] = 1;
        $_SESSION['admin_email'] = $email;
        redirectTo(BASE_URL . '/admin/dashboard.php');
    } else {
        $errorMessage = 'Invalid email or password.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/style.css">
</head>
<body>
    <main class="admin-shell">
        <div class="container">
            <div class="admin-login">
                <h1>Admin Login</h1>
                <?php if ($errorMessage !== ''): ?>
                    <div class="notice" style="background: #fef2f2; border-color: #fecaca; color: #991b1b;">
                        <?php echo e($errorMessage); ?>
                    </div>
                <?php endif; ?>
                <form method="post" class="form-wrap">
                    <div>
                        <label for="email">Email</label>
                        <input id="email" name="email" type="email" value="admin@example.com" required>
                    </div>
                    <div>
                        <label for="password">Password</label>
                        <input id="password" name="password" type="password" value="password123" required>
                    </div>
                    <button type="submit" class="btn btn-primary" style="width: 100%;">Login</button>
                </form>
                <p class="meta" style="margin-top: 18px;">Use the seeded admin account or create a real one after importing the MySQL schema.</p>
            </div>
        </div>
    </main>
</body>
</html>
