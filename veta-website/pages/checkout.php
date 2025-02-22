<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../pages/login.php");
    exit;
}
include '../includes/header.php';
?>

<main>
    <h1>Checkout</h1>
    <form action="../includes/process_checkout.php" method="POST" id="checkout-form">
        <label for="name">Full Name</label>
        <input type="text" name="name" required>
        <label for="address">Shipping Address</label>
        <textarea name="address" required></textarea>
        <div id="card-element">
            <!-- Stripe Card Element will be inserted here -->
        </div>
        <button type="submit">Place Order</button>
    </form>
</main>

<script src="https://js.stripe.com/v3/"></script>
<script>
    const stripe = Stripe('your-publishable-key');
    const elements = stripe.elements();
    const cardElement = elements.create('card');
    cardElement.mount('#card-element');

    const form = document.getElementById('checkout-form');
    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        const { paymentMethod, error } = await stripe.createPaymentMethod({
            type: 'card',
            card: cardElement,
        });
        if (error) {
            alert(error.message);
        } else {
            const hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'payment_method');
            hiddenInput.setAttribute('value', paymentMethod.id);
            form.appendChild(hiddenInput);
            form.submit();
        }
    });
</script>

<?php include '../includes/footer.php'; ?>