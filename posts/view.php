<?php
include '../includes/config.php';
include '../includes/header.php';

$post_id = $_GET['id'] ?? 0;

$sql = "SELECT p.*, u.username FROM posts p JOIN users u ON p.user_id = u.id WHERE p.id = $post_id";
$result = $conn->query($sql);
$post = $result->fetch_assoc();

$likes = $conn->query("SELECT COUNT(*) AS total FROM likes WHERE post_id = $post_id")->fetch_assoc();
?>

<?php if ($post): ?>
    <div class="post">
        <h2><?= $post['title'] ?></h2>
        <p><em>by <?= $post['username'] ?> on <?= $post['created_at'] ?></em></p>
        <img src="../uploads/<?= $post['image'] ?>" alt="Post Image"><br><br>
        <p><?= nl2br($post['description']) ?></p>
        <p>❤️ <?= $likes['total'] ?> likes</p>

        <?php if (isset($_SESSION['user_id'])): ?>
            <form method="POST" action="like.php">
                <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
                <button type="submit" class="like-btn">Like</button>
            </form>
        <?php endif; ?>
    </div>
<?php else: ?>
    <p>Post not found.</p>
<?php endif; ?>

<?php include '../includes/footer.php'; ?>
