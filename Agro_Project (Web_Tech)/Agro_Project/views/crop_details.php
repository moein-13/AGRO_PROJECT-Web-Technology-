<?php
session_start();
require_once '../models/db.php';

if (!isset($_GET['id'])) { die("Product ID missing."); }
$id = $_GET['id'];
$sql = "SELECT * FROM crops WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$crop = $result->fetch_assoc();

if (!$crop) { die("Crop not found."); }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $crop['name']; ?> - Details</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

    <div class="container" style="max-width: 600px;">
        <h1><?php echo $crop['name']; ?></h1>
        
        <div style="text-align:center; margin-bottom: 20px;">
            <img src="../images/<?php echo $crop['image']; ?>" alt="<?php echo $crop['name']; ?>" style="max-width: 100%; border-radius: 8px;">
        </div>
        
        <p class="price">Price: <?php echo $crop['price']; ?> BDT / kg</p>
        <p><strong>Description:</strong></p>
        <p><?php echo $crop['description']; ?></p>
        <p><small>Posted on: <?php echo $crop['created_at']; ?></small></p>

        <hr>

        <form action="../controllers/cart_controller.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $crop['id']; ?>">
            <input type="hidden" name="name" value="<?php echo $crop['name']; ?>">
            <input type="hidden" name="price" value="<?php echo $crop['price']; ?>">
            
            <label>Quantity (kg):</label>
            <input type="number" name="quantity" value="1" min="1" style="width: 80px;">
            
            <button type="submit" name="add_to_cart" class="btn-buy">Add to Cart</button>
        </form>

        <br>
        <a href="browse_crops.php" class="btn-back">← Back to Marketplace</a>
    </div>

</body>
</html>