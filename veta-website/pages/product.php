
<?php
session_start();
include '../db_connection.php';
$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM products WHERE id = :id");
$stmt->execute(['id' => $id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    echo "Product not found!";
    exit;
}
include '../includes/header.php';
?>
<?php
$stmt = $conn->prepare("SELECT reviews.*, users.name AS user_name FROM reviews
                        JOIN users ON reviews.user_id = users.id
                        WHERE product_id = :product_id");
$stmt->execute(['product_id' => $product['id']]);
$reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Reviews</h2>
<?php if (empty($reviews)): ?>
    <p>No reviews yet.</p>
<?php else: ?>
    <div class="reviews">
        <?php foreach ($reviews as $review): ?>
            <div class="review">
                <h3><?php echo $review['user_name']; ?></h3>
                <p>Rating: <?php echo $review['rating']; ?>/5</p>
                <p><?php echo $review['comment']; ?></p>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
<?php if (isset($_SESSION['user'])): ?>
    <form action="../includes/add_to_cart.php" method="POST">
        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
        <button type="submit" class="btn">Add to Cart</button>
    </form>
<?php else: ?>
    <p>Please <a href="login.php">log in</a> to add this product to your cart.</p>
<?php endif; ?>
<main>
    <h1><?php echo $product['name']; ?></h1>
    <div class="product-detail">
        <img src="../assets/images/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
        <p><?php echo $product['description']; ?></p>
        <p>Price: $ <?php echo $product['price']; ?></p>
        <a href="#" class="btn">Add to Cart</a>
    </div>
    <form action="../includes/add_to_cart.php" method="POST">
    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
    <input type="number" name="quantity" value="1" min="1">
    <button type="submit" class="btn">Add to Cart</button>
</form>
<form action="../includes/add_to_wishlist.php" method="POST">
    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
    <button type="submit" class="btn">Add to Wishlist</button>
</form>
</main>
<?php if (isset($_SESSION['user']) && hasPurchasedProduct($_SESSION['user']['id'], $product['id'])): ?>
    <h2>Leave a Review</h2>
    <form action="../includes/add_review.php" method="POST">
        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
        <label for="rating">Rating (1-5)</label>
        <input type="number" name="rating" min="1" max="5" required>
        <label for="comment">Comment</label>
        <textarea name="comment" required></textarea>
        <button type="submit">Submit Review</button>
    </form>
<?php endif; ?>

<?php include '../includes/footer.php'; ?>