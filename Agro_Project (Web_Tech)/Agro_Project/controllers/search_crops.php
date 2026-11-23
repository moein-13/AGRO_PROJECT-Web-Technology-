<?php
require_once '../models/db.php';

// Get the search query from the URL, default to empty string
$q = isset($_GET['q']) ? $_GET['q'] : '';

// Prepare SQL query (Search by Name)
if ($q != '') {
    // Search for matches
    $sql = "SELECT * FROM crops WHERE name LIKE ?";
    $stmt = $conn->prepare($sql);
    $searchTerm = "%" . $q . "%";
    $stmt->bind_param("s", $searchTerm);
} else {
    // If no search, show all crops
    $sql = "SELECT * FROM crops";
    $stmt = $conn->prepare($sql);
}

$stmt->execute();
$result = $stmt->get_result();
$crops = [];

while ($row = $result->fetch_assoc()) {
    $crops[] = $row;
}

// Set header to JSON so JS knows how to parse it
header('Content-Type: application/json');
echo json_encode($crops);
?>