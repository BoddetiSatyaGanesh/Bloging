<?php
include '../includes/config.php';
include '../auth/auth-check.php';

$user_id = $_SESSION['user_id'];
$post_id = $_POST['post_id'];

$check = $conn->query("SELECT * FROM likes WHERE user_id=$user_id AND post_id=$post_id");
if ($check->num_rows == 0) {
    $conn->query("INSERT INTO likes (user_id, post_id) VALUES ($user_id, $post_id)");
}

header("Location: view.php?id=$post_id");
exit();
