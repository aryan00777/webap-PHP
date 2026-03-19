<?php
$page_title = $page_title ?? 'Tech Hub';
include __DIR__ . '/../layout/header.php';
?>

<section class="page-heading">
    <h1>Welcome to Tech Hub</h1>
    <span class="badge"><?php echo count($programmes); ?> programmes</span>
</section>

<section class="section" style="margin-bottom:1.25rem;">
    <h2>About our University</h2>
    <p class="muted" style="margin:0;">
        Discover undergraduate and postgraduate programmes, explore modules with their module leaders, and
        register your interest to receive updates.
    </p>

    <div class="grid" style="margin-top:1rem;">
        <article class="card" style="min-height:auto;">
            <h2>Browse Programmes</h2>
            <p>Use search and filters to find your match by name and level.</p>
        </article>
        <article class="card" style="min-height:auto;">
            <h2>Meet Module Leaders</h2>
            <p>See who leads each module inside every programme overview.</p>
        </article>
        <article class="card" style="min-height:auto;">
            <h2>Register Interest</h2>
            <p>Share your details and get notified about open days and deadlines.</p>
        </article>
    </div>
</section>

<section class="filters">
    <form method="get" action="index.php">
        <input type="hidden" name="route" value="home/index">
        <div class="field">
            <label for="q">Search by keyword</label>
            <input class="input" type="text" id="q" name="q" placeholder="e.g. Cyber Security"
                   value="<?php echo htmlspecialchars($q); ?>">
        </div>
        <div class="field">
            <label for="level">Level</label>
            <select class="select" id="level" name="level">
                <option value="">All levels</option>
                <option value="ug" <?php if ($level === 'ug') echo 'selected'; ?>>Undergraduate</option>
                <option value="pg" <?php if ($level === 'pg') echo 'selected'; ?>>Postgraduate</option>
            </select>
        </div>
        <div class="field actions">
            <button class="btn btn-small" type="submit">Apply filters</button>
        </div>
    </form>
</section>

<?php if (empty($programmes)) : ?>
    <p class="muted">No programmes found. Try adjusting your filters.</p>
<?php else : ?>
    <section class="grid programmes-grid">
        <?php foreach ($programmes as $programme) : ?>
            <article class="card programme-card">
                <h2><?php echo htmlspecialchars($programme['ProgrammeName']); ?></h2>
                <p><?php echo htmlspecialchars($programme['Description']); ?></p>
                <div class="card-footer">
                    <div class="stack">
                        <span class="pill"><?php echo htmlspecialchars($programme['LevelName'] ?? ''); ?></span>
                        <?php if (!empty($programme['LeaderName'])) : ?>
                            <span class="muted">Programme leader: <?php echo htmlspecialchars($programme['LeaderName']); ?></span>
                        <?php endif; ?>
                    </div>
                    <a class="btn btn-secondary btn-small"
                       href="index.php?route=student/programme&id=<?php echo (int)$programme['ProgrammeID']; ?>">
                        View details
                    </a>
                </div>
            </article>
        <?php endforeach; ?>
    </section>
<?php endif; ?>

<?php include __DIR__ . '/../layout/footer.php'; ?>


