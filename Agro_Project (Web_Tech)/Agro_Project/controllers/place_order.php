<?php
session_start();
require_once '../models/db.php';

if (isset($_POST['pay_now'])) {
    $user_id = $_SESSION['user_id'];
    $total = $_POST['total_amount'];
    $payment_method = "Card"; // Simulated

    // 1. Insert into Orders Table
    $sql_order = "INSERT INTO orders (user_id, total_amount, payment_method) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql_order);
    $stmt->bind_param("ids", $user_id, $total, $payment_method);
    
    if ($stmt->execute()) {
        $order_id = $stmt->insert_id; // Get the ID of the order we just created

        // 2. Insert into Order Items Table
        $sql_item = "INSERT INTO order_items (order_id, crop_id, quantity, price) VALUES (?, ?, ?, ?)";
        $stmt_item = $conn->prepare($sql_item);

        foreach ($_SESSION['cart'] as $crop_id => $item) {
            $stmt_item->bind_param("iiid", $order_id, $crop_id, $item['quantity'], $item['price']);
            $stmt_item->execute();
        }

        // 3. Clear Cart Session
        unset($_SESSION['cart']);

        // 4. Redirect to Success Page
        echo "<script>alert('Payment Successful! Order Placed.'); window.location.href='../views/consumer_home.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>