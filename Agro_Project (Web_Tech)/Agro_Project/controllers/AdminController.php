<?php
session_start();
require_once '../models/AdminModel.php';

// Auth Check (Uncomment this when you are ready to enforce login)
// if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] != 'Admin') {
//     header("Location: ../views/login.php"); 
// }

$action = $_GET['action'] ?? 'dashboard';

// --- DASHBOARD ---
if ($action == 'dashboard') {
    $stats = getDashboardStats();
    include '../views/admin_dashboard.php';
} 

// --- INVENTORY ---
elseif ($action == 'inventory') {
    $tools = getAllTools();
    include '../views/admin_inventory.php';
} 

// --- FARMERS ---
elseif ($action == 'farmers') {
    $farmers = getAllFarmers();
    include '../views/admin_farmers.php';
} 

// --- ADD TOOL (AJAX) ---
elseif ($action == 'add_tool') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = htmlspecialchars($_POST['name']);
        $category = $_POST['category'];
        $qty = (int)$_POST['quantity'];
        $price = (float)$_POST['price'];

        if (!empty($name) && $qty >= 0 && $price >= 0) {
            addTool($name, $category, $qty, $price);
            echo json_encode(["status" => "success", "message" => "Tool Added Successfully"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Invalid Input"]);
        }
        exit;
    }
}

// --- BLOCK/UNBLOCK USER ---
elseif ($action == 'toggle_status') {
    $id = $_GET['id'];
    $current_status = $_GET['status'];
    $new_status = ($current_status == 'Active') ? 'Blocked' : 'Active';
    
    updateUserStatus($id, $new_status);
    header("Location: AdminController.php?action=farmers"); // Refresh page
}

?>