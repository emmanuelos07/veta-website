<?php
session_start(); // Start the session
include __DIR__ . '/includes/db_connection.php'; // Include the database connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VETA - Lifestyle Fashion Brand</title>
    <link rel="stylesheet" href="../assets/css/styles.css"> <!-- Link to CSS file -->
</head>
<body>
    <header>
        <nav>
        <a href="<?php echo '/index.php'; ?>">Home</a>
<a href="<?php echo '/pages/shop.php'; ?>">Shop</a>
<a href="<?php echo '/pages/about.php'; ?>">About Us</a>
<a href="<?php echo '/pages/contact.php'; ?>">Contact</a>
            <?php if (isset($_SESSION['user'])): ?>
                <a href="../pages/cart.php">Cart</a>
                <a href="../pages/wishlist.php">Wishlist</a>
                <a href="../pages/user_dashboard.php">Dashboard</a>
                <a href="../includes/logout.php">Logout</a>
                <?php if (isset($_SESSION['admin'])): ?>
    <a href="../pages/admin_dashboard.php">Admin Dashboard</a>
<?php endif; ?>
                <?php else: ?>
                <a href="../pages/login.php">Login</a>
                <a href="../pages/register.php">Register</a>
            <?php endif; ?>
        </nav>
    </header>
<link rel="stylesheet" href="assets/css/styles.css">
<main>
    <!-- Hero Section -->
    <section class="hero">
        <h1>Welcome to VETA</h1>
        <p>Your destination for lifestyle and fashion.</p>
        <a href="pages/shop.php" class="btn">Shop Now</a>
    </section>

    <!-- Featured Products Section -->
    <section class="featured-products">
        <h2>Featured Products</h2>
        <div class="products">
            <?php
            // Fetch featured products from the database
            $stmt = $conn->query("SELECT * FROM products LIMIT 4"); // Adjust the query as needed
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (empty($products)) {
                echo "<p>No featured products available.</p>";
            } else {
                foreach ($products as $product) {
                    echo "<div class='product'>
                            <img src='assets/images/{$product['image']}' alt='{$product['name']}'>
                            <h3>{$product['name']}</h3>
                            <p>{$product['description']}</p>
                            <p>Price: \${$product['price']}</p>
                            <a href='pages/product.php?id={$product['id']}' class='btn'>View Details</a>
                          </div>";
                }
            }
            ?>
        </div>
    </section>
</main>

<?php include __DIR__ . '/includes/footer.php'; // Include the footer ?>