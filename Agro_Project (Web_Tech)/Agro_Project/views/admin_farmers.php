<!DOCTYPE html>
<html lang="en">
<head>
    <title>Farmers - AGRO</title>
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
        <h1>Farmer Management</h1>
        <table>
            <thead>
                <tr>
                    <th>Farmer Name</th>
                    <th>Email</th>
                    <th>Total Crops</th>
                    <th>Joined Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($farmers)): ?>
                    <?php foreach ($farmers as $farmer): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($farmer['name']); ?></td>
                        <td><?php echo htmlspecialchars($farmer['email']); ?></td>
                        <td><?php echo $farmer['total_crops']; ?></td>
                        
                        <td><?php echo date('Y-m-d', strtotime($farmer['created_at'])); ?></td>
                        
                        <td>
                            <span style="color: <?php echo $farmer['status'] == 'Active' ? 'green' : 'red'; ?>; font-weight:bold;">
                                <?php echo $farmer['status']; ?>
                            </span>
                        </td>
                        <td>
                            <a href="AdminController.php?action=toggle_status&id=<?php echo $farmer['id']; ?>&status=<?php echo $farmer['status']; ?>">
                                <?php if($farmer['status'] == 'Active'): ?>
                                    <button class="btn btn-delete">Block</button>
                                <?php else: ?>
                                    <button class="btn btn-add" style="background-color: blue;">Unblock</button>
                                <?php endif; ?>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="6">No Farmers Found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>