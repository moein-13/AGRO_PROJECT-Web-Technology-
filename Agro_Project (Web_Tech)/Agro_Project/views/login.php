<!DOCTYPE html>
<html lang="en">
<head>
    <title>AGRO - Login</title>
    <link rel="stylesheet" href="../css/style.css">
    <script src="../js/script.js"></script>
</head>
<body>

    <div class="container" style="max-width: 350px; text-align:center;">
        <h2>Login</h2>
        
        <?php if(isset($_GET['success'])) echo "<p style='color:green'>Registration Successful!</p>"; ?>
        <?php if(isset($_GET['error'])) echo "<p style='color:red'>Invalid Credentials</p>"; ?>
        
        <form name="loginForm" action="../controllers/login_check.php" method="POST" onsubmit="return validateLoginForm()">
            
            <label style="text-align: left; display:block;">Email</label>
            <input type="email" name="email" required>
            
            <label style="text-align: left; display:block;">Password</label>
            <input type="password" name="password" required>
            
            <button type="submit" name="login">Login</button>
        </form>
        
        <p>Don't have an account? <a href="register.php">Register here</a></p>
    </div>

</body>
</html>