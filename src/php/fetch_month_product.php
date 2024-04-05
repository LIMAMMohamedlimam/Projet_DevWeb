<?php
// Database connection variables
$servername = "your_server_name";
$username = "your_username";
$password = "your_password";
$dbname = "your_database_name";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT name, description, image_link FROM product WHERE MONTH(sales_date) = MONTH(CURRENT_DATE()) AND YEAR(sales_date) = YEAR(CURRENT_DATE()) ORDER BY sales_count DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo '<div class="month-product-container">';
        echo '<img id="month-product-image" src="' . $row["image_link"] . '" alt="Featured Game">';
        echo '<h2 style="color: rgb(61, 61, 61); font-size: 22px;" id="month-product-name">' . $row["name"] . '</h2>';
        echo '<p style="color: rgb(61, 61, 61);font-size: 16px;" id="month-product-description">' . $row["description"] . '</p>';
        echo '</div>';
    }
} else {
    echo "0 results";
}
$conn->close();

?>
