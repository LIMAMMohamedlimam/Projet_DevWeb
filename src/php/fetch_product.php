<?php

// Assuming you have a MySQL database
$host = 'localhost'; // or your host
$username = 'root';
$password = '';
$database = 'cy-play';

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the category from the URL parameter
$category = isset($_GET['category']) ? $_GET['category'] : '';

// Prepare a SQL statement to prevent SQL injection
$stmt = $conn->prepare("SELECT * FROM product WHERE categorie = ?");
$stmt->bind_param("s", $category); // 's' specifies the variable type => 'string'

// Execute the query
$stmt->execute();
$result = $stmt->get_result();

// Fetch all the records
$products = $result->fetch_all(MYSQLI_ASSOC);

// Close the statement and the connection
$stmt->close();
$conn->close();

// Return the data as JSON
header('Content-Type: application/json');
echo json_encode($products);


?>
