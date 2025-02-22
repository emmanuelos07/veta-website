<?php
include '../includes/header.php';
include '../db_connection.php';

// Fetch all blog posts
$stmt = $conn->query("SELECT blog_posts.*, users.name AS author_name FROM blog_posts
                      JOIN users ON blog_posts.author_id = users.id
                      ORDER BY created_at DESC");
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<main>
    <h1>Blog</h1>
    <div class="blog-posts">
        <?php foreach ($posts as $post): ?>
            <div class="post">
                <h2><?php echo $post['title']; ?></h2>
                <p>By <?php echo $post['author_name']; ?> on <?php echo $post['created_at']; ?></p>
                <p><?php echo substr($post['content'], 0, 200); ?>...</p>
                <a href="blog_post.php?id=<?php echo $post['id']; ?>">Read More</a>
            </div>
        <?php endforeach; ?>
    </div>
</main>

<?php include '../includes/footer.php'; ?>