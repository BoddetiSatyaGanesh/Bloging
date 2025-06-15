<?php
include 'includes/config.php';
include 'includes/header.php';



$sql = "SELECT posts.*, users.username FROM posts 
        JOIN users ON posts.user_id = users.id 
        ORDER BY posts.created_at DESC";
$result = $conn->query($sql);
?>
<?php include 'includes/title.php'; ?>



<h2>📝 Latest Blog Posts</h2>

<?php if ($result->num_rows > 0): ?>
    <?php while ($post = $result->fetch_assoc()): ?>
        <div class="post">
            <h3><?= htmlspecialchars($post['title']) ?></h3>
            <p><em>by <a href="users/profile.php?id=<?= $post['user_id'] ?>">
                <?= htmlspecialchars($post['username']) ?>
            </a> on <?= $post['created_at'] ?></em></p>
            
            <img src="uploads/<?= $post['image'] ?>" alt="Post Image"><br><br>
            <p><?= nl2br(htmlspecialchars(substr($post['description'], 0, 200))) ?>...</p>
            <a href="posts/view.php?id=<?= $post['id'] ?>">🔍 Read more</a>
        </div>
        <hr>
    <?php endwhile; ?>
<?php else: ?>
    <p>No posts found.</p>
<?php endif; ?>


<?php include 'includes/footer.php'; ?>
