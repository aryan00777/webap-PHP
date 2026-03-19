<?php
$page_title = $page_title ?? ($programme['ProgrammeName'] ?? 'Programme');
include __DIR__ . '/../layout/header.php';
?>

<section class="page-heading">
    <h1><?php echo htmlspecialchars($programme['ProgrammeName']); ?></h1>
    <span class="badge"><?php echo htmlspecialchars($programme['LevelName'] ?? ''); ?></span>
</section>

<section class="two-column">
    <div class="section">
        <h2>Programme overview</h2>
        <p><?php echo nl2br(htmlspecialchars($programme['Description'])); ?></p>
        <?php if (!empty($programme['LeaderName'])) : ?>
            <p class="muted">Programme leader: <?php echo htmlspecialchars($programme['LeaderName']); ?></p>
        <?php endif; ?>

        <?php if (!empty($modules_by_year)) : ?>
            <h2>Modules by year</h2>
            <?php foreach ($modules_by_year as $year => $modules) : ?>
                <h3 class="muted">Year <?php echo (int)$year; ?></h3>
                <ul>
                    <?php foreach ($modules as $module) : ?>
                        <li>
                            <strong><?php echo htmlspecialchars($module['ModuleName']); ?></strong>
                            <?php if (!empty($module['ModuleLeader'])) : ?>
                                <span class="muted">— Module leader: <?php echo htmlspecialchars($module['ModuleLeader']); ?></span>
                            <?php endif; ?>
                            <?php if (!empty($module['Description'])) : ?>
                                <div class="muted"><?php echo htmlspecialchars($module['Description']); ?></div>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endforeach; ?>
        <?php else : ?>
            <p class="muted">Modules for this programme have not been added yet.</p>
        <?php endif; ?>
    </div>

    <aside class="section">
        <h2>Register your interest</h2>
        <p class="muted">Share your contact details to receive updates about this programme, including open days and application deadlines.</p>

        <?php if (!empty($interest_message)) : ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($interest_message); ?></div>
        <?php elseif (!empty($interest_error)) : ?>
            <div class="alert alert-error"><?php echo htmlspecialchars($interest_error); ?></div>
        <?php endif; ?>

        <form method="post">
            <div class="stack">
                <div class="field">
                    <label for="student_name">Full name</label>
                    <input class="input" type="text" id="student_name" name="student_name" required>
                </div>
                <div class="field">
                    <label for="email">Email address</label>
                    <input class="input" type="email" id="email" name="email" required>
                </div>
                <div class="actions">
                    <button class="btn" type="submit" name="register_interest" value="1">
                        Register interest
                    </button>
                </div>
            </div>
        </form>

        <p class="muted" style="margin-top:0.75rem;">
            You can review or withdraw your interest later using the "My Interests" link in the top navigation.
        </p>
    </aside>
</section>

<?php include __DIR__ . '/../layout/footer.php'; ?>

