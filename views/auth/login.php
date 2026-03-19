<?php
$page_title = $page_title ?? 'Tech Hub - Login';
include __DIR__ . '/../layout/header.php';
?>

<section class="page-heading">
    <h1>Login</h1>
</section>

<section class="two-column">
    <article class="section">
        <h2>Portal Access</h2>
        <?php if (!empty($error)) : ?>
            <div class="alert alert-error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <form method="post" class="stack">
            <div class="field">
                <label for="username">Username</label>
                <input class="input" type="text" id="username" name="username" required>
            </div>
            <div class="field">
                <label for="password">Password</label>
                <input class="input" type="password" id="password" name="password" required>
            </div>
            <div class="actions">
                <button class="btn" type="submit">Sign in</button>
            </div>
        </form>
    </article>

    <article class="section">
        <h2>Demo Accounts</h2>
        <ul>
            <li>Admin: <strong>admin</strong> / <strong>admin123</strong></li>
            <li>Teacher: <strong>teacher1</strong> / <strong>teacher123</strong></li>
        </ul>
        <p class="muted" style="margin-top:0.5rem;">
            Usernames are case-insensitive.
        </p>
        <p class="muted">
            Use these accounts to test admin and teacher dashboards.
        </p>
        <p style="margin-top: 1rem;">
            <a class="btn btn-secondary btn-small" href="index.php">Back to Home</a>
        </p>
    </article>
</section>

<?php include __DIR__ . '/../layout/footer.php'; ?>

