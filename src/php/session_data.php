<?php
session_start();
header('Content-Type: application/json');

$response = ['username' => isset($_SESSION['user']) ? $_SESSION['user'] : null];
echo json_encode($response);

?>