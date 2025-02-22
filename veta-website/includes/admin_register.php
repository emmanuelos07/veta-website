<?php
include 'db_connection.php';

$name = $_POST['name'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

// Check if email already exists
$stmt = $conn->prepare("SELECT * FROM admins WHERE email = :email");
$stmt->execute(['email' => $email]);

if ($stmt->fetch()) {
    echo "Email already exists!";
    exit;
}

// Insert new admin
$stmt = $conn->prepare("INSERT INTO admins (name, email, password) VALUES (:name, :email, :password)");
$stmt->execute(['name' => $name, 'email' => $email, 'password' => $password]);

header("Location: ../pages/admin_login.php");
exit;
?>