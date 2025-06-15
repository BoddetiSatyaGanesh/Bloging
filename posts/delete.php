<?php
include '../includes/config.php';
include '../auth/auth-check.php';

$post_id = $_GET['id'];
$user_id = $_SESSION['user_id'];

$conn->query("DELETE FROM posts WHERE id=$post_id AND user_id=$user_id");

header("Location: ../dashboard.php");
exit();
