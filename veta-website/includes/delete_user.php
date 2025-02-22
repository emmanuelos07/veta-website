<?php
session_start();
include 'db_connection.php';

$id = $_GET['id'];
$stmt = $conn->prepare("DELETE FROM users WHERE id = :id");
$stmt->execute(['id' => $id]);

header("Location: ../pages/manage_users.php");
exit;