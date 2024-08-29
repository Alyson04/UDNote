<?php
require '../pages/_dbconn.php'; // Database connection

// Check if the token is provided in the URL
if (!isset($_GET['token']) || empty($_GET['token'])) {
    header("Location: forgotpass.php");
    exit();
}

$token = $_GET['token'];

// Check if the token is valid and not expired
$query = "SELECT user_id FROM password_resets WHERE token = ? AND expiry > NOW()";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $token);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    header("Location: forgotpass.php");
    exit();
}

// If valid, store the token in session and redirect to the HTML form
session_start();
$_SESSION['token'] = $token;
header("Location: resetpass.php");
exit();

