<?php include '../includes/header.php'; ?>

<main>
    <h1>Admin Registration</h1>
    <form action="../includes/admin_register.php" method="POST">
        <label for="name">Name</label>
        <input type="text" name="name" required>
        <label for="email">Email</label>
        <input type="email" name="email" required>
        <label for="password">Password</label>
        <input type="password" name="password" required>
        <button type="submit" class="btn">Register</button>
    </form>
</main>

<?php include '../includes/footer.php'; ?>