<?php

// Include your database connection file
include'./_dbconn.php';

// Check if the user is logged in by checking if the user_id session variable is set
if (isset($_SESSION['user_id'])) {
    // Get the user ID from the session
    $user_id = $_SESSION['user_id'];

    // Query to get the username
    $query = "SELECT username FROM users WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $username = ucwords(strtolower(htmlspecialchars($row['username'])));
    } else {
        $username = "Guest"; // Fallback if username not found
    }

    $stmt->close();
} else {
    // If user is not logged in, set username as Guest
    $username = "Guest";
}

// Close the database connection
$conn->close();

