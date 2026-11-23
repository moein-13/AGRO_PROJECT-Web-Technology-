<?php
session_start();
if (empty($_SESSION['cart'])) { header("Location: browse_crops.php"); exit(); }
$total = 0;
foreach ($_SESSION['cart'] as $item) { $total += $item['price'] * $item['quantity']; }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
    <link rel="stylesheet" href="../css/style.css">
    <script src="../js/script.js"></script>
</head>
<body>

    <div class="container" style="max-width: 500px;">
        <h2>Payment Gateway</h2>
        <p>Total Amount to Pay: <strong style="color: #2e7d32; font-size: 1.2em;"><?php echo $total; ?> BDT</strong></p>

        <form action="../controllers/place_order.php" method="POST" onsubmit="return validatePaymentForm()">
            
            <label>Cardholder Name:</label>
            <input type="text" name="card_name" required>

            <label>Card Number:</label>
            <input type="text" id="card_number" name="card_number" placeholder="1234123412341234" required>

            <label>CVV:</label>
            <input type="password" id="cvv" name="cvv" placeholder="123" required style="width: 100px;">

            <input type="hidden" name="total_amount" value="<?php echo $total; ?>">
            
            <button type="submit" name="pay_now" class="btn">Pay Now</button>
        </form>
        
        <br>
        <a href="cart.php" class="btn-back">Cancel</a>
    </div>

</body>
</html>