<?php
session_start();

// Initialize cart if it doesn't exist
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// ACTION: Add to Cart
if (isset($_POST['add_to_cart'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    // If item already exists, update quantity
    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]['quantity'] += $quantity;
    } else {
        // Add new item
        $_SESSION['cart'][$id] = [
            'name' => $name,
            'price' => $price,
            'quantity' => $quantity
        ];
    }
    header("Location: ../views/cart.php");
    exit();
}

// ACTION: Remove Item
if (isset($_GET['action']) && $_GET['action'] == 'remove') {
    $id = $_GET['id'];
    unset($_SESSION['cart'][$id]);
    header("Location: ../views/cart.php");
    exit();
}

// ACTION: Update Quantity
if (isset($_POST['update_cart'])) {
    $id = $_POST['id'];
    $quantity = $_POST['quantity'];
    
    if ($quantity > 0) {
        $_SESSION['cart'][$id]['quantity'] = $quantity;
    } else {
        unset($_SESSION['cart'][$id]); // Remove if quantity is 0
    }
    header("Location: ../views/cart.php");
    exit();
}
?>