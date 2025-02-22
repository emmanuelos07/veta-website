<?php
include '../db_connection.php';

$search = isset($_GET['search']) ? $_GET['search'] : '';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 10; // Number of items per page
$offset = ($page - 1) * $limit;

// Fetch total number of products
$stmt = $conn->prepare("SELECT COUNT(*) FROM products WHERE name LIKE :search OR description LIKE :search");
$stmt->execute(['search' => "%$search%"]);
$total_products = $stmt->fetchColumn();

// Fetch products for the current page
$stmt = $conn->prepare("SELECT * FROM products WHERE name LIKE :search OR description LIKE :search LIMIT :limit OFFSET :offset");
$stmt->execute(['search' => "%$search%", 'limit' => $limit, 'offset' => $offset]);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<main>
    <h1>Manage Orders</h1>
    <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>User</th>
                <th>Product</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order): ?>
                <tr>
                    <td><?php echo $order['id']; ?></td>
                    <td><?php echo $order['user_name']; ?></td>
                    <td><?php echo $order['product_name']; ?></td>
                    <td><?php echo $order['quantity']; ?></td>
                    <td>$<?php echo $order['total_price']; ?></td>
                    <td><?php echo $order['status']; ?></td>
                    <td>
                        <a href="edit_order.php?id=<?php echo $order['id']; ?>">Edit</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>

<?php include '../includes/footer.php'; ?>