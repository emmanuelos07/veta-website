<?php
session_start();
include 'db_connection.php';

$id = $_POST['id'];
$name = $_POST['name'];
$email = $_POST['email'];
$role = $_POST['role'];

$stmt = $conn->prepare("UPDATE users SET name = :name, email = :email, role = :role WHERE id = :id");
$stmt->execute(['name' => $name, 'email' => $email, 'role' => $role, 'id' => $id]);

header("Location: ../pages/manage_users.php");
exit;