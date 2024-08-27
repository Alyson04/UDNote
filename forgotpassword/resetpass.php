<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- reset_password.html -->
<form action="_resetpass.php" method="post">
    <input type="hidden" name="token" value="<?php echo $_GET['token']; ?>">
    <label for="password">Enter a new password:</label>
    <input type="password" id="password" name="password" required>
    <button type="submit">Reset Password</button>
</form>

</body>
</html>