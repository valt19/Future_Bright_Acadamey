<?php
$pageTitle = 'Home';
$currentPage = 'index.php';
require __DIR__ . '/includes/header.php';
$settings = fetchSchoolSettings();
$news = getLatestNews(3);
$events = getUpcomingEvents(3);
?>

<main>
    <section class="hero">
        <div class="container hero-content">
            <span class="meta" style="color: rgba(255,255,255,0.8); text-transform: uppercase; letter-spacing: 0.12em;">Welcome to</span>
            <h1><?php echo e($settings['school_name'] ?? 'Future Bright Academy'); ?></h1>
            <p><?php echo e($settings['school_tagline'] ?? 'Learning with Purpose and Heart'); ?></p>
            <div class="hero-actions">
                <a class="btn btn-primary" href="<?php echo BASE_URL; ?>/admissions.php">Apply now</a>
                <a class="btn btn-secondary" href="<?php echo BASE_URL; ?>/about.php">Discover our school</a>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="section-heading">
                <h2>Why families choose us</h2>
                <p>We create a caring, ambitious and inclusive environment where students can grow academically, socially and personally.</p>
            </div>
            <div class="grid-3">
                <article class="card">
                    <div class="icon-badge">01</div>
                    <h3>Academic excellence</h3>
                    <p>Strong teaching, a structured curriculum and high expectations help students achieve meaningful progress.</p>
                </article>
                <article class="card">
                    <div class="icon-badge">02</div>
                    <h3>Whole child growth</h3>
                    <p>We focus on character, confidence, teamwork, creativity and leadership alongside academic learning.</p>
                </article>
                <article class="card">
                    <div class="icon-badge">03</div>
                    <h3>Safe, caring culture</h3>
                    <p>Students thrive in a community built on respect, belonging and support for every learner.</p>
                </article>
            </div>
        </div>
    </section>

    <section class="section section-alt">
        <div class="container">
            <div class="section-heading">
                <h2>School at a glance</h2>
            </div>
            <div class="stats-grid">
                <div class="stats-item"><strong>1200+</strong><span>Students</span></div>
                <div class="stats-item"><strong>75+</strong><span>Teachers</span></div>
                <div class="stats-item"><strong>18</strong><span>Academic clubs</span></div>
                <div class="stats-item"><strong>98%</strong><span>Parent satisfaction</span></div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="section-heading">
                <h2>Latest news</h2>
            </div>
            <div class="news-list">
                <?php foreach ($news as $item): ?>
                    <article class="article-card">
                        <img src="<?php echo BASE_URL; ?>/assets/images/placeholder-school.svg" alt="<?php echo e($item['title'] ?? 'School story'); ?>">
                        <div class="article-body">
                            <div class="meta"><?php echo e(date('M j, Y', strtotime($item['created_at'] ?? date('Y-m-d')))); ?></div>
                            <h3><?php echo e($item['title'] ?? 'School update'); ?></h3>
                            <p><?php echo e($item['summary'] ?? 'A school update for our community.'); ?></p>
                            <a href="<?php echo BASE_URL; ?>/news-details.php?id=<?php echo (int) ($item['id'] ?? 1); ?>">Read more</a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="section section-alt">
        <div class="container">
            <div class="section-heading">
                <h2>Upcoming events</h2>
            </div>
            <div class="events-list">
                <?php foreach ($events as $event): ?>
                    <article class="event-card">
                        <div class="event-body">
                            <div class="meta"><?php echo e(date('M j, Y', strtotime($event['event_date'] ?? date('Y-m-d')))); ?></div>
                            <h3><?php echo e($event['title'] ?? 'Featured event'); ?></h3>
                            <p><?php echo e($event['description'] ?? 'A school event for students and families.'); ?></p>
                            <p><strong>Location:</strong> <?php echo e($event['location'] ?? 'School campus'); ?></p>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="section-heading">
                <h2>Admissions</h2>
            </div>
            <div class="card" style="max-width: 760px; margin: 0 auto; text-align: center;">
                <h3>We are now accepting applications</h3>
                <p>Start your child’s journey with a school that values strong foundations, curiosity and community.</p>
                <a class="btn btn-primary" href="<?php echo BASE_URL; ?>/admissions.php">Learn about admissions</a>
            </div>
        </div>
    </section>
</main>

<?php require __DIR__ . '/includes/footer.php'; ?>
