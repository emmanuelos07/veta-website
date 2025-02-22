function hasPurchasedProduct($user_id, $product_id) {
    include 'db_connection.php';
    $stmt = $conn->prepare("SELECT * FROM orders WHERE user_id = :user_id AND product_id = :product_id");
    $stmt->execute(['user_id' => $user_id, 'product_id' => $product_id]);
    return $stmt->fetch() !== false;
}