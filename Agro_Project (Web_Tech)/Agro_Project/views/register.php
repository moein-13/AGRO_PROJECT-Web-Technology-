<!DOCTYPE html>
<html lang="en">
<head>
    <title>AGRO - Registration</title>
    <link rel="stylesheet" href="../css/style.css">
    <script src="../js/script.js"></script>
</head>
<body>

    <div class="container" style="max-width: 400px;">
        <h2>Register</h2>
        
        <form name="regForm" action="../controllers/register_check.php" method="POST" onsubmit="return validateRegisterForm()">
            
            <label>Name</label>
            <input type="text" name="name" required>
            
            <label>Email</label>
            <input type="email" name="email" required>
            
            <label>Password</label>
            <input type="password" name="password" required>
            
            <label>Confirm Password</label>
            <input type="password" name="confirm_password" required>
            
            <label>Role</label>
                <select name="role">
                    <option value="Consumer">Consumer</option>
                    <option value="Farmer">Farmer</option>
                    <option value="Admin">Admin</option>
                </select>

            <button type="submit" name="submit">Register</button>
        </form>
        
        <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>

</body>
</html>