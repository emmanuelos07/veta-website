<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../pages/login.php");
    exit;
}
include __DIR__ . '/../includes/db_connection.php';
include __DIR__ . '/../includes/header.php';

$user_id = $_SESSION['user']['id'];
?>

<main>
    <h1>Your Wishlist</h1>
    <?php
    $stmt = $conn->prepare("SELECT p.* FROM wishlist w
                            JOIN products p ON w.product_id = p.id
                            WHERE w.user_id = :user_id");
    $stmt->execute(['user_id' => $user_id]);
    $wishlist_items = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (empty($wishlist_items)) {
        echo "<p>Your wishlist is empty.</p>";
    } else {
        echo "<ul>";
        foreach ($wishlist_items as $item) {
            echo "<li>{$item['name']} - Price: \${$item['price']}</li>";
        }
        echo "</ul>";
    }
    ?>
</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>