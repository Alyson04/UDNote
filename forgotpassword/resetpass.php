<?php
session_start();
include '../pages/_dbconn.php'; // Your database connection file
date_default_timezone_set('Asia/Manila');

if (isset($_GET['token'])) {
    $token = $_GET['token'];
    
    // Validate the token
    $query = "SELECT user_id FROM password_resets WHERE token = ? AND expiry > NOW()";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['token'] = $token;
        $isValidToken = true;
    } else {
        $_SESSION['error'] = 'Invalid or expired token.';
        header('Location: forgotpass.php');
        exit();
    }
} else {
    $_SESSION['error'] = 'No token provided.';
    header('Location: forgotpass.php');
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
    <?php if ($isValidToken): ?>
        <form action="_resetpass.php" method="post">
            <input type="hidden" name="token" value="<?php echo htmlspecialchars($_SESSION['token']); ?>">
            <label for="password">Enter a new password:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Reset Password</button>
        </form>
    <?php endif; ?>
</body>
</html>
