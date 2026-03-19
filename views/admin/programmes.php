<?php
$page_title = $page_title ?? 'Manage programmes';
include __DIR__ . '/../layout/header.php';
?>

<section class="page-heading">
    <h1>Manage programmes</h1>
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
        <h2>Existing programmes</h2>
        <?php if (empty($programmes)) : ?>
            <p class="muted">No programmes in the system yet.</p>
        <?php else : ?>
            <div class="table-wrap">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Level</th>
                        <th>Description</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($programmes as $programme) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($programme['ProgrammeName']); ?></td>
                            <td><?php echo htmlspecialchars($programme['LevelName'] ?? ''); ?></td>
                            <td><?php echo htmlspecialchars($programme['Description'] ?? ''); ?></td>
                            <td>
                                <a class="btn btn-small"
                                   href="index.php?route=admin/programmes&edit=<?php echo (int)$programme['ProgrammeID']; ?>">
                                    Edit
                                </a>
                                <form method="post" class="inline-form"
                                      onsubmit="return confirm('Delete this programme? This will also remove related interests.');">
                                    <input type="hidden" name="ProgrammeID"
                                           value="<?php echo (int)$programme['ProgrammeID']; ?>">
                                    <button class="btn btn-secondary btn-small" type="submit" name="delete" value="1">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>

    <aside class="section">
        <?php if (!empty($editProgramme)) : ?>
            <h2>Edit programme</h2>
            <form method="post" class="stack">
                <input type="hidden" name="ProgrammeID" value="<?php echo (int)$editProgramme['ProgrammeID']; ?>">
                <div class="field">
                    <label for="ProgrammeName">Name</label>
                    <input class="input" type="text" id="ProgrammeName" name="ProgrammeName" required
                           value="<?php echo htmlspecialchars($editProgramme['ProgrammeName']); ?>">
                </div>
                <div class="field">
                    <label for="LevelID">Level</label>
                    <select class="select" id="LevelID" name="LevelID" required>
                        <option value="">Choose a level</option>
                        <?php foreach ($levels as $id => $name) : ?>
                            <option value="<?php echo (int)$id; ?>"
                                <?php if ((int)($editProgramme['LevelID'] ?? 0) === (int)$id) echo 'selected'; ?>>
                                <?php echo htmlspecialchars($name); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="field">
                    <label for="Description">Short description</label>
                    <textarea class="textarea" id="Description" name="Description" rows="4"><?php echo htmlspecialchars($editProgramme['Description'] ?? ''); ?></textarea>
                </div>
                <div class="actions" style="display:flex;gap:0.5rem;align-items:center;flex-wrap:wrap;">
                    <button class="btn" type="submit" name="update" value="1">
                        Save changes
                    </button>
                    <a class="btn btn-secondary btn-small" href="index.php?route=admin/programmes">Cancel</a>
                </div>
            </form>
        <?php else : ?>
            <h2>Create a new programme</h2>
            <form method="post" class="stack">
                <div class="field">
                    <label for="ProgrammeName">Name</label>
                    <input class="input" type="text" id="ProgrammeName" name="ProgrammeName" required>
                </div>
                <div class="field">
                    <label for="LevelID">Level</label>
                    <select class="select" id="LevelID" name="LevelID" required>
                        <option value="">Choose a level</option>
                        <?php foreach ($levels as $id => $name) : ?>
                            <option value="<?php echo (int)$id; ?>">
                                <?php echo htmlspecialchars($name); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="field">
                    <label for="Description">Short description</label>
                    <textarea class="textarea" id="Description" name="Description" rows="4"></textarea>
                </div>
                <div class="actions">
                    <button class="btn" type="submit" name="create" value="1">
                        Add programme
                    </button>
                </div>
            </form>
        <?php endif; ?>
        <p class="muted" style="margin-top:0.75rem;">
            To keep the code simple, this page only covers basic fields. You could extend it to manage images,
            module links, and leaders.
        </p>
    </aside>
</section>

<p class="muted top-links">
    <a href="index.php?route=admin/dashboard">Back to dashboard</a> ·
    <a href="index.php?route=auth/logout">Log out</a>
</p>

<?php include __DIR__ . '/../layout/footer.php'; ?>

