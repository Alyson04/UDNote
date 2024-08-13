<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
</head>
<body>
    <div class="container">
    <h2>Signup</h2>
    <form action="signup.php" method="POST">
        <label for="firstName">First Name:</label><br>
        <input type="text" name="firstName" required><br><br>

        <label for="lastName">Last Name:</label><br>
        <input type="text" name="lastName" required><br><br>
        
        <label for="email">Email:</label><br>
        <input type="email" name="email" required><br><br>
        
        <label for="password">Password:</label><br>
        <input type="password" name="password" required><br><br>

        <label for="password">Confirm Password:</label><br>
        <input type="password" name="confirmPassword" required><br><br>
        
        <button type="submit" name="submit">Register</button>
    </form>

    <a href="login.php">Login</a>

    </div>
</body>
</html>
