<?php
session_start();

// Redirect logged-in users to home page
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
                <div class="toast-container error-toast">
                    <p class="error">' . htmlspecialchars($_SESSION['error']) . '</p>
                </div>';
                unset($_SESSION['error']);
            }

            if (isset($_SESSION['success'])) {
                echo '
                <div class="toast-container success-toast">
                    <p class="success">' . htmlspecialchars($_SESSION['success']) . '</p>
                </div>';
                unset($_SESSION['success']);
            }
        ?>

        <div class="form-control">
            <h2>Welcome to U'D Note!</h2>
            <form action="./_signup.php" method="POST" autocomplete="off">
                <div class="input-data">
                    <input type="text" name="fullName" required>
                    <div class="underline"></div>
                    <label>FULL NAME</label>
                </div>
                <div class="input-data">
                    <input type="text" name="username" required>
                    <div class="underline"></div>
                    <label>USERNAME</label>
                </div>
                <div class="input-data">
                    <input type="email" name="email" required>
                    <div class="underline"></div>
                    <label>EMAIL</label>
                </div>
                <div class="input-data">
                    <input type="password" name="password" minlength="8" required>
                    <div class="underline"></div>
                    <label>PASSWORD</label>
                </div>
                <div class="input-data">
                    <input type="password" name="confirmPassword" minlength="8" required>
                    <div class="underline"></div>
                    <label>CONFIRM PASSWORD</label>
                </div>
                <button type="submit">CREATE ACCOUNT</button>
                <h3>Already have an account? <a href="../index.php">Sign In</a></h3>
            </form>
        </div>
    </div>
    <script src="../script/signup.js"></script>
</body>
</html>
