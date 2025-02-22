
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VETA - Lifestyle Fashion Brand</title>
    <link rel="stylesheet" href="../assets/css/styles.css"> 
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