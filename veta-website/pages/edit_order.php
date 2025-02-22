<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: ../pages/login.php");
    exit;
}
include '../includes/header.php';
include '../db_connection.php';

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM orders WHERE id = :id");
$stmt->execute(['id' => $id]);
$order = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$order) {
    echo "Order not found!";
    exit;
}
?>

<main>
    <h1>Edit Order</h1>
    <form action="../includes/update_order.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $order['id']; ?>">
        <label for="status">Status</label>
        <select name="status" required>
            <option value="pending" <?php echo $order['status'] === 'pending' ? 'selected' : ''; ?>>Pending</option>
            <option value="shipped" <?php echo $order['status'] === 'shipped' ? 'selected' : ''; ?>>Shipped</option>
            <option value="delivered" <?php echo $order['status'] === 'delivered' ? 'selected' : ''; ?>>Delivered</option>
        </select>
        <button type="submit">Update Order</button>
    </form>
</main>

<?php include '../includes/footer.php'; ?>