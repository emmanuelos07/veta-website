<?php
$host = 'localhost';
$dbname = 'veta_db';
$username = 'root'; // Default for XAMPP/WAMP
$password = ''; // Default for XAMPP/WAMP

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>