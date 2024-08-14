<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/signup_css.css">
    <title>Signup</title>
</head>
<body>
<img src="../assets/try.png">
<div class = "container"> 
    <h2>Welcome to U'D Note!</h2>
    <form action="register.php" method="POST">

    <div class = "name">
        <div> 
        <label for="firstName">FIRST NAME</label><br>
        <input type="text" name="firstName" required><br><br>
        </div>
        <div>
        <label for="lastName">LAST NAME</label><br>
        <input type="text" name="lastName" required><br><br>
        </div>
        </div>

        <label for="email">EMAIL</label><br>
        <input type="email" name="email" required><br><br>
        
        <label for="password">PASSWORD</label><br>
        <input type="password" name="password" required><br><br>

        <label for="password">CONFIRM PASSWORD</label><br>
        <input type="password" name="password" required><br><br>

        <button type="submit">CREATE ACCOUNT</button><br>

    <h3> Already have an account? </h3>
    <a href="login.php">Sign In</a>
    </form>

</div>
</body>
</html>
