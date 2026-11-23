<?php
session_start();
require_once '../models/db.php';

if (isset($_POST['submit'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $role = $_POST['role'];

    // 1. PHP Validation
    if (empty($name) || empty($email) || empty($password) || empty($role)) {
        die("All fields are required.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format.");
    }

    if ($password !== $confirm_password) {
        die("Passwords do not match.");
    }

    // 2. Check if email already exists
    $checkQuery = "SELECT id FROM users WHERE email = ?";
    $stmt = $conn->prepare($checkQuery);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "Email already registered. <a href='../views/login.php'>Login</a>";
    } else {
        // 3. Hash Password & Insert
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        $insertQuery = "INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($insertQuery);
        $stmt->bind_param("ssss", $name, $email, $hashed_password, $role);
        
        if ($stmt->execute()) {
            // Registration successful, redirect to login
            header("Location: ../views/login.php?success=registered");
        } else {
            echo "Error: " . $conn->error;
        }
    }
    $stmt->close();
    $conn->close();
}
?>