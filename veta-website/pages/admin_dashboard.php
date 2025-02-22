<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../pages/admin_login.php");
    exit;
}
include __DIR__ . '/../includes/db_connection.php';
include __DIR__ . '/../includes/header.php';
?>

<main>
    <h1>Admin Dashboard</h1>

    <!-- Manage Products -->
    <section class="manage-products">
        <h2>Manage Products</h2>
        <a href="add_product.php" class="btn">Add New Product</a>
        <?php
        $stmt = $conn->query("SELECT * FROM products");
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (empty($products)) {
            echo "<p>No products found.</p>";
        } else {
            echo "<table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>";
            foreach ($products as $product) {
                echo "<tr>
                        <td>{$product['id']}</td>
                        <td>{$product['name']}</td>
                        <td>\${$product['price']}</td>
                        <td>
                            <a href='edit_product.php?id={$product['id']}'>Edit</a> |
                            <a href='delete_product.php?id={$product['id']}' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                        </td>
                      </tr>";
            }
            echo "</tbody></table>";
        }
        ?>
    </section>

    <!-- Manage Orders -->
    <section class="manage-orders">
        <h2>Manage Orders</h2>
        <?php
        $stmt = $conn->query("SELECT * FROM orders");
        $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (empty($orders)) {
            echo "<p>No orders found.</p>";
        } else {
            echo "<table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>User ID</th>
                            <th>Total Price</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>";
            foreach ($orders as $order) {
                echo "<tr>
                        <td>{$order['id']}</td>
                        <td>{$order['user_id']}</td>
                        <td>\${$order['total_price']}</td>
                        <td>{$order['status']}</td>
                        <td>
                            <a href='edit_order.php?id={$order['id']}'>Edit</a> |
                            <a href='delete_order.php?id={$order['id']}' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                        </td>
                      </tr>";
            }
            echo "</tbody></table>";
        }
        ?>
    </section>

    <!-- Manage Users -->
    <section class="manage-users">
        <h2>Manage Users</h2>
        <?php
        $stmt = $conn->query("SELECT * FROM users");
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (empty($users)) {
            echo "<p>No users found.</p>";
        } else {
            echo "<table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>";
            foreach ($users as $user) {
                echo "<tr>
                        <td>{$user['id']}</td>
                        <td>{$user['name']}</td>
                        <td>{$user['email']}</td>
                        <td>
                            <a href='edit_user.php?id={$user['id']}'>Edit</a> |
                            <a href='delete_user.php?id={$user['id']}' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                        </td>
                      </tr>";
            }
            echo "</tbody></table>";
        }
        ?>
    </section>

    <!-- Manage Admins -->
    <section class="manage-admins">
        <h2>Manage Admins</h2>
        <a href="add_admin.php" class="btn">Add New Admin</a>
        <?php
        $stmt = $conn->query("SELECT * FROM admins");
        $admins = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (empty($admins)) {
            echo "<p>No admins found.</p>";
        } else {
            echo "<table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>";
            foreach ($admins as $admin) {
                echo "<tr>
                        <td>{$admin['id']}</td>
                        <td>{$admin['name']}</td>
                        <td>{$admin['email']}</td>
                        <td>
                            <a href='edit_admin.php?id={$admin['id']}'>Edit</a> |
                            <a href='delete_admin.php?id={$admin['id']}' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                        </td>
                      </tr>";
            }
            echo "</tbody></table>";
        }
        ?>
    </section>
</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>