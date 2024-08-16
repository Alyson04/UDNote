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

    
    <div class="form-control">
    <h2>Welcome to U'D Note!</h2>
    <form action="./_signup.php" method="POST" autocomplete="off">
        <label for="fullName">FULL NAME</label>
        <input type="text" name="fullName">

        <label for="username">USERNAME</label>
        <input type="text" name="username">
        
        <label for="email">EMAIL</label>
        <input type="email" name="email">
        
        <label for="password">PASSWORD</label>
        <input type="password" name="password" minlength="8">

        <label for="password">CONFIRM PASSWORD</label>
        <input type="password" name="confirmPassword" minlength="8">
        
        <button type="submit">CREATE ACCOUNT</button>
        <h3>Already have an account? <a href="login.php">Sign In</a></h3>
        
    </form>
    </div>
    </div>
    


    <script src="../script/signup.js"></script>
</body>
</html>
