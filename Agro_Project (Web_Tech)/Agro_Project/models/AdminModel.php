<?php
require_once 'db_config.php';

function getDashboardStats() {
    global $conn;
    $stats = [];
    
    // Count Farmers (Using your capitalized ENUM 'Farmer')
    $result = $conn->query("SELECT COUNT(*) as count FROM users WHERE role='Farmer'");
    $stats['farmers'] = $result->fetch_assoc()['count'];

    // Count Consumers (Using your capitalized ENUM 'Consumer')
    $result = $conn->query("SELECT COUNT(*) as count FROM users WHERE role='Consumer'");
    $stats['consumers'] = $result->fetch_assoc()['count'];

    // Count Tools (From the new tools table)
    $result = $conn->query("SELECT SUM(quantity) as count FROM tools");
    $row = $result->fetch_assoc();
    $stats['tools'] = $row['count'] ? $row['count'] : 0; // Handle null if empty
    
    // Count Crops (Using your 'crops' table)
    $result = $conn->query("SELECT COUNT(*) as count FROM crops");
    $stats['crops'] = $result->fetch_assoc()['count'];

    return $stats;
}

function getAllTools() {
    global $conn;
    $result = $conn->query("SELECT * FROM tools ORDER BY created_at DESC");
    return $result->fetch_all(MYSQLI_ASSOC);
}

function addTool($name, $category, $qty, $price) {
    global $conn;
    $status = ($qty > 0) ? 'Available' : 'Out of Stock';
    $stmt = $conn->prepare("INSERT INTO tools (name, category, quantity, rent_price, status) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssids", $name, $category, $qty, $price, $status);
    return $stmt->execute();
}

function getAllFarmers() {
    global $conn;
    // We join 'users' with 'crops' to count how many crops each farmer has uploaded
    // Note: 'created_at' is used instead of 'joined_date' to match your schema
    $sql = "SELECT u.id, u.name, u.email, u.created_at, u.status, 
            (SELECT COUNT(*) FROM crops c WHERE c.farmer_id = u.id) as total_crops 
            FROM users u WHERE u.role = 'Farmer'";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Function to Block/Unblock Farmer
function updateUserStatus($id, $status) {
    global $conn;
    $stmt = $conn->prepare("UPDATE users SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $status, $id);
    return $stmt->execute();
}

?>