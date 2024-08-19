<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>U'D Note</title>
    <link rel="stylesheet" href="../styles/index.css">
</head>
<body>
    
    <div id="navBar"></div>

    <script src="../script/script.js"></script>
</body>
</html>