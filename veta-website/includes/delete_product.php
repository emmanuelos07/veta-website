<?php
session_start();
include 'db_connection.php';

$id = $_GET['id'];
$stmt = $conn->prepare("DELETE FROM products WHERE id = :id");
$stmt->execute(['id' => $id]);

header("Location: ../pages/manage_products.php");
exit;