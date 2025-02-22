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
    <h1>Your Cart</h1>
    <?php
    $stmt = $conn->prepare("SELECT p.*, c.quantity FROM cart c
                            JOIN products p ON c.product_id = p.id
                            WHERE c.user_id = :user_id");
    $stmt->execute(['user_id' => $user_id]);
    $cart_items = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (empty($cart_items)) {
        echo "<p>Your cart is empty.</p>";
    } else {
        echo "<ul>";
        foreach ($cart_items as $item) {
            echo "<li>{$item['name']} - Quantity: {$item['quantity']} - Price: \${$item['price']}</li>";
        }
        echo "</ul>";
    }
    ?>
</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>