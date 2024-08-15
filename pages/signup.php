<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: home.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/signup_css.css">
    <title>Signup</title>
</head>
<body>

    <img src="../assets/try.png" alt="background pic">
    <div class="container">
    <?php
            if (isset($_SESSION['error'])) {
                echo '
                <div class="toast-container">
                    <p class="error">' . $_SESSION['error'] . '</p>
                </div>';
                unset($_SESSION['error']);
            }

            if (isset($_SESSION['success'])) {
                echo '
                <div class="toast-container">
                    <p class="success">' . $_SESSION['success'] . '</p>
                </div>';
                unset($_SESSION['success']);
            }
        ?>

    <h2>Signup</h2>
    <form action="./_signup.php" method="POST">
        <label for="fullName">Full Name:</label><br>
        <input autocomplete="off" type="text" name="fullName"><br><br>

        <label for="username">Username:</label><br>
        <input autocomplete="off" type="text" name="username"><br><br>
        
        <label for="email">Email:</label><br>
        <input autocomplete="off" type="email" name="email"><br><br>
        
        <label for="password">Password:</label><br>
        <input autocomplete="off" type="password" name="password" minlength="8"><br><br>

        <label for="password">Confirm Password:</label><br>
        <input autocomplete="off" type="password" name="confirmPassword" minlength="8"><br><br>
        
        <button type="submit">Register</button>
    </form>
    <a href="login.php">Login</a>
    </div>
    


    <script src="../script/signup.js"></script>
</body>
</html>
