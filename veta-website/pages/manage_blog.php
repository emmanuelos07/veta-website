<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: ../pages/login.php");
    exit;
}
include '../includes/header.php';
include '../db_connection.php';

// Fetch all blog posts
$stmt = $conn->query("SELECT blog_posts.*, users.name AS author_name FROM blog_posts
                      JOIN users ON blog_posts.author_id = users.id");
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<main>
    <h1>Manage Blog</h1>
    <a href="add_blog_post.php" class="btn">Add New Post</a>
    <div class="blog-posts">
        <?php foreach ($posts as $post): ?>
            <div class="post">
                <h2><?php echo $post['title']; ?></h2>
                <p>By <?php echo $post['author_name']; ?> on <?php echo $post['created_at']; ?></p>
                <p><?php echo substr($post['content'], 0, 100); ?>...</p>
                <a href="edit_blog_post.php?id=<?php echo $post['id']; ?>">Edit</a>
                <a href="delete_blog_post.php?id=<?php echo $post['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </div>
        <?php endforeach; ?>
    </div>
</main>

<?php include '../includes/footer.php'; ?>