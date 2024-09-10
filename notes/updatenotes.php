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
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['note_id']) && isset($_POST['title']) && isset($_POST['description'])) {
    $note_id = intval($_POST['note_id']);
    $title = $_POST['title'];
    $description = $_POST['description'];

    // Sanitize input
    $title = htmlspecialchars($title, ENT_QUOTES);
    $description = htmlspecialchars($description, ENT_QUOTES);

    // Update note in the database
    $sql = "UPDATE notes SET title = '$title', description = '$description', date = NOW() WHERE id = $note_id AND user_id = $user_id";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['success'] = "Note updated successfully";
        //echo "Note updated successfully";
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "Invalid request.";
}
