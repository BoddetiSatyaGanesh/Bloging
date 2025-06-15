<?php
include '../includes/config.php';
include '../includes/header.php';

$user_id = $_GET['id'] ?? 0;

// Get user info
$user_sql = "SELECT * FROM users WHERE id = $user_id";
$user_result = $conn->query($user_sql);
$user = $user_result->fetch_assoc();

if (!$user) {
    echo "<p>User not found.</p>";
    include '../includes/footer.php';
    exit();
}

// Get user's posts
$post_sql = "SELECT * FROM posts WHERE user_id = $user_id ORDER BY created_at DESC";
$posts = $conn->query($post_sql);
?>

<h2><?= htmlspecialchars($user['username']) ?>'s Profile</h2>
<p>Email: <?= htmlspecialchars($user['email']) ?></p>
<p>Joined on: <?= $user['created_at'] ?></p>

<h3>Posts by <?= htmlspecialchars($user['username']) ?></h3>

<?php if ($posts->num_rows > 0): ?>
    <?php while ($post = $posts->fetch_assoc()): ?>
        <div class="post">
            <h3><?= htmlspecialchars($post['title']) ?></h3>
            <img src="../uploads/<?= $post['image'] ?>" alt="Post image">
            <p><?= nl2br(htmlspecialchars($post['description'])) ?></p>
            <p><a href="../posts/view.php?id=<?= $post['id'] ?>">🔍 View Post</a></p>
        </div>
    <?php endwhile; ?>
<?php else: ?>
    <p>This user has not posted anything yet.</p>
<?php endif; ?>

<?php include '../includes/footer.php'; ?>
