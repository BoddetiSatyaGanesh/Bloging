<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Blog4 - My Blog</title>
    <link rel="stylesheet" href="/blog4/assets/css/style.css">
</head>
<body>
<header>
    <nav>
        <a href="/blog4/index.php">Home</a>
        <?php if (isset($_SESSION['user_id'])): ?>
            | <a href="/blog4/dashboard.php">Dashboard</a>
            | <a href="/blog4/posts/create.php">Create Post</a>
            | <a href="/blog4/auth/logout.php">Logout</a>
        <?php else: ?>
            | <a href="/blog4/auth/login.php">Login</a>
            | <a href="/blog4/auth/register.php">Register</a>
        <?php endif; ?>
    </nav>
</header>
<div class="container">
