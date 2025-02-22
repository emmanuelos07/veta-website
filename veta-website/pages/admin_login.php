<?php include '../includes/header.php'; ?>

<main>
    <h1>Admin Login</h1>
    <form action="../includes/admin_login.php" method="POST">
        <label for="email">Email</label>
        <input type="email" name="email" required>
        <label for="password">Password</label>
        <input type="password" name="password" required>
        <button type="submit" class="btn">Login</button>
    </form>
</main>

<?php include '../includes/footer.php'; ?>