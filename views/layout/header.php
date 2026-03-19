<?php
if (!isset($page_title)) {
    $page_title = 'Tech Hub';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($page_title); ?></title>
    <link rel="stylesheet" href="assets/styles.css">
</head>
<body>
<header class="site-header">
    <div class="container header-inner">
        <a href="index.php" class="logo">Tech Hub</a>
        <nav class="nav">
            <a href="index.php">Home</a>
            <a href="index.php?route=home/about">About</a>
            <a href="index.php?route=home/contact">Contact</a>
            <a href="index.php?route=home/index">Programmes</a>
            <a href="index.php?route=student/interests">My Interests</a>
            <a href="index.php?route=auth/login">Login</a>
        </nav>
    </div>
</header>
<main class="site-main container">

