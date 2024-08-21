<?php
session_start(); // Start the session to access session variables
include '_dbconn.php'; // Include the database connection

// Assuming the user ID is stored in a session variable
$userId = $_SESSION['user_id']; 

// Prepare and execute the query
$query = "SELECT username, email, fullname FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Pass the user data to the HTML file
if ($user) {
    $username = ucwords(strtolower(htmlspecialchars($user['username'])));
    $email = ucwords(strtolower(htmlspecialchars($user['email'])));
    $fullname = ucwords(strtolower(htmlspecialchars($user['fullname'])));
} else {
    $username = $email = $fullname = "Not Available";
}

// Close the statement and connection
$stmt->close();
$conn->close();


