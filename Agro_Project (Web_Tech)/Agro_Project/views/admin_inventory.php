<!DOCTYPE html>
<html lang="en">
<head>
    <title>Inventory - AGRO</title>
    <link rel="stylesheet" href="../css/admin_style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
        <h1>Inventory Management</h1>
        
        <div style="background: white; padding: 20px; margin-bottom: 20px; border-radius: 8px;">
            <h3>Add New Tool</h3>
            <form id="addToolForm">
                <input type="text" name="name" id="t_name" placeholder="Tool Name">
                
                <select name="category" id="t_cat">
                    <option value="Tractor">Tractor</option>
                    <option value="Sprayer">Sprayer</option>
                    <option value="Pump">Pump</option>
                </select>
                
                <input type="number" name="quantity" id="t_qty" placeholder="Quantity">
                <input type="number" step="0.01" name="price" id="t_price" placeholder="Rent Price">
                
                <button type="submit" class="btn btn-add">Add Tool</button>
            </form>
            
            <p id="msg" style="font-weight: bold; margin-top: 10px;"></p>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Tool Name</th>
                    <th>Category</th>
                    <th>Quantity</th>
                    <th>Rent Price</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tools as $tool): ?>
                <tr>
                    <td><?php echo $tool['name']; ?></td>
                    <td><?php echo $tool['category']; ?></td>
                    <td><?php echo $tool['quantity']; ?></td>
                    <td>$<?php echo $tool['rent_price']; ?></td>
                    <td>
                        <span style="color: <?php echo $tool['status'] == 'Available' ? 'green' : 'red'; ?>">
                            <?php echo $tool['status']; ?>
                        </span>
                    </td>
                    <td>
                        <button class="btn btn-edit">Edit</button>
                        <button class="btn btn-delete">Delete</button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="../js/admin_script.js"></script>

</body>
</html>