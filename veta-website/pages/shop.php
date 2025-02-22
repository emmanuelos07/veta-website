<?php
session_start();
include __DIR__ . '/../includes/db_connection.php';
include __DIR__ . '/../includes/header.php';

// Fetch products
$stmt = $conn->query("SELECT * FROM products");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<main>
    <h1>Shop</h1>
    
    <div class="products">
        <?php foreach ($products as $product): ?>
            <div class="product">
                <img src="../assets/images/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
                <h2><?php echo $product['name']; ?></h2>
                <p><?php echo $product['description']; ?></p>
                <p>Price: $<?php echo $product['price']; ?></p>
                <a href="product.php?id=<?php echo $product['id']; ?>" class="btn">View Details</a>
                <?php if (isset($_SESSION['user'])): ?>
                    <form action="../includes/add_to_cart.php" method="POST" style="display: inline;">
                        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                        <button type="submit" class="btn">Add to Cart</button>
                    </form>
                <?php else: ?>
                    <p>Please <a href="login.php">log in</a> to add to cart.</p>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>