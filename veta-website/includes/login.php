<?php
session_start();
include __DIR__ . '/../includes/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Fetch user by email
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        // Login successful
        $_SESSION['user'] = $user;
        header("Location: ../index.php");
        exit;
    } else {
        // Login failed
        echo "Invalid email or password!";
    }
} else {
    echo "Invalid request!";
}
?>