<?php
session_start();
include 'db_connection.php';

$id = $_POST['id'];
$name = $_POST['name'];
$description = $_POST['description'];
$price = $_POST['price'];
$image = $_FILES['image'];

if ($image['size'] > 0) {
    // Upload new image
    $target_dir = "../assets/images/";
    $target_file = $target_dir . basename($image['name']);
    move_uploaded_file($image['tmp_name'], $target_file);
    $image_name = $image['name'];
} else {
    // Keep the old image
    $stmt = $conn->prepare("SELECT image FROM products WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    $image_name = $product['image'];
}

// Update product in database
$stmt = $conn->prepare("UPDATE products SET name = :name, description = :description, price = :price, image = :image WHERE id = :id");
$stmt->execute(['name' => $name, 'description' => $description, 'price' => $price, 'image' => $image_name, 'id' => $id]);

header("Location: ../pages/manage_products.php");
exit;