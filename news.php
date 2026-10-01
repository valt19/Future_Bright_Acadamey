<?php
$pageTitle = 'News';
$currentPage = 'news.php';
require __DIR__ . '/includes/header.php';
$news = getLatestNews(8);
?>

<main>
    <section class="page-banner">
        <div class="container">
            <h1>News and announcements</h1>
        </div>
    </section>

    <section class="page-content">
        <div class="container">
            <div class="news-list">
                <?php foreach ($news as $item): ?>
                    <article class="article-card">
                        <img src="<?php echo BASE_URL; ?>/assets/images/placeholder-school.svg" alt="<?php echo e($item['title'] ?? 'School notice'); ?>">
                        <div class="article-body">
                            <div class="meta"><?php echo e(date('M j, Y', strtotime($item['created_at'] ?? date('Y-m-d')))); ?></div>
                            <h3><?php echo e($item['title'] ?? 'School news'); ?></h3>
                            <p><?php echo e($item['summary'] ?? 'A school update for our community.'); ?></p>
                            <a href="<?php echo BASE_URL; ?>/news-details.php?id=<?php echo (int) ($item['id'] ?? 1); ?>">Read more</a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
</main>

<?php require __DIR__ . '/includes/footer.php'; ?>
