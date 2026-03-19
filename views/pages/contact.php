<?php
$page_title = $page_title ?? 'Tech Hub - Contact';
include __DIR__ . '/../layout/header.php';
?>

<section class="page-heading">
    <h1>Contact Us</h1>
    <span class="badge">We are here to help</span>
</section>

<section class="two-column">
    <article class="section">
        <h2>General Enquiries</h2>
        <ul>
            <li>Email: hello@studentcoursehub.edu</li>
            <li>Phone: +44 020 7946 1020</li>
            <li>Office Hours: Mon-Fri, 9:00 AM to 5:00 PM</li>
        </ul>

        <h2 style="margin-top: 1rem;">Campus Location</h2>
        <p class="muted">
            Tech Hub Centre, 24 Learning Avenue, Brookfield City, BF2 8LA
        </p>
    </article>

    <article class="section">
        <h2>Need a fast answer?</h2>
        <p class="muted">
            Tell us what you are looking for and our team will help you choose the right programme path.
        </p>
        <ul>
            <li>Admissions support and deadline reminders</li>
            <li>Scholarship and funding guidance</li>
            <li>Open day registration and campus tours</li>
        </ul>

        <p style="margin-top: 1rem;">
            <a class="btn btn-small" href="index.php?route=home/index">View all programmes</a>
        </p>
    </article>
</section>

<?php include __DIR__ . '/../layout/footer.php'; ?>

