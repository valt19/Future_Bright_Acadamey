<?php
$settings = fetchSchoolSettings();
$siteName = $settings['school_name'] ?? 'School Website';
$currentPage = $currentPage ?? basename($_SERVER['PHP_SELF']);
$navItems = [
    ['label' => 'Home', 'url' => BASE_URL . '/', 'file' => 'index.php'],
    ['label' => 'About', 'url' => BASE_URL . '/about.php', 'file' => 'about.php'],
    ['label' => 'Academics', 'url' => BASE_URL . '/academics.php', 'file' => 'academics.php'],
    ['label' => 'Admissions', 'url' => BASE_URL . '/admissions.php', 'file' => 'admissions.php'],
    ['label' => 'School Life', 'url' => BASE_URL . '/school-life.php', 'file' => 'school-life.php'],
    ['label' => 'News', 'url' => BASE_URL . '/news.php', 'file' => 'news.php'],
    ['label' => 'Events', 'url' => BASE_URL . '/events.php', 'file' => 'events.php'],
    ['label' => 'Gallery', 'url' => BASE_URL . '/gallery.php', 'file' => 'gallery.php'],
    ['label' => 'Contact', 'url' => BASE_URL . '/contact.php', 'file' => 'contact.php'],
];
?>
<header class="site-header">
    <div class="container nav-wrap">
        <a href="<?php echo e(siteUrl()); ?>" class="brand" aria-label="Home">
            <span class="brand-mark">S</span>
            <span>
                <strong><?php echo e($siteName); ?></strong>
                <small><?php echo e($settings['school_tagline'] ?? 'Learning with Purpose'); ?></small>
            </span>
        </a>

        <button class="nav-toggle" aria-label="Open menu" type="button">Menu</button>

        <nav class="main-nav" aria-label="Main navigation">
            <ul>
                <?php foreach ($navItems as $item): ?>
                    <li>
                        <a href="<?php echo $item['url']; ?>" class="<?php echo ($item['file'] === $currentPage) ? 'active' : ''; ?>">
                            <?php echo e($item['label']); ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </nav>
    </div>
</header>
