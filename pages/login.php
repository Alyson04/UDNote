<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
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
                    <p class = "error">' . $_SESSION['error'] . '</p>
                </div>';
                unset($_SESSION['error']);
            }

            if (isset($_SESSION['success'])) {
                echo '
                <div class="toast-container">
                    <p class = "sucess">' . $_SESSION['success'] . '</p>
                </div>';
                unset($_SESSION['success']);
            }
        ?>
   
            <div class="left-column">
                <h1> WELCOME </h1>
                <h3>Capture, organize, and access your <br> ideas effortlessly.</h3>

                <form action="./_login.php" method="POST">
                    <label for="user_input">Email:</label>
                    <input autocomplete="on" type="text" name="user_input" required>
                    
                    <label for="password">Password:</label>
                    <input autocomplete="off" type="password" name="password" required>
                    
                    <a href = "forgetpass.php"> Forgot Password?</a>
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
