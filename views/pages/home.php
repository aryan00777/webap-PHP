<?php
$page_title = $page_title ?? 'Tech Hub - Home';
include __DIR__ . '/../layout/header.php';
?>

<section class="hero">
    <img src="assets/campus-hero.png" alt="University campus building">
    <div class="hero-content">
        <span class="badge">Tech-Driven University Experience</span>
        <h1>Welcome to Tech Hub</h1>
        <p>
            Discover a modern learning environment where innovation, research, and industry collaboration
            prepare you for real-world impact.
        </p>
        <div class="hero-actions">
            <a class="btn" href="index.php?route=home/index">Explore Programmes</a>
            <a class="btn btn-secondary" href="index.php?route=home/about">Why Tech Hub</a>
        </div>
    </div>
</section>

<section class="stats-strip">
    <article>
        <h3>16,000+</h3>
        <p>Active students</p>
    </article>
    <article>
        <h3>120+</h3>
        <p>Industry mentors</p>
    </article>
    <article>
        <h3>94%</h3>
        <p>Graduate employability</p>
    </article>
    <article>
        <h3>60+</h3>
        <p>Student societies</p>
    </article>
</section>

<section class="page-heading" style="margin-top: 1.2rem;">
    <h1>Faculties and Schools</h1>
    <span class="badge">Designed for the Future</span>
</section>

<section class="grid" style="margin-bottom: 1rem;">
    <article class="card accent-card">
        <h2>School of Computing</h2>
        <p>AI, cyber security, software engineering, and data science with hands-on lab projects.</p>
    </article>
    <article class="card accent-card">
        <h2>School of Design & Media</h2>
        <p>Creative technologies, interaction design, digital media production, and visual communication.</p>
    </article>
    <article class="card accent-card">
        <h2>School of Business & Innovation</h2>
        <p>Entrepreneurship, finance, marketing, and leadership with startup incubator opportunities.</p>
    </article>
</section>

<section class="two-column">
    <article class="section">
        <h2>Why students choose Tech Hub</h2>
        <ul>
            <?php foreach (($funFacts ?? []) as $fact) : ?>
                <li><?php echo htmlspecialchars($fact); ?></li>
            <?php endforeach; ?>
            <li>Dedicated career center with internship placement support.</li>
            <li>Flexible pathways from foundation to postgraduate study.</li>
        </ul>
    </article>
    <article class="section">
        <h2>Admissions and Open Days</h2>
        <p class="muted">
            Visit Tech Hub to meet academics, tour teaching facilities, and get tailored advice on
            entry requirements and scholarships.
        </p>
        <div class="hero-actions" style="margin-top: 1rem;">
            <a class="btn btn-small" href="index.php?route=home/contact">Book a campus visit</a>
            <a class="btn btn-secondary btn-small" href="index.php?route=auth/login">Login</a>
        </div>
    </article>
</section>

<?php include __DIR__ . '/../layout/footer.php'; ?>
