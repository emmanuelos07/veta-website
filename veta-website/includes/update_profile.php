<?php
session_start();
include 'db_connection.php';

$user_id = $_SESSION['user']['id'];
$name = $_POST['name'];
$email = $_POST['email'];
$address = $_POST['address'];
$profile_picture = $_FILES['profile_picture'];

if ($profile_picture['size'] > 0) {
    // Upload new profile picture
    $target_dir = "../assets/images/profiles/";
    $target_file = $target_dir . basename($profile_picture['name']);
    move_uploaded_file($profile_picture['tmp_name'], $target_file);
    $profile_picture_name = $profile_picture['name'];
} else {
    // Keep the old profile picture
    $stmt = $conn->prepare("SELECT profile_picture FROM users WHERE id = :id");
    $stmt->execute(['id' => $user_id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    $profile_picture_name = $user['profile_picture'];
}

// Update profile
$stmt = $conn->prepare("UPDATE users SET name = :name, email = :email, address = :address, profile_picture = :profile_picture WHERE id = :id");
$stmt->execute(['name' => $name, 'email' => $email, 'address' => $address, 'profile_picture' => $profile_picture_name, 'id' => $user_id]);

$_SESSION['user']['name'] = $name;
$_SESSION['user']['email'] = $email;

header("Location: ../pages/user_dashboard.php");
exit;