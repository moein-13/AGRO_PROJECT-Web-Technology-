<?php
session_start();
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit(); }

$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$total_price = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>My Cart - AGRO</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

    <div class="container" style="max-width: 900px;">
        <h2>My Shopping Cart</h2>
        <a href="browse_crops.php" class="btn-back">← Continue Shopping</a>
        <br><br>

        <?php if (empty($cart)): ?>
            <p>Your cart is empty.</p>
        <?php else: ?>
            <table>
                <tr>
                    <th>Crop Name</th>
                    <th>Price (per kg)</th>
                    <th>Quantity (kg)</th>
                    <th>Subtotal</th>
                    <th>Action</th>
                </tr>
                <?php foreach ($cart as $id => $item): 
                    $subtotal = $item['price'] * $item['quantity'];
                    $total_price += $subtotal;
                ?>
                <tr>
                    <td><?php echo $item['name']; ?></td>
                    <td><?php echo $item['price']; ?> BDT</td>
                    <td>
                        <form action="../controllers/cart_controller.php" method="POST" style="margin:0;">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="number" name="quantity" value="<?php echo $item['quantity']; ?>" min="1" style="width:60px; padding:5px;">
                            <button type="submit" name="update_cart" class="btn-update" style="width:auto; padding:5px 10px; font-size:12px;">Update</button>
                        </form>
                    </td>
                    <td><?php echo $subtotal; ?> BDT</td>
                    <td><a href="../controllers/cart_controller.php?action=remove&id=<?php echo $id; ?>" class="btn-danger" style="padding: 5px 10px; font-size:12px; border-radius:4px; text-decoration:none;">Remove</a></td>
                </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="3" style="text-align:right;"><strong>Total Amount:</strong></td>
                    <td colspan="2"><strong style="color: #2e7d32; font-size:1.2em;"><?php echo $total_price; ?> BDT</strong></td>
                </tr>
            </table>

            <br>
            <a href="checkout.php" class="btn btn-buy" style="font-size: 18px;">Proceed to Checkout</a>
        <?php endif; ?>
    </div>

</body>
</html>