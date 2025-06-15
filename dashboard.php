<?php
include 'includes/config.php';
include 'auth/auth-check.php';
include 'includes/header.php';


$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

$sql = "SELECT * FROM posts WHERE user_id = $user_id ORDER BY created_at DESC";
$result = $conn->query($sql);
?>
<?php include 'includes/title.php'; ?>

<h2>Welcome, <?= htmlspecialchars($username) ?> 👋</h2>
<p><a href="posts/create.php">➕ Create New Post</a></p>
<h3>Your Posts</h3>

<?php if ($result->num_rows > 0): ?>
    <?php while ($post = $result->fetch_assoc()): ?>
        <div class="post">
            <h3><?= htmlspecialchars($post['title']) ?></h3>
            <img src="uploads/<?= $post['image'] ?>" alt="Post image">
            <p><?= nl2br(htmlspecialchars($post['description'])) ?></p>
            <p><small>Posted on: <?= $post['created_at'] ?></small></p>
            <p>
                <a href="posts/view.php?id=<?= $post['id'] ?>">🔍 View</a> |
                <a href="posts/edit.php?id=<?= $post['id'] ?>">✏️ Edit</a> |
                <a href="posts/delete.php?id=<?= $post['id'] ?>" onclick="return confirm('Are you sure?');">🗑 Delete</a>
            </p>
        </div>
    <?php endwhile; ?>
<?php else: ?>
    <p>You haven't posted anything yet.</p>
<?php endif; ?>


<?php include 'includes/footer.php'; ?>
