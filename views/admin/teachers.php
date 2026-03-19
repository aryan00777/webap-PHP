<?php
$page_title = $page_title ?? 'Manage teachers';
include __DIR__ . '/../layout/header.php';
?>

<section class="page-heading">
    <h1>Manage teachers</h1>
    <span class="badge">Admin only</span>
</section>

<?php if (!empty($message)) : ?>
    <div class="alert alert-success"><?php echo htmlspecialchars($message); ?></div>
<?php endif; ?>
<?php if (!empty($error)) : ?>
    <div class="alert alert-error"><?php echo htmlspecialchars($error); ?></div>
<?php endif; ?>

<section class="two-column">
    <div class="section">
        <h2>Existing teachers</h2>
        <?php if (empty($teachers)) : ?>
            <p class="muted">No teachers in the system yet.</p>
        <?php else : ?>
            <div class="table-wrap">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($teachers as $t) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($t['Name'] ?? ''); ?></td>
                            <td>
                                <div class="stack" style="gap:0.25rem;">
                                    <form method="post" class="inline-flex-form">
                                        <input type="hidden" name="StaffID" value="<?php echo (int)$t['StaffID']; ?>">
                                        <input
                                            class="input"
                                            type="text"
                                            name="teacher_name"
                                            value="<?php echo htmlspecialchars($t['Name'] ?? ''); ?>"
                                            required
                                        >
                                        <button class="btn btn-small" type="submit" name="update_teacher" value="1">
                                            Update
                                        </button>
                                    </form>

                                    <form method="post" class="inline-form"
                                          onsubmit="return confirm('Delete this teacher? Module leadership will be detached.');">
                                        <input type="hidden" name="StaffID" value="<?php echo (int)$t['StaffID']; ?>">
                                        <button class="btn btn-secondary btn-small" type="submit" name="delete_teacher" value="1">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>

    <aside class="section">
        <h2>Create a new teacher</h2>
        <form method="post" class="stack">
            <div class="field">
                <label for="teacher_name">Teacher name</label>
                <input class="input" type="text" id="teacher_name" name="teacher_name" required>
            </div>
            <div class="actions">
                <button class="btn" type="submit" name="create_teacher" value="1">
                    Add teacher
                </button>
            </div>
        </form>

        <p class="muted" style="margin-top:0.75rem;">
            Teacher login accounts are demo-based in this project; this page manages the database records used for module leader assignments.
        </p>
    </aside>
</section>

<p class="muted top-links">
    <a href="index.php?route=admin/dashboard">Back to dashboard</a> ·
    <a href="index.php?route=admin/modules">Assign module leaders</a> ·
    <a href="index.php?route=auth/logout">Log out</a>
</p>

<?php include __DIR__ . '/../layout/footer.php'; ?>

