<?php
session_start() ;
header('Content-Type: application/json');



// Define database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cy-play";

// Establish connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve email and password from JSON request
$json = file_get_contents('php://input');
$data = json_decode($json, true);
$email = $data['email'];
$password = $data['password']; // You should use password hashing in production

// Prepare and bind
$stmt = $conn->prepare("SELECT * FROM user WHERE email = ? AND password = ?");
$stmt->bind_param("ss", $email, $password);

// Execute the query
$stmt->execute();
$result = $stmt->get_result();

// query to get the user id
$stmt = $conn->prepare("SELECT id FROM user WHERE email = ? AND password = ?");
$stmt->bind_param("ss", $email, $password);
$stmt->execute();
$result_userId = $stmt->get_result();
$user_id = $result_userId->fetch_assoc();
$_SESSION['user_id'] = $user_id['id'];


// Check if user exists in the database
if ($result->num_rows > 0) {
    // User found, create a success response
    $response = ['status' => true, 'message' => 'Login successful.' , 'user' => $result->fetch_assoc()];
   
    // Store user data in the session
    $_SESSION['user'] = $response['user'];
} else {
    // User not found, create an error response
    $response = ['status' => false, 'message' => 'Invalid credentials.'];
}

// Send JSON response back to the client

echo json_encode($response);

// Close statement and connection
$stmt->close();
$conn->close();
?>
