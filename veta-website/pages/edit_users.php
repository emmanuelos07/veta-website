<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: ../pages/login.php");
    exit;
}
include '../includes/header.php';
include '../db_connection.php';

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM users WHERE id = :id");
$stmt->execute(['id' => $id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo "User not found!";
    exit;
}
?>

<main>
    <h1>Edit User</h1>
    <form action="../includes/update_user.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
        <label for="name">Name</label>
        <input type="text" name="name" value="<?php echo $user['name']; ?>" required>
        <label for="email">Email</label>
        <input type="email" name="email" value="<?php echo $user['email']; ?>" required>
        <label for="role">Role</label>
        <select name="role" required>
            <option value="admin" <?php echo $user['role'] === 'admin' ? 'selected' : ''; ?>>Admin</option>
            <option value="customer" <?php echo $user['role'] === 'customer' ? 'selected' : ''; ?>>Customer</option>
        </select>
        <button type="submit">Update User</button>
    </form>
</main>

<?php include '../includes/footer.php'; ?>