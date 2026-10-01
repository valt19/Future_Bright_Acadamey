<?php
$pageTitle = 'About';
$currentPage = 'about.php';
require __DIR__ . '/includes/header.php';
$settings = fetchSchoolSettings();
?>

<main>
    <section class="page-banner">
        <div class="container">
            <h1>About our school</h1>
        </div>
    </section>

    <section class="page-content">
        <div class="container detail-layout">
            <div>
                <h2>Our story</h2>
                <p><?php echo e($settings['school_name'] ?? 'Our school'); ?> was founded to provide a positive, ambitious and supportive learning environment for every child.</p>
                <p>We believe in creating a school community where students are encouraged to think deeply, act responsibly and grow with confidence.</p>

                <h3>Mission</h3>
                <p><?php echo e($settings['school_mission'] ?? 'To nurture learners through relevant, engaging and inclusive education.'); ?></p>

                <h3>Vision</h3>
                <p><?php echo e($settings['school_vision'] ?? 'To inspire excellence and character through purposeful learning.'); ?></p>

                <h3>Our values</h3>
                <ul>
                    <li>Respect and kindness</li>
                    <li>Academic excellence</li>
                    <li>Integrity and responsibility</li>
                    <li>Inclusivity and belonging</li>
                    <li>Innovation and creativity</li>
                </ul>
            </div>

            <aside class="side-panel">
                <h3>School overview</h3>
                <p><strong>School name:</strong> <?php echo e($settings['school_name'] ?? 'School Name'); ?></p>
                <p><strong>Location:</strong> <?php echo e($settings['school_address'] ?? 'Address not set yet'); ?></p>
                <p><strong>Contact:</strong> <?php echo e($settings['school_email'] ?? 'Email not set yet'); ?></p>
            </aside>
        </div>
    </section>
</main>

<?php require __DIR__ . '/includes/footer.php'; ?>
