<?php
session_start();
include __DIR__ . '/db_connection.php';

if (!isset($_SESSION['user'])) {
    echo "Please log in to add products to your cart.";
    exit;
}

$user_id = $_SESSION['user']['id'];
$product_id = $_POST['product_id'];

// Check if the product is already in the cart
$stmt = $conn->prepare("SELECT * FROM cart WHERE user_id = :user_id AND product_id = :product_id");
$stmt->execute(['user_id' => $user_id, 'product_id' => $product_id]);
$existing_item = $stmt->fetch(PDO::FETCH_ASSOC);

if ($existing_item) {
    // Update quantity if the product is already in the cart
    $new_quantity = $existing_item['quantity'] + 1;
    $stmt = $conn->prepare("UPDATE cart SET quantity = :quantity WHERE id = :id");
    $stmt->execute(['quantity' => $new_quantity, 'id' => $existing_item['id']]);
} else {
    // Add new item to the cart
    $stmt = $conn->prepare("INSERT INTO cart (user_id, product_id, quantity) VALUES (:user_id, :product_id, 1)");
    $stmt->execute(['user_id' => $user_id, 'product_id' => $product_id]);
}

header("Location: ../pages/shop.php");
exit;
?>