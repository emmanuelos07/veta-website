<?php
session_start();
include 'db_connection.php';

$email = $_POST['email'];
$password = $_POST['password'];

// Fetch admin by email
$stmt = $conn->prepare("SELECT * FROM admins WHERE email = :email");
$stmt->execute(['email' => $email]);
$admin = $stmt->fetch(PDO::FETCH_ASSOC);

if ($admin && password_verify($password, $admin['password'])) {
    // Login successful
    $_SESSION['admin'] = $admin;
    header("Location: ../pages/admin_dashboard.php");
} else {
    // Login failed
    echo "Invalid email or password!";
}
exit;
?>