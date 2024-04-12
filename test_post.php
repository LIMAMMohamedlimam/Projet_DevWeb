<?php
// Allow all CORS requests for testing purposes (not recommended for production).
header('Access-Control-Allow-Origin: *');
header('Content-Type: text/plain');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "Received POST request\n";
    if (!empty($_POST)) {
        echo "POST data is not empty\n";
        print_r($_POST);
    } else {
        echo "POST data is empty. Check input type and content-type headers.";
    }
} else {
    echo "This script only handles POST requests";
}
?>

