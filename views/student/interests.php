<?php
$page_title = $page_title ?? 'My Interests';
include __DIR__ . '/../layout/header.php';
?>

<section class="page-heading">
    <h1>Manage your interest registrations</h1>
</section>

<?php if (!empty($message)) : ?>
    <div class="alert alert-success"><?php echo htmlspecialchars($message); ?></div>
<?php endif; ?>

<section class="section">
    <form method="post" class="stack">
        <div class="field">
            <label for="email">Enter the email you used to register</label>
            <input class="input" type="email" id="email" name="email" required
                   value="<?php echo htmlspecialchars($email); ?>">
        </div>
        <div class="actions">
            <button class="btn btn-small" type="submit" name="lookup" value="1">
                Find my registrations
            </button>
        </div>
    </form>
</section>

<?php if ($email !== '') : ?>
    <section class="section" style="margin-top:1rem;">
        <h2>Current registrations for <?php echo htmlspecialchars($email); ?></h2>
        <?php if (empty($interests)) : ?>
            <p class="muted">No active interest registrations found.</p>
        <?php else : ?>
            <table class="table">
                <thead>
                <tr>
                    <th>Programme</th>
                    <th>Registered at</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($interests as $interest) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($interest['ProgrammeName']); ?></td>
                        <td><?php echo htmlspecialchars($interest['RegisteredAt']); ?></td>
                        <td>
                            <form method="post" style="display:inline;">
                                <input type="hidden" name="interest_id"
                                       value="<?php echo (int)$interest['InterestID']; ?>">
                                <input type="hidden" name="email"
                                       value="<?php echo htmlspecialchars($email); ?>">
                                <button class="btn btn-secondary btn-small" type="submit" name="withdraw" value="1">
                                    Withdraw
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </section>
<?php endif; ?>

<?php include __DIR__ . '/../layout/footer.php'; ?>

