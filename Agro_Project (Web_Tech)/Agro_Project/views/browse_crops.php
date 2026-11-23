<?php
session_start();
// Security Check
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Consumer') {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Browse Crops - AGRO</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

    <div class="container" style="max-width: 1200px;">
        
        <div class="header">
            <h1>Marketplace</h1>
            <div class="nav-links">
                <a href="consumer_home.php">Dashboard</a>
                <a href="cart.php">My Cart</a>
                <a href="../logout.php" class="btn-danger" style="padding: 5px 10px; font-size:14px;">Logout</a>
            </div>
        </div>

        <input type="text" id="search" placeholder="Search for crops (e.g., Potato)..." onkeyup="fetchCrops()">

        <hr>

        <div id="crop-grid" class="crop-container">
            </div>

    </div>

    <script>
        // AJAX Function to Fetch Data
        function fetchCrops() {
            let query = document.getElementById('search').value;
            
            // Using Fetch API (Modern AJAX)
            fetch('../controllers/search_crops.php?q=' + query)
                .then(response => response.json())
                .then(data => {
                    let output = '';
                    if (data.length > 0) {
                        data.forEach(crop => {
                            // Note: We use the CSS classes 'crop-card' and 'crop-img' here
                            output += `
                                <div class="crop-card">
                                    <img src="../images/${crop.image}" class="crop-img" alt="${crop.name}">
                                    <h3>${crop.name}</h3>
                                    <p class="price">${crop.price} BDT / kg</p>
                                    <a href="crop_details.php?id=${crop.id}" class="btn-buy">View Details</a>
                                </div>
                            `;
                        });
                    } else {
                        output = '<p style="text-align:center; width:100%;">No crops found matching your search.</p>';
                    }
                    document.getElementById('crop-grid').innerHTML = output;
                })
                .catch(error => console.error('Error:', error));
        }

        // Load all crops when page loads
        window.onload = fetchCrops;
    </script>

</body>
</html>