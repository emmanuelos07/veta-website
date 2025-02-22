<?php
session_start();
include 'db_connection.php';

$user_id = $_SESSION['user']['id'];
$name = $_POST['name'];
$address = $_POST['address'];

// Calculate total price from the cart
$stmt = $conn->prepare("SELECT SUM(p.price * c.quantity) AS total_price FROM cart c
                        JOIN products p ON c.product_id = p.id
                        WHERE c.user_id = :user_id");
$stmt->execute(['user_id' => $user_id]);
$total_price = $stmt->fetchColumn();

// Save order to database
$stmt = $conn->prepare("INSERT INTO orders (user_id, name, address, total_price, status) VALUES (:user_id, :name, :address, :total_price, 'pending')");
$stmt->execute(['user_id' => $user_id, 'name' => $name, 'address' => $address, 'total_price' => $total_price]);

// Clear the cart
$stmt = $conn->prepare("DELETE FROM cart WHERE user_id = :user_id");
$stmt->execute(['user_id' => $user_id]);

header("Location: ../pages/thank_you.php");
exit;
?>