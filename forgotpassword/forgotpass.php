<?php
include '_sendresetlink.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/forgotpass.css">
    <title>Forgot Password</title>
</head>
<body>
<img src="../assets/hehe.jfif" alt="background pic">
    <div class = "container">
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
    <h2> Forget Your Password?</h2>
    <p> Enter the Email associated with your account and we’ll <br> send you a link to reset your password </p>

<form action="_sendresetlink.php" method="post">
    <label for="email">EMAIL</label>
    <input type="email" id="email" name="email" required>
    <button type="submit">SUBMIT</button>
</form>

        <div class="signup"> 
            <h3> Don't have an account? </h3>
            <a href="../pages/signup.php"> SIGN UP </a>
        </div>
    </div>
        <script src="../script/forgotpass.js"></script>
</body>
</html>