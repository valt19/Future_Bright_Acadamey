<?php
require_once __DIR__ . '/config.php';

function getDbConnection(): ?PDO
{
    static $pdo = null;

    if ($pdo instanceof PDO) {
        return $pdo;
    }

    $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4';

    try {
        $pdo = new PDO($dsn, DB_USER, DB_PASS, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]);

        return $pdo;
    } catch (PDOException $exception) {
        return null;
    }
}

function tableExists(PDO $pdo, string $tableName): bool
{
    $query = $pdo->prepare("SHOW TABLES LIKE :tableName");
    $query->execute(['tableName' => $tableName]);

    return $query->fetch() !== false;
}

function fetchSchoolSettings(): array
{
    global $defaultSettings;

    if (!empty($_SESSION['school_settings'])) {
        return array_merge($defaultSettings, $_SESSION['school_settings']);
    }

    $pdo = getDbConnection();
    if (!$pdo) {
        return $defaultSettings;
    }

    try {
        $tables = $pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);
        if (!in_array('school_settings', $tables, true)) {
            return $defaultSettings;
        }

        $stmt = $pdo->query('SELECT * FROM school_settings ORDER BY id DESC LIMIT 1');
        $settings = $stmt->fetch();

        if (!$settings) {
            return $defaultSettings;
        }

        return array_merge($defaultSettings, $settings);
    } catch (PDOException $exception) {
        return $defaultSettings;
    }
}
