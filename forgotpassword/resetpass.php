<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/resetpass.css">
    <title>Reset Password</title>
</head>
<body>
<img src="../assets/hehe.jfif" alt="background pic">
    <form action="_resetpass.php" method="post">
        <?php
        session_start();
        if (isset($_SESSION['token'])) {
            echo '<input type="hidden" name="token" value="' . htmlspecialchars($_SESSION['token']) . '">';
        } else {
            // If token is missing, redirect to an error page
            header("Location: forgotpass.php");
            exit();
        }
        ?>
        <label for="password">Enter a new password:</label>
        <input type="password" id="password" name="password" required>
        <button type="submit">Reset Password</button>
    </form>
</body>
</html>
