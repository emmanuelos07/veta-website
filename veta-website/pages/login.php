<?php include '../includes/header.php'; ?>

<main>
    <h1>Login</h1>
    <form action="../includes/login.php" method="POST">
        <label for="email">Email</label>
        <input type="email" name="email" required>
        <label for="password">Password</label>
        <input type="password" name="password" required>
        <button type="submit">Login</button>
    </form>
    <p>Don't have an account? <a href="register.php">Register here</a>.</p>
</main>

<?php include '../includes/footer.php'; ?>