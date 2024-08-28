<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/forgotpass.css">
    <title>Document</title>
</head>
<body>
<img src="../assets/hehe.jfif" alt="background pic">
    <div class = "container">
    <h2> Forget Your Password?</h2>
    <p> Enter the Email associated with your account and we’ll <br> send you a link to reset your password </p>

<form action="_sendresetlink.php" method="post">
    <label for="email">EMAIL</label>
    <input type="email" id="email" name="email" required>
    <button type="submit">SUBMIT</button>
</form>

        <div class="signup"> 
            <h3> Don't have an account? </h3>
            <a href="../pages/signup.php"> SIGN UP </a>
        </div>
    </div>

</body>
</html>