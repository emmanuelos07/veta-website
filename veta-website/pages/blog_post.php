<?php
include '../includes/header.php';
include '../db_connection.php';

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT blog_posts.*, users.name AS author_name FROM blog_posts
                        JOIN users ON blog_posts.author_id = users.id
                        WHERE blog_posts.id = :id");
$stmt->execute(['id' => $id]);
$post = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$post) {
    echo "Post not found!";
    exit;
}
?>

<main>
    <h1><?php echo $post['title']; ?></h1>
    <p>By <?php echo $post['author_name']; ?> on <?php echo $post['created_at']; ?></p>
    <p><?php echo $post['content']; ?></p>
</main>

<?php include '../includes/footer.php'; ?>