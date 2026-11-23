<?php
session_start();
require_once '../models/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM orders WHERE user_id = ? ORDER BY created_at DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>My Purchase History</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="container" style="max-width: 900px;">
    <h2>My Purchase History</h2>
    <a href="consumer_home.php" class="btn-back">← Back to Dashboard</a>
    <br><br>

    <?php if ($result->num_rows > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Date</th>
                    <th>Total Amount</th>
                    <th>Payment</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td>#<?php echo $row['id']; ?></td>
                    <td><?php echo date("d M Y, h:i A", strtotime($row['created_at'])); ?></td>
                    <td><?php echo $row['total_amount']; ?> BDT</td>
                    <td><?php echo $row['payment_method']; ?></td>
                    <td>
                        <span class="status status-<?php echo $row['status']; ?>">
                            <?php echo $row['status']; ?>
                        </span>
                    </td>
                    <td>
                        <a href="order_details.php?id=<?php echo $row['id']; ?>" class="btn-update" style="padding: 5px 10px; text-decoration:none; font-size:12px; border-radius:4px;">View Items</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>You haven't placed any orders yet.</p>
        <a href="browse_crops.php" class="btn">Go to Marketplace</a>
    <?php endif; ?>
</div>

</body>
</html>