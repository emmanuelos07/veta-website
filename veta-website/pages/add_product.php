<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: ../pages/login.php");
    exit;
}
include '../includes/header.php';
?>

<main>
    <h1>Add New Product</h1>
    <form action="../includes/add_product.php" method="POST" enctype="multipart/form-data">
        <label for="name">Product Name</label>
        <input type="text" name="name" required>
        <label for="description">Description</label>
        <textarea name="description" required></textarea>
        <label for="price">Price</label>
        <input type="number" name="price" step="0.01" required>
        <label for="image">Product Image</label>
        <input type="file" name="image" accept="image/*" required>
        <button type="submit">Add Product</button>
    </form>
</main>

<?php include '../includes/footer.php'; ?>