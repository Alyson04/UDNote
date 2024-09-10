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

// Check if note ID is provided
if (isset($_POST['note_id'])) {
    $note_id = intval($_POST['note_id']);

    // Delete note from the database
    $sql = "DELETE FROM notes WHERE id = $note_id AND user_id = $user_id";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['success'] = "Note deleted successfully";
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "Note ID not provided.";
}
