<?php
$page_title = $page_title ?? 'Admin dashboard';
include __DIR__ . '/../layout/header.php';
?>

<section class="page-heading">
    <h1>Admin dashboard</h1>
    <span class="badge">Signed in as admin</span>
</section>

<section class="grid" style="margin-bottom:1.5rem;">
    <article class="card">
        <h2>Programmes</h2>
        <p>Manage the programmes shown to students, including level, description, and leader.</p>
        <div class="card-footer">
            <span class="pill"><?php echo (int)$counts['programmes']; ?> total</span>
            <a class="btn btn-secondary btn-small" href="index.php?route=admin/programmes">Manage</a>
        </div>
    </article>
    <article class="card">
        <h2>Mailing list</h2>
        <p>View and export a list of students who have registered interest in programmes.</p>
        <div class="card-footer">
            <span class="pill"><?php echo (int)$counts['interests']; ?> registrations</span>
            <a class="btn btn-secondary btn-small" href="index.php?route=admin/students">View list</a>
        </div>
    </article>
    <article class="card">
        <h2>Modules overview</h2>
        <p>Modules are linked to programmes and staff members. Use this count for quick checks.</p>
        <div class="card-footer">
            <span class="pill"><?php echo (int)$counts['modules']; ?> modules</span>
            <a class="btn btn-secondary btn-small" href="index.php">View as student</a>
        </div>
    </article>
    <article class="card">
        <h2>Manage teachers</h2>
        <p>Create/delete teachers (stored in `Staff`) for module leader assignment.</p>
        <div class="card-footer">
            <a class="btn btn-secondary btn-small" href="index.php?route=admin/teachers">Manage</a>
        </div>
    </article>
    <article class="card">
        <h2>Assign module leaders</h2>
        <p>Assign or change the teacher responsible for each module.</p>
        <div class="card-footer">
            <a class="btn btn-secondary btn-small" href="index.php?route=admin/modules">Assign</a>
        </div>
    </article>
</section>

<p class="muted">
    Need to sign out? <a href="index.php?route=auth/logout">Log out</a>
</p>

<?php include __DIR__ . '/../layout/footer.php'; ?>

