<?php
session_start();

if (isset($_SESSION['user_id'])) {
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

        <div class="left-column">
            <h1> WELCOME </h1>
            <h3>Capture, organize, and access your <br> ideas effortlessly.</h3>

            <form action="./_login.php" method="POST">
            <div class="entryarea">
                <input type="text" class="input" name="user_input" required>
                <div class="labelline">Email or Username</div>            
                
                <input autocomplete="off" type="password" name="password">
                <div class="labelline">Password</div>
            </div>

                
                <a href="forgotpass.php"> Forgot Password?</a>
                <button type="submit">LOGIN</button>
            </form>
        </div>
        <div class="right-column">
            <h2>NEW HERE?</h2>
            <h3>Why wait? Join us now and <br> experience the difference!</h3>
            <a href="signup.php"> SIGN UP </a>
        </div>
    </div>

    <script src="../script/login.js"></script>
</body>
</html>
