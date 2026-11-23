<?php
session_start();
require_once '../models/db.php';

if (!isset($_GET['id']) || !isset($_SESSION['user_id'])) {
    header("Location: order_history.php");
    exit();
}

$order_id = $_GET['id'];
$user_id = $_SESSION['user_id'];

// Fetch Order Info
$sql_order = "SELECT * FROM orders WHERE id = ? AND user_id = ?";
$stmt = $conn->prepare($sql_order);
$stmt->bind_param("ii", $order_id, $user_id);
$stmt->execute();
$order_result = $stmt->get_result();
$order = $order_result->fetch_assoc();

if (!$order) { die("Order not found."); }

// Fetch Items
$sql_items = "SELECT oi.*, c.name FROM order_items oi JOIN crops c ON oi.crop_id = c.id WHERE oi.order_id = ?";
$stmt_items = $conn->prepare($sql_items);
$stmt_items->bind_param("i", $order_id);
$stmt_items->execute();
$items_result = $stmt_items->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Order #<?php echo $order_id; ?> Details</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="container" style="max-width: 600px;">
    <h2>Order Details (ID: #<?php echo $order_id; ?>)</h2>
    <p><strong>Status:</strong> <span class="status status-<?php echo $order['status']; ?>"><?php echo $order['status']; ?></span></p>
    <p><strong>Date:</strong> <?php echo $order['created_at']; ?></p>
    <hr>
    
    <h3>Items Purchased:</h3>
    <?php while ($item = $items_result->fetch_assoc()): ?>
        <div style="display: flex; justify-content: space-between; border-bottom: 1px solid #eee; padding: 10px 0;">
            <div>
                <strong><?php echo $item['name']; ?></strong><br>
                <small><?php echo $item['quantity']; ?> kg x <?php echo $item['price']; ?> BDT</small>
            </div>
            <div>
                <?php echo $item['quantity'] * $item['price']; ?> BDT
            </div>
        </div>
    <?php endwhile; ?>

    <div style="font-weight: bold; font-size: 1.2em; text-align: right; margin-top: 20px; color: #2e7d32;">
        Grand Total: <?php echo $order['total_amount']; ?> BDT
    </div>

    <br>
    <a href="order_history.php" class="btn-back">← Back to History</a>
</div>

</body>
</html>