<?php
session_start(); // Start the session

header('Content-Type: application/json'); // Set the header to return JSON content

// Check if the user is logged in and has a session variable set (e.g., user_id)
if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];

    // Database connection parameters
    $host = 'localhost';
    $dbname = 'cy-play';
    $username = 'root';
    $password = '';

    try {
        // Create a new PDO connection
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

        // Set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare the SQL query
        $stmt = $conn->prepare("SELECT * FROM commande c , user u WHERE c.user_id = u.id and ");
        $stmt->bindParam(':user_id', $userId);

        // Execute the query
        $stmt->execute();

        // Fetch all the user's commands
        $commands = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Return the commands as JSON
        echo json_encode($commands);
    } catch (PDOException $e) {
        // Return an error message if the database connection or query fails
        echo json_encode(['error' => $e->getMessage()]);
    }
} else {
    // Return an error message if the user is not logged in or the session variable is not set
    echo json_encode(['error' => 'User not logged in or session variable not set']);
}
?>
