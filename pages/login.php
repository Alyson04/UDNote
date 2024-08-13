<?php
session_start();

if (isset($_SESSION['ID'])) {
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
    <div class="toast-container" id="toast-container">
        <?php
        if(isset($_SESSION['Error'])){
        echo($_SESSION['Error']);
        unset($_SESSION['Error']);
        }

        if(isset($_SESSION['Success'])){
            echo($_SESSION['Success']);
            unset($_SESSION['Success']);
        }
        ?>
    </div>
    
        <div class="container">
            <div class="left-column">
                <h1> WELCOME </h1>
                <h3>Capture, organize, and access your <br> ideas effortlessly.</h3>

                <form action="authenticate.php" method="POST">
                    <label for="email">Email:</label>
                    <input autocomplete="on" type="email" name="email" required>
                    
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

    <script src="../script/script.js"></script>
</body>
</html>
