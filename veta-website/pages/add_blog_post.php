<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: ../pages/login.php");
    exit;
}
include '../includes/header.php';
?>

<main>
    <h1>Add New Blog Post</h1>
    <form action="../includes/add_blog_post.php" method="POST">
        <label for="title">Title</label>
        <input type="text" name="title" required>
        <label for="content">Content</label>
        <textarea name="content" required></textarea>
        <button type="submit">Publish</button>
    </form>
</main>

<?php include '../includes/footer.php'; ?>