<?php
$pageTitle = 'Gallery';
$currentPage = 'gallery.php';
require __DIR__ . '/includes/header.php';
$galleryItems = getGalleryItems();
?>

<main>
    <section class="page-banner">
        <div class="container">
            <h1>School gallery</h1>
        </div>
    </section>

    <section class="page-content">
        <div class="container">
            <div class="gallery-grid" style="grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));">
                <?php foreach ($galleryItems as $index => $item): ?>
                    <?php $imagePath = $item['image_path'] ?? '/assets/images/placeholder-school.svg'; ?>
                    <article class="gallery-item">
                        <img src="<?php echo BASE_URL . e($imagePath); ?>" alt="<?php echo e($item['title'] ?? 'School gallery image'); ?>">
                        <div class="article-body">
                            <h3><?php echo e($item['title'] ?? 'Campus highlight'); ?></h3>
                            <p><?php echo e($item['caption'] ?? 'Student life, learning spaces and school celebrations.'); ?></p>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
</main>

<?php require __DIR__ . '/includes/footer.php'; ?>
