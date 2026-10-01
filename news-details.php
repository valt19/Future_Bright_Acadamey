<?php
$pageTitle = 'News Details';
$currentPage = 'news-details.php';
require __DIR__ . '/includes/header.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 1;
$newsItems = getLatestNews(5);
$article = $newsItems[0];

foreach ($newsItems as $item) {
    if ((int) ($item['id'] ?? 1) === $id) {
        $article = $item;
        break;
    }
}
?>

<main>
    <section class="page-banner">
        <div class="container">
            <h1><?php echo e($article['title'] ?? 'School update'); ?></h1>
        </div>
    </section>

    <section class="page-content">
        <div class="container detail-layout">
            <article>
                <img src="<?php echo BASE_URL; ?>/assets/images/placeholder-school.svg" alt="<?php echo e($article['title'] ?? 'School update'); ?>" style="border-radius: 18px; margin-bottom: 26px;">
                <div class="meta"><?php echo e(date('M j, Y', strtotime($article['created_at'] ?? date('Y-m-d')))); ?></div>
                <p><?php echo e($article['summary'] ?? 'This article is part of our school update series.'); ?></p>
                <p>Our school community is committed to creating learning experiences that are vibrant, meaningful and future-focused. We celebrate student achievement, teacher professionalism and the strong partnerships we build with families.</p>
                <p>Stay connected with upcoming events, volunteer opportunities and the latest information from our campus community.</p>
            </article>

            <aside class="side-panel">
                <h3>More updates</h3>
                <ul>
                    <?php foreach ($newsItems as $item): ?>
                        <li><a href="<?php echo BASE_URL; ?>/news-details.php?id=<?php echo (int) ($item['id'] ?? 1); ?>"><?php echo e($item['title'] ?? 'School update'); ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </aside>
        </div>
    </section>
</main>

<?php require __DIR__ . '/includes/footer.php'; ?>
