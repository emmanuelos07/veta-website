<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../pages/login.php");
    exit;
}
include __DIR__ . '/../includes/db_connection.php';
include __DIR__ . '/../includes/header.php';

$user_id = $_SESSION['user']['id'];
?>

<main>
    <h1>Welcome, <?php echo $_SESSION['user']['name']; ?>!</h1>
    <p>This is your dashboard.</p>

    <!-- Order History -->
    <section class="order-history">
        <h2>Your Orders</h2>
        <?php
        $stmt = $conn->prepare("SELECT * FROM orders WHERE user_id = :user_id ORDER BY created_at DESC");
        $stmt->execute(['user_id' => $user_id]);
        $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (empty($orders)) {
            echo "<p>You have no orders yet.</p>";
        } else {
            echo "<ul>";
            foreach ($orders as $order) {
                echo "<li>Order ID: {$order['id']} - Total: \${$order['total_price']} - Status: {$order['status']}</li>";
            }
            echo "</ul>";
        }
        ?>
    </section>

    <!-- Wishlist -->
    <section class="wishlist">
        <h2>Your Wishlist</h2>
        <?php
        $stmt = $conn->prepare("SELECT p.* FROM wishlist w
                                JOIN products p ON w.product_id = p.id
                                WHERE w.user_id = :user_id");
        $stmt->execute(['user_id' => $user_id]);
        $wishlist_items = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (empty($wishlist_items)) {
            echo "<p>Your wishlist is empty.</p>";
        } else {
            echo "<ul>";
            foreach ($wishlist_items as $item) {
                echo "<li>{$item['name']} - Price: \${$item['price']}</li>";
            }
            echo "</ul>";
        }
        ?>
    </section>

    <!-- Profile Management -->
    <section class="profile-management">
        <h2>Profile Management</h2>
        <form action="../includes/update_profile.php" method="POST">
            <label for="name">Name</label>
            <input type="text" name="name" value="<?php echo $_SESSION['user']['name']; ?>" required>
            <label for="email">Email</label>
            <input type="email" name="email" value="<?php echo $_SESSION['user']['email']; ?>" required>
            <label for="password">New Password (leave blank to keep current)</label>
            <input type="password" name="password">
            <button type="submit" class="btn">Update Profile</button>
        </form>
    </section>
</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>