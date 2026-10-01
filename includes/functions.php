<?php
require_once __DIR__ . '/database.php';

function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

function redirectTo(string $path): void
{
    header('Location: ' . $path);
    exit;
}

function getLatestNews(int $limit = 3): array
{
    if (!empty($_SESSION['demo_news'])) {
        $news = $_SESSION['demo_news'];
        usort($news, static fn ($a, $b) => strtotime($b['created_at'] ?? date('Y-m-d')) <=> strtotime($a['created_at'] ?? date('Y-m-d')));
        return array_slice($news, 0, $limit);
    }

    $pdo = getDbConnection();
    if (!$pdo || !tableExists($pdo, 'news')) {
        return [
            [
                'id' => 1,
                'title' => 'School community open day',
                'summary' => 'Parents and guardians are invited to meet our staff and explore the learning environment.',
                'created_at' => date('Y-m-d'),
            ],
            [
                'id' => 2,
                'title' => 'STEM Club registration now open',
                'summary' => 'Students can apply for clubs in robotics, coding, science, and innovation projects.',
                'created_at' => date('Y-m-d'),
            ],
            [
                'id' => 3,
                'title' => 'Holiday schedule update',
                'summary' => 'A reminder of upcoming school breaks and attendance expectations for the term.',
                'created_at' => date('Y-m-d'),
            ],
        ];
    }

    $stmt = $pdo->prepare('SELECT * FROM news WHERE is_published = 1 ORDER BY created_at DESC LIMIT :limit');
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll();
}

function getUpcomingEvents(int $limit = 3): array
{
    if (!empty($_SESSION['demo_events'])) {
        $events = $_SESSION['demo_events'];
        usort($events, static fn ($a, $b) => strtotime($a['event_date'] ?? date('Y-m-d')) <=> strtotime($b['event_date'] ?? date('Y-m-d')));
        return array_slice($events, 0, $limit);
    }

    $pdo = getDbConnection();
    if (!$pdo || !tableExists($pdo, 'events')) {
        return [
            [
                'id' => 1,
                'title' => 'Parent orientation evening',
                'event_date' => date('Y-m-d', strtotime('+10 days')),
                'location' => 'Main hall',
                'description' => 'An opportunity for families to meet the teaching team and learn about the term plan.',
            ],
            [
                'id' => 2,
                'title' => 'Inter-school sports day',
                'event_date' => date('Y-m-d', strtotime('+18 days')),
                'location' => 'School grounds',
                'description' => 'Students will take part in track, field, and team activities throughout the afternoon.',
            ],
            [
                'id' => 3,
                'title' => 'Art and culture exhibition',
                'event_date' => date('Y-m-d', strtotime('+26 days')),
                'location' => 'Creative arts studio',
                'description' => 'A showcase of student creativity across visual art, design, and music.',
            ],
        ];
    }

    $stmt = $pdo->prepare('SELECT * FROM events WHERE is_published = 1 AND event_date >= CURDATE() ORDER BY event_date ASC LIMIT :limit');
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll();
}

function getGalleryItems(): array
{
    if (!empty($_SESSION['demo_gallery'])) {
        return $_SESSION['demo_gallery'];
    }

    $pdo = getDbConnection();
    if (!$pdo || !tableExists($pdo, 'gallery')) {
        return [
            [
                'id' => 1,
                'title' => 'Campus highlight',
                'caption' => 'A look at the school grounds and learning spaces.',
                'image_path' => '/assets/images/placeholder-school.svg',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 2,
                'title' => 'Student life',
                'caption' => 'Activities that encourage confidence, teamwork and creativity.',
                'image_path' => '/assets/images/placeholder-school.svg',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 3,
                'title' => 'Learning environment',
                'caption' => 'Bright and welcoming classrooms designed for active learning.',
                'image_path' => '/assets/images/placeholder-school.svg',
                'created_at' => date('Y-m-d H:i:s'),
            ],
        ];
    }

    $stmt = $pdo->query('SELECT * FROM gallery ORDER BY created_at DESC');
    return $stmt->fetchAll();
}

function getMessages(): array
{
    if (!empty($_SESSION['demo_messages'])) {
        return $_SESSION['demo_messages'];
    }

    $pdo = getDbConnection();
    if (!$pdo || !tableExists($pdo, 'messages')) {
        return [];
    }

    $stmt = $pdo->query('SELECT * FROM messages ORDER BY created_at DESC');
    return $stmt->fetchAll();
}

function sanitizeFileName(string $name): string
{
    $name = basename($name);
    $name = preg_replace('/[^a-zA-Z0-9._-]+/', '-', $name);
    $name = trim($name, '.-_');

    return $name !== '' ? $name : 'upload-' . time() . '.jpg';
}

function siteUrl(): string
{
    return BASE_URL === '' ? '/' : BASE_URL;
}

function currentYear(): string
{
    return date('Y');
}
