<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: ../pages/login.php");
    exit;
}
include '../includes/header.php';
include '../db_connection.php';

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM products WHERE id = :id");
$stmt->execute(['id' => $id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    echo "Product not found!";
    exit;
}
?>

<main>
    <h1>Edit Product</h1>
    <form action="../includes/update_product.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
        <label for="name">Product Name</label>
        <input type="text" name="name" value="<?php echo $product['name']; ?>" required>
        <label for="description">Description</label>
        <textarea name="description" required><?php echo $product['description']; ?></textarea>
        <label for="price">Price</label>
        <input type="number" name="price" step="0.01" value="<?php echo $product['price']; ?>" required>
        <label for="image">Product Image</label>
        <input type="file" name="image" accept="image/*">
        <button type="submit">Update Product</button>
    </form>
</main>

<?php include '../includes/footer.php'; ?>