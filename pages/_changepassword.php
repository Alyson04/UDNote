<?php
session_start();
include '_dbconn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userId = $_SESSION['user_id'];
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if the old password is correct
    $query = "SELECT password FROM users WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if (password_verify($old_password, $user['password'])) {
        if ($new_password === $confirm_password) {
            // Update password
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            $update_query = "UPDATE users SET password = ? WHERE id = ?";
            $stmt = $conn->prepare($update_query);
            $stmt->bind_param("si", $hashed_password, $userId);
            $stmt->execute();

            // Redirect with success message
            header("Location: editprofile.php?message=Password changed successfully");
            exit();
        } else {
            // Passwords do not match
            header("Location: editprofile.php?error=New passwords do not match");
            exit();
        }
    } else {
        // Old password is incorrect
        header("Location: editprofile.php?error=Old password is incorrect");
        exit();
    }
}