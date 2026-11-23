<?php
session_start();
// Auth Check: Is user logged in?
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
// Role Check: Is user a Consumer?
if ($_SESSION['role'] !== 'Consumer') {
    echo "Access Denied. You are not a Consumer.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Consumer Dashboard</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

    <div class="container">
        <div class="header">
            <h1>Welcome, <?php echo $_SESSION['user_name']; ?>!</h1>
            <a href="../logout.php" class="btn-danger" style="padding: 5px 10px; width: auto; font-size:14px;">Logout</a>
        </div>
        
        <p><strong>Role:</strong> <?php echo $_SESSION['role']; ?></p>
        <hr>
        
        <h3>Consumer Menu</h3>
        <ul style="list-style-type: none; padding: 0;">
            <li><a href="browse_crops.php" class="btn" style="display:block; text-align:center; margin-bottom:10px;">Browse Marketplace</a></li>
            <li><a href="cart.php" class="btn" style="display:block; text-align:center; margin-bottom:10px;">My Cart</a></li>
            <li><a href="order_history.php" class="btn" style="display:block; text-align:center; margin-bottom:10px;">Purchase History & Tracking</a></li>
        </ul>
    </div>

</body>
</html>