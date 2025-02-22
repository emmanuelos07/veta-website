<?php
session_start();
include 'db_connection.php';

if (!isset($_SESSION['user'])) {
    echo "Please log in to add products to your wishlist.";
    exit;
}

$user_id = $_SESSION['user']['id'];
$product_id = $_POST['product_id'];

// Check if the product is already in the wishlist
$stmt = $conn->prepare("SELECT * FROM wishlist WHERE user_id = :user_id AND product_id = :product_id");
$stmt->execute(['user_id' => $user_id, 'product_id' => $product_id]);

if ($stmt->fetch()) {
    echo "Product already in wishlist!";
} else {
    $stmt = $conn->prepare("INSERT INTO wishlist (user_id, product_id) VALUES (:user_id, :product_id)");
    $stmt->execute(['user_id' => $user_id, 'product_id' => $product_id]);
    echo "Product added to wishlist!";
}

header("Location: ../pages/shop.php");
exit;
?>