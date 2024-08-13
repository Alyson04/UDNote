<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/login.css">
    <title>Login</title>
</head>
<body>
<div class = container>
    <div class = left-column>
    <h1> Welcome </h1>
    <h3>Capture, organize, and access your <br> ideas effortlessly.</h3>

    <form action="authenticate.php" method="POST">
        <label for="email">EMAIL</label><br>
        <input type="email" name="email" required><br><br>
        
        <label for="password">PASSWORD</label><br>
        <input type="password" name="password" required><br>

        <a href = "forgotpass.php"> Forgot Password?<br><br><br><br></a>
        <button type="submit">SIGN IN</button>
    </div>

    <div class = right-column> 
    <h2>NEW HERE?</h2> 
    <h3>Why wait? Join us now and <br> experience the difference!</h3>
    <a href="signup.php"> SIGN UP </a>
    </div>

</form>
</div>

</body>
</html>
