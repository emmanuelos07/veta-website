<?php include '../includes/header.php'; ?>

<main>
    <h1>Register</h1>
    <form action="../includes/register.php" method="POST">
        <label for="name">Name</label>
        <input type="text" name="name" required>
        <label for="email">Email</label>
        <input type="email" name="email" required>
        <label for="password">Password</label>
        <input type="password" name="password" required>
        <button type="submit">Register</button>
    </form>
    <p>Already have an account? <a href="login.php">Login here</a>.</p>
</main>

<?php include '../includes/footer.php'; ?>