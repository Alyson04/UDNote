<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include '../pages/_dbconn.php'; // Your database connection file
date_default_timezone_set('Asia/Manila');

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

        session_start();
        session_unset();
        session_destroy();
        
        session_start();
        $_SESSION['success'] = "Your password has been reset successfully.";
        header("Location: ../pages/login.php");
        exit;
    } else {
        $_SESSION['error'] = "Invalid or expired token.";
        header("Location: forgotpass.php");
        exit;
    }
} else {
    // Redirect or show an error if the form is accessed incorrectly
    header('Location: resetpass.php');
    exit();
}
