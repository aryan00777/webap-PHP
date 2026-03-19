<?php
$page_title = $page_title ?? 'Tech Hub - About';
include __DIR__ . '/../layout/header.php';
?>

<section class="page-heading">
    <h1>About Tech Hub</h1>
    <span class="badge">Who We Are</span>
</section>

<section class="two-column">
    <article class="section">
        <h2>Our Mission</h2>
        <p class="muted">
            We connect students with clear programme information, module highlights, and practical guidance
            so they can choose courses with confidence.
        </p>

        <h2 style="margin-top: 1rem;">What makes us different</h2>
        <ul>
            <li>Transparent course information with easy-to-read summaries.</li>
            <li>Friendly support from staff and student ambassadors.</li>
            <li>Focus on industry-ready learning and project work.</li>
        </ul>
    </article>

    <article class="section">
        <h2>Quick Stats</h2>
        <ul>
            <li>95% of students join at least one practical workshop.</li>
            <li>18 partner companies offer live project briefs each year.</li>
            <li>Average class feedback score: 4.6 / 5.</li>
        </ul>

        <p style="margin-top: 1rem;">
            <a class="btn btn-secondary btn-small" href="index.php?route=home/contact">Contact our team</a>
        </p>
    </article>
</section>

<?php include __DIR__ . '/../layout/footer.php'; ?>

