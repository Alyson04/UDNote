<?php
ini_set('display_errors', 1);
// Include your database connection file
include './_dbconn.php';

// Initialize variables
$username = "Guest";
$profile_picture = "";

// Check if the user is logged in by checking if the user_id session variable is set
if (isset($_SESSION['user_id'])) {
    // Get the user ID from the session
    $user_id = $_SESSION['user_id'];

    // Query to get the username and profile picture
    $query = "SELECT username, profile_picture FROM users WHERE ID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $username = ucwords(strtolower(htmlspecialchars($row['username'])));
        $profile_picture = $row['profile_picture'];
        $default_profile_picture = '../assets/profile-icon.jpg';// Update this path as needed

        // Use the default profile picture if $profile_picture is empty
        $profile_picture_src = !empty($profile_picture) ? $profile_picture : $default_profile_picture;
        $profile_picture = htmlspecialchars($profile_picture_src);
    }

    $stmt->close();
}

// Close the database connection
$conn->close();

