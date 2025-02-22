<?php
session_start();
include 'db_connection.php';

$name = $_POST['name'];
$description = $_POST['description'];
$price = $_POST['price'];
$image = $_FILES['image'];

// Upload image
$target_dir = "../assets/images/";
$target_file = $target_dir . basename($image['name']);
move_uploaded_file($image['tmp_name'], $target_file);

// Save product to database
$stmt = $conn->prepare("INSERT INTO products (name, description, price, image) VALUES (:name, :description, :price, :image)");
$stmt->execute(['name' => $name, 'description' => $description, 'price' => $price, 'image' => $image['name']]);

header("Location: ../pages/manage_products.php");
exit;