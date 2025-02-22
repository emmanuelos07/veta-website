<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../pages/login.php");
    exit;
}
include '../includes/header.php';
include '../db_connection.php';

$user_id = $_SESSION['user']['id'];
$stmt = $conn->prepare("SELECT * FROM users WHERE id = :id");
$stmt->execute(['id' => $user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<main>
    <h1>Edit Profile</h1>
    <form action="../includes/update_profile.php" method="POST" enctype="multipart/form-data">
    <label for="name">Name</label>
    <input type="text" name="name" value="<?php echo $user['name']; ?>" required>
    <label for="email">Email</label>
    <input type="email" name="email" value="<?php echo $user['email']; ?>" required>
    <label for="address">Address</label>
    <textarea name="address"><?php echo $user['address']; ?></textarea>
    <label for="profile_picture">Profile Picture</label>
    <input type="file" name="profile_picture" accept="image/*">
    <button type="submit">Update Profile</button>
</form>
</main>

<?php include '../includes/footer.php'; ?>