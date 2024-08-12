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
    <link rel="stylesheet" href="../styles/login.css">
    <title>Login</title>
</head>
<body>
    <div class="toast-container" id="toast-container">
        <?php
        if(isset($_SESSION['Error'])){
        echo($_SESSION['Error']);
        unset($_SESSION['Error']);
        }
        ?>
    </div>

    <div class="toast-container" id="toast-container">
        <?php
        if(isset($_SESSION['Success'])){
        echo($_SESSION['Sucess']);
        unset($_SESSION['Sucess']);
        }
        ?>
    </div>
    
    <h2>Login</h2>
    <form action="authenticate.php" method="POST">
        <label for="email">Email:</label><br>
        <input autocomplete="on" type="email" name="email" required><br><br>
        
        <label for="password">Password:</label><br>
        <input autocomplete="off" type="password" name="password" required><br><br>
        
        <button type="submit">Login</button>
    </form>

    <a href="signup.php">Signup</a>

    <script src="../script/script.js"></script>
</body>
</html>
