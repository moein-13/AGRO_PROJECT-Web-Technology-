<?php
session_start();
require_once '../models/db.php';

if (isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // 1. PHP Validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../views/login.php?error=invalid_email");
        exit();
    }

    // 2. Check Database for User
    $sql = "SELECT id, name, password, role FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        
        // 3. Verify Password
        if (password_verify($password, $user['password'])) {
            // 4. Create Session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['role'] = $user['role'];

            // 5. Redirect based on Role
            if ($user['role'] == 'Consumer') {
                header("Location: ../views/consumer_home.php");
            } else if ($user['role'] == 'Farmer') {
                // header("Location: ../views/farmer_home.php"); // Placeholder
                echo "Farmer Dashboard (Not implemented yet)";
            } else {
    // Redirect Admin to the new Controller
                header("Location: ../controllers/AdminController.php");
            }
            exit();
        } else {
            header("Location: ../views/login.php?error=wrong_pass");
        }
    } else {
        header("Location: ../views/login.php?error=user_not_found");
    }
}
?>