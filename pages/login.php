<?php
session_start();

if (isset($_SESSION['user_id'])) {
    // If the user is logged in, add a flag to the page for JS redirection
    echo '<script> var isLoggedIn = true; </script>';
} else {
    echo '<script> var isLoggedIn = false; </script>';
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/login_css.css">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form action="authenticate.php" method="POST">
        <label for="email">Email:</label><br>
        <input type="email" name="email" required><br><br>
        
        <label for="password">Password:</label><br>
        <input type="password" name="password" required><br><br>
        
        <button type="submit">Login</button>
    </form>

    <a href="signup.php">Signup</a>
</body>
</html>
