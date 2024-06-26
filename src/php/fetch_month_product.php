<?php

header('Content-Type: application/json');

// Database connection variables
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cy-play";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    // Return a JSON-encoded error if the connection fails
    echo json_encode(['error' => 'Database connection failed']);
    exit(); // Stop script execution after an error
}


$sql = "SELECT name, description, imagelink, max(nbofachat) AS total_quantity_sold
FROM product 
GROUP BY name, description, imagelink
ORDER BY total_quantity_sold DESC
LIMIT 1";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode($row); // Encode the result as a JSON object
} else {
    echo json_encode(["message" => "No results found"]); // Return an error message if no results
}

$conn->close();

?>
