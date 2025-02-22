<?php
session_start();
include 'db_connection.php';

if (!isset($_SESSION['user'])) {
    header("Location: ../pages/login.php");
    exit;
}

$user_id = $_SESSION['user']['id'];
$product_id = $_POST['product_id'];
$rating = $_POST['rating'];
$comment = $_POST['comment'];

$stmt = $conn->prepare("INSERT INTO reviews (user_id, product_id, rating, comment) VALUES (:user_id, :product_id, :rating, :comment)");
$stmt->execute(['user_id' => $user_id, 'product_id' => $product_id, 'rating' => $rating, 'comment' => $comment]);

header("Location: ../pages/product.php?id=$product_id");
exit;