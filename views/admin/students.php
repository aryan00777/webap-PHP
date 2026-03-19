<?php
$page_title = $page_title ?? 'Mailing list';
include __DIR__ . '/../layout/header.php';
?>

<section class="page-heading">
    <h1>Interested students</h1>
    <span class="badge">Admin only</span>
</section>

<section class="section">
    <p class="muted">
        This table lists all students who have registered interest in any programme. Use the export button to
        download a CSV file that can be imported into your mailing tool.
    </p>
    <p>
        <a class="btn btn-small" href="index.php?route=admin/students&export=csv">Export as CSV</a>
    </p>

    <?php if (empty($rows)) : ?>
        <p class="muted">No registrations yet.</p>
    <?php else : ?>
        <div class="table-wrap">
            <table class="table">
                <thead>
                <tr>
                    <th>Programme</th>
                    <th>Student name</th>
                    <th>Email</th>
                    <th>Registered at</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($rows as $row) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['ProgrammeName']); ?></td>
                        <td><?php echo htmlspecialchars($row['StudentName']); ?></td>
                        <td><?php echo htmlspecialchars($row['Email']); ?></td>
                        <td><?php echo htmlspecialchars($row['RegisteredAt']); ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</section>

<p class="muted top-links">
    <a href="index.php?route=admin/dashboard">Back to dashboard</a> ·
    <a href="index.php?route=auth/logout">Log out</a>
</p>

<?php include __DIR__ . '/../layout/footer.php'; ?>

