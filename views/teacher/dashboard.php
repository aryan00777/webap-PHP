<?php
$page_title = $page_title ?? 'Teacher dashboard';
include __DIR__ . '/../layout/header.php';
?>

<section class="page-heading">
    <h1>Teacher dashboard</h1>
    <span class="badge">
        Signed in as
        <?php echo htmlspecialchars($staff['Name'] ?? ($_SESSION['username'] ?? 'Teacher')); ?>
    </span>
</section>

<section class="two-column">
    <div class="section">
        <h2>Modules you lead</h2>
        <?php if (empty($modules)) : ?>
            <p class="muted">No modules are linked to your profile yet.</p>
        <?php else : ?>
            <ul>
                <?php foreach ($modules as $module) : ?>
                    <li>
                        <strong><?php echo htmlspecialchars($module['ModuleName']); ?></strong>
                        <?php if (!empty($module['Description'])) : ?>
                            <div class="muted"><?php echo htmlspecialchars($module['Description']); ?></div>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>

    <aside class="section">
        <h2>Programmes including your modules</h2>
        <?php if (empty($programmes)) : ?>
            <p class="muted">No programmes currently list your modules.</p>
        <?php else : ?>
            <ul>
                <?php foreach ($programmes as $programme) : ?>
                    <li>
                        <strong><?php echo htmlspecialchars($programme['ProgrammeName']); ?></strong>
                        <span class="muted"> (<?php echo htmlspecialchars($programme['LevelName'] ?? ''); ?>)</span>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </aside>
</section>

<p class="muted top-links">
    <a href="index.php">View site as a student</a> ·
    <a href="index.php?route=auth/logout">Log out</a>
</p>

<?php include __DIR__ . '/../layout/footer.php'; ?>

