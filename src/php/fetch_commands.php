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

   // Create a new PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

    // Prepare a SQL query to fetch all commands for the current user
    $stmt = $pdo->prepare('SELECT * FROM commande WHERE user_id = :userId AND status = "pending"');
    $stmt->execute(['userId' => $userId]);

    // Fetch all commands as an associative array
    $commands = $stmt->fetchAll(PDO::FETCH_ASSOC);

    //get the name of the products the responding with json file

    foreach ($commands as $key => $command) {
        $stmt = $pdo->prepare('SELECT * FROM product WHERE id = :productId');
        $stmt->execute(['productId' => $command['product_id']]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);
        $commands[$key]['product'] = $product;

    }
    
    // Fetch all the products data from the product table appearing in the commands
    $productIds = array_column($commands, 'product_id');
    $stmt = $pdo->prepare('SELECT * FROM product WHERE id IN (' . implode(',', $productIds) . ')');
    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Associate the products with the corresponding commands
    foreach ($commands as $key => $command) {
        foreach ($products as $product) {
            if ($command['product_id'] == $product['id']) {
                $commands[$key]['product'] = $product;
                break;
            }
        }
    }


    


    // Return the products as a JSON object
    // 
    echo json_encode($commands);


} else {
    // Return an error message if the user is not logged in
    echo json_encode(['error' => 'You are not logged in']);
}

?>
