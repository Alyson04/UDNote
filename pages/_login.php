<?php
session_start();
include './_dbconn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_input = $_POST['user_input'];//so that it will search for either email or username in the db
    $password = $_POST['password'];
    
    if (empty($user_input) || empty($password)) {
        $_SESSION['error'] = "Both fields are required.";
        header("Location: login.php");
        exit();
    }
    

    // Basic input sanitization
    $user_input = mysqli_real_escape_string($conn, $user_input);
    
    // To prepare the SQL statement to check either username or email
    $sql = "SELECT * FROM users WHERE email = '$user_input' OR username = '$user_input'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        // Verify password
        if (password_verify($password, $row['password'])) {
            // echo "Login successful!";
            // Set session variables or perform other actions after successful login
            $_SESSION['user_id'] = $row['ID'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['success'] = "Login successful!";
            // Redirect to a protected page or dashboard
            header("Location: login.php");
            exit();
        } else {
            $_SESSION['error'] = "Invalid password";
        }
    } else {
        $_SESSION['error'] = "No user found with that username or email";
    }
    header("Location: login.php");
    exit();
}
