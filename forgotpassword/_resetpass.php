<?php
<<<<<<< HEAD
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require '../pages/_dbconn.php'; // Your database connection file
date_default_timezone_set('Asia/Manila');
<<<<<<< HEAD
=======

>>>>>>> 4ce01f4836141f1e4793060c4861101c167b819c

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = $_POST['token'];
    $newPassword = password_hash($_POST['password'], PASSWORD_BCRYPT);
    
    // Check if the token is valid and not expired
    $query = "SELECT user_id FROM password_resets WHERE token = ? AND expiry > NOW()";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $userId = $row['user_id'];
        
        // Update the user's password
        $query = "UPDATE users SET password = ? WHERE ID = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("si", $newPassword, $userId);
        $stmt->execute();
        
        // Delete the token so it can't be used again
        $query = "DELETE FROM password_resets WHERE user_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $userId);
        $stmt->execute();

        echo 'Your password has been reset successfully.';
    } else {
        echo 'Invalid or expired token.';
    }
}
<<<<<<< HEAD

=======
>>>>>>> 4ce01f4836141f1e4793060c4861101c167b819c
=======
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

>>>>>>> 7e2d6159533bd6654c5927c45acc48acfe5f80b7
