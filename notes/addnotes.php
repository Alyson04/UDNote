<?php
// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include database connection
include '../pages/_dbconn.php';

// Start the session to get the logged-in user ID
session_start();

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    // Redirect to login if user is not logged in
    header('Location: ../login.php');
    exit;
}

// Check if form data has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];

    // Sanitize input
    $title = htmlspecialchars($title, ENT_QUOTES);
    $description = htmlspecialchars($description, ENT_QUOTES);

    // Insert note into the database with the user_id
    $sql = "INSERT INTO notes (title, description, date, user_id) VALUES ('$title', '$description', NOW(), '$user_id')";

    if ($conn->query($sql) === TRUE) {
        // Redirect to the main page after adding the note
        $_SESSION['success'] = "Notes added successfully!";
    } else {
        $_SESSION['error'] = "Error: " . $conn->error;
    }
} else {
    $_SESSION['error'] = "Invalid Request!";
    
}
