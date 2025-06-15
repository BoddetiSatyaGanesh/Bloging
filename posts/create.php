<?php
include '../includes/config.php';
include '../auth/auth-check.php';
include '../includes/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $user_id = $_SESSION['user_id'];

    // Handle image upload
    $image = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    $upload_dir = "../uploads/";
    $image_name = time() . '_' . basename($image); // avoid duplicate names
    $image_path = $upload_dir . $image_name;

    if (move_uploaded_file($image_tmp, $image_path)) {
        // Prepared statement for safe insert
        $stmt = $conn->prepare("INSERT INTO posts (user_id, title, description, image) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $user_id, $title, $description, $image_name);

        if ($stmt->execute()) {
            header("Location: ../dashboard.php");
            exit();
        } else {
            echo "Failed to create post. Please try again.";
        }

        $stmt->close();
    } else {
        echo "Image upload failed.";
    }
}
?>

<h2>Create New Post</h2>
<form method="POST" enctype="multipart/form-data">
    <input type="text" name="title" placeholder="Post Title" required><br><br>
    <textarea name="description" placeholder="Description" required></textarea><br><br>
    <input type="file" name="image" accept="image/*" required><br><br>
    <button type="submit">Create</button>
</form>

<?php include '../includes/footer.php'; ?>
