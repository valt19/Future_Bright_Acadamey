<?php
$pageTitle = 'Events';
$currentPage = 'events.php';
require __DIR__ . '/includes/header.php';
$events = getUpcomingEvents(8);
?>

<main>
    <section class="page-banner">
        <div class="container">
            <h1>Upcoming events</h1>
        </div>
    </section>

    <section class="page-content">
        <div class="container">
            <div class="events-list">
                <?php foreach ($events as $event): ?>
                    <article class="event-card">
                        <div class="event-body">
                            <div class="meta"><?php echo e(date('M j, Y', strtotime($event['event_date'] ?? date('Y-m-d')))); ?></div>
                            <h3><?php echo e($event['title'] ?? 'School event'); ?></h3>
                            <p><?php echo e($event['description'] ?? 'A school event for students and families.'); ?></p>
                            <p><strong>Location:</strong> <?php echo e($event['location'] ?? 'School campus'); ?></p>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
</main>

<?php require __DIR__ . '/includes/footer.php'; ?>
