<?php
session_start();
include 'db_connection.php';
require 'vendor/autoload.php';

$id = $_POST['id'];
$status = $_POST['status'];

$stmt = $conn->prepare("UPDATE orders SET status = :status WHERE id = :id");
$stmt->execute(['status' => $status, 'id' => $id]);

// Fetch user email
$stmt = $conn->prepare("SELECT users.email FROM orders JOIN users ON orders.user_id = users.id WHERE orders.id = :id");
$stmt->execute(['id' => $id]);
$order = $stmt->fetch(PDO::FETCH_ASSOC);

// Send email
$mail = new PHPMailer\PHPMailer\PHPMailer();
$mail->isSMTP();
$mail->Host = 'smtp.example.com';
$mail->SMTPAuth = true;
$mail->Username = 'your-email@example.com';
$mail->Password = 'your-email-password';
$mail->SMTPSecure = 'tls';
$mail->Port = 587;

$mail->setFrom('your-email@example.com', 'VETA');
$mail->addAddress($order['email']);
$mail->isHTML(true);
$mail->Subject = 'Order Status Update';
$mail->Body = "Your order status has been updated to: $status";

if (!$mail->send()) {
    echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

header("Location: ../pages/manage_orders.php");
exit;