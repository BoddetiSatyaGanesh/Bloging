<?php
include '../includes/config.php';
include '../auth/auth-check.php';
include '../includes/header.php';

$post_id = $_GET['id'];
$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM posts WHERE id=$post_id AND user_id=$user_id";
$post = $conn->query($sql)->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];

    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "../uploads/" . $image);
        $conn->query("UPDATE posts SET title='$title', description='$description', image='$image' WHERE id=$post_id AND user_id=$user_id");
    } else {
        $conn->query("UPDATE posts SET title='$title', description='$description' WHERE id=$post_id AND user_id=$user_id");
    }

    header("Location: ../dashboard.php");
    exit();
}
?>

<h2>Edit Post</h2>
<form method="POST" enctype="multipart/form-data">
    <input type="text" name="title" value="<?= $post['title'] ?>" required><br>
    <textarea name="description"><?= $post['description'] ?></textarea><br>
    <input type="file" name="image"><br>
    <button type="submit">Update</button>
</form>

<?php include '../includes/footer.php'; ?>
