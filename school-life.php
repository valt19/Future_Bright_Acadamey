<?php
$pageTitle = 'School Life';
$currentPage = 'school-life.php';
require __DIR__ . '/includes/header.php';
?>

<main>
    <section class="page-banner">
        <div class="container">
            <h1>School life</h1>
        </div>
    </section>

    <section class="page-content">
        <div class="container grid-3">
            <article class="card">
                <div class="icon-badge">S</div>
                <h3>Sports</h3>
                <p>Students participate in athletics, team games and active adventures that build confidence and leadership.</p>
            </article>
            <article class="card">
                <div class="icon-badge">C</div>
                <h3>Clubs and arts</h3>
                <p>Creative communities support music, dance, debate, coding and design opportunities beyond the classroom.</p>
            </article>
            <article class="card">
                <div class="icon-badge">L</div>
                <h3>Leadership</h3>
                <p>Students are encouraged to take on responsibility through prefect roles, projects and peer mentoring.</p>
            </article>
        </div>
    </section>
</main>

<?php require __DIR__ . '/includes/footer.php'; ?>
