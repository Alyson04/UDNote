<?php
session_start();
include '_dbconn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userId = $_SESSION['user_id'];
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $fullname = htmlspecialchars($_POST['fullName']);

    if (empty($username) || empty($email) || empty($fullname)){
        $_SESSION['error'] = "Cannot be empty";
    }else{
        $query = "UPDATE users SET username = ?, email = ?, fullName = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssi", $username, $email, $fullname, $userId);
        $stmt->execute();

        $_SESSION['success'] = "Changed Successfully!";
    }

    

    // Redirect back to profile or display success message
    header("Location: editprofile.php");
    exit();
}

