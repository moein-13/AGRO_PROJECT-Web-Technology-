<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Dashboard - AGRO</title>
    <link rel="stylesheet" href="../css/admin_style.css">
</head>
<body>

    <div class="sidebar">
        <h2>🌱 AGRO Admin</h2>
        <a href="AdminController.php?action=dashboard">📊 Dashboard</a>
        <a href="AdminController.php?action=inventory">🛠 Inventory</a>
        <a href="AdminController.php?action=farmers">👨‍🌾 Farmers</a>
        <a href="../logout.php">🚪 Logout</a>
    </div>

    <div class="main-content">
        <h1>Dashboard</h1>
        <div class="stats-container">
            <div class="card">
                <h3>👨‍🌾 Total Farmers</h3>
                <p><?php echo $stats['farmers']; ?></p>
            </div>
            <div class="card">
                <h3>🧑‍💼 Total Consumers</h3>
                <p><?php echo $stats['consumers']; ?></p>
            </div>
            <div class="card">
                <h3>🌱 Total Crops</h3>
                <p><?php echo $stats['crops']; ?></p>
            </div>
            <div class="card">
                <h3>🛠 Tools in Stock</h3>
                <p><?php echo $stats['tools']; ?></p>
            </div>
        </div>
    </div>

</body>
</html>