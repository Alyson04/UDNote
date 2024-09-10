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
    <link rel="stylesheet" href="./styles/login_css.css">
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

                <form action="./pages/_login.php" method="POST">
                    <div class="input-group">
                        <input type="text" id="email" name="user_input" class="input" required>
                        <label for="email" class="labelline">Email or Username</label>
                    </div>
                    <div class="input-group">
                        <input type="password" id="password" name="password" class="input" required>
                        <label for="password" class="labelline">Password</label>
                    </div>
                    <a href="../forgotpassword/forgotpass.php">Forgot Password?</a>
                    <button type="submit">LOGIN</button>
                </form>
            </div>
            <div class="right-column"> 
                <h2>NEW HERE?</h2> 
                <h3>Why wait? Join us now and <br> experience the difference!</h3>
                <a href="./pages/signup.php"> SIGN UP </a>
            </div>
            
        </div>

    <script src="./script/login.js"></script>
</body>
</html>