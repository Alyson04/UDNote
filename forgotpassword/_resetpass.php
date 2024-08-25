<?php
require '_dbconn.php'; // Your database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = $_POST['token'];
    $newPassword = password_hash($_POST['password'], PASSWORD_BCRYPT);
    
    // Check if the token is valid and not expired
    $query = "SELECT email FROM password_resets WHERE token = ? AND expiry > NOW()";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $email = $row['email'];
        
        // Update the user's password
        $query = "UPDATE users SET password = ? WHERE email = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $newPassword, $email);
        $stmt->execute();
        
        // Delete the token so it can't be used again
        $query = "DELETE FROM password_resets WHERE email = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();

        echo 'Your password has been reset successfully.';
    } else {
        echo 'Invalid or expired token.';
    }
}
?>
