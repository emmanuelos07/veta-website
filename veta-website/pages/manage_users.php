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
    <h1>Manage Users</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo $user['id']; ?></td>
                    <td><?php echo $user['name']; ?></td>
                    <td><?php echo $user['email']; ?></td>
                    <td><?php echo $user['role']; ?></td>
                    <td>
                        <a href="edit_user.php?id=<?php echo $user['id']; ?>">Edit</a>
                        <a href="delete_user.php?id=<?php echo $user['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>

<?php include '../includes/footer.php'; ?>