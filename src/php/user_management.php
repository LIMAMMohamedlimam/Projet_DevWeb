<?php
session_start(); // Start the session

// Determine the task based on the 'action' parameter
$action = $_GET['action'] ?? 'check'; // Default to checking login status

if ($action == 'check') {
    // Check if the user is logged in
    $response = array('isLoggedIn' => isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in']);
} elseif ($action == 'logout') {
    // Perform logout
    unset($_SESSION['user_logged_in']);
    session_destroy();
    $response = array('success' => true);
}

header('Content-Type: application/json');
echo json_encode($response); // Send the JSON response back to the client
?>
