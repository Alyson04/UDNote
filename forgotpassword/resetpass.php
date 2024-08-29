<?php
include '_validatetoken.php';

// Check if the token is set in the session
if (!isset($_SESSION['token']) || empty($_SESSION['token'])) {
    $_SESSION['error'] = "Access denied.";
    header("Location: forgotpass.php");
    exit();
}
?>
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
        <input type="hidden" name="token" value="<?php echo htmlspecialchars($_SESSION['token']); ?>">
        <label for="password">Enter a new password:</label>
        <input type="password" id="password" name="password" required>
        <button type="submit">Reset Password</button>
    </form>
</body>
</html>
