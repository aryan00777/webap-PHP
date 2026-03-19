<?php
$page_title = $page_title ?? 'Assign module leaders';
include __DIR__ . '/../layout/header.php';
?>

<section class="page-heading">
    <h1>Assign module leaders</h1>
    <span class="badge">Admin only</span>
</section>

<?php if (!empty($message)) : ?>
    <div class="alert alert-success"><?php echo htmlspecialchars($message); ?></div>
<?php endif; ?>
<?php if (!empty($error)) : ?>
    <div class="alert alert-error"><?php echo htmlspecialchars($error); ?></div>
<?php endif; ?>

<section class="section">
    <h2>Modules and their teachers</h2>
    <?php if (empty($modules)) : ?>
        <p class="muted">No modules found in the system yet.</p>
    <?php else : ?>
        <div class="table-wrap">
            <table class="table">
                <thead>
                <tr>
                    <th>Module</th>
                    <th>Current leader</th>
                    <th>Change leader</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($modules as $m) : ?>
                    <tr>
                        <td>
                            <strong><?php echo htmlspecialchars($m['ModuleName'] ?? ''); ?></strong>
                            <?php if (!empty($m['Description'])) : ?>
                                <div class="muted"><?php echo htmlspecialchars($m['Description']); ?></div>
                            <?php endif; ?>
                        </td>
                        <td><?php echo htmlspecialchars($m['ModuleLeader'] ?? ''); ?></td>
                        <td>
                            <?php $currentLeaderId = (int)($m['ModuleLeaderID'] ?? 0); ?>
                            <form method="post" class="stack" style="gap:0.5rem;">
                                <input type="hidden" name="ModuleID" value="<?php echo (int)$m['ModuleID']; ?>">
                                <div class="field">
                                    <label class="muted" for="ModuleLeaderID_<?php echo (int)$m['ModuleID']; ?>">Leader</label>
                                    <select
                                        class="select"
                                        id="ModuleLeaderID_<?php echo (int)$m['ModuleID']; ?>"
                                        name="ModuleLeaderID"
                                        required
                                    >
                                        <option value="0">None</option>
                                        <?php foreach ($teachers as $t) : ?>
                                            <?php $teacherId = (int)$t['StaffID']; ?>
                                            <option value="<?php echo $teacherId; ?>" <?php echo $currentLeaderId === $teacherId ? 'selected' : ''; ?>>
                                                <?php echo htmlspecialchars($t['Name'] ?? ''); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="actions">
                                    <button class="btn btn-small" type="submit" name="update_leader" value="1">
                                        Update
                                    </button>
                                </div>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</section>

<p class="muted top-links">
    <a href="index.php?route=admin/dashboard">Back to dashboard</a> ·
    <a href="index.php?route=admin/teachers">Manage teachers</a> ·
    <a href="index.php?route=auth/logout">Log out</a>
</p>

<?php include __DIR__ . '/../layout/footer.php'; ?>

