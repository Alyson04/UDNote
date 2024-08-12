<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
</head>
<body>
    <?php
error_reporting(E_ALL);
ini_set('display_errors', 1);


    if (isset($_POST["submit"])) {
       $firstName = $_POST["firstName"];
        $lastName = $_POST["lastName"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $confirmPassword = $_POST["confirmPassword"];

        $passHash = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $errors = array();

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            array_push($errors, "Email not valid");
        }

        if (strlen($password)<8) {
            array_push($errors, "Password must be atleast 8 characters long");
        }

        if ($password !== $confirmPassword) {
            array_push($errors, "Passwords does not match");
        }

         

    //     $sql = "SELECT * FROM users WHERE email ='$email'";
    //     $result = mysqli_query($conn, $sql);
    //     $rowCount = mysqli_num_rows($result);

    //     if ($rowCount > 0) {
    //         array_push($errors, "Email already exists");
    //     }
        if (count($errors) > 0) {
            foreach ($errors as $error){
                echo "<div>$error</div>";
            }}
            require_once "register.php";
    //     }else{
            
    //         $sql = "INSERT INTO users (firstName, lastName, email, password) VALUES (?, ?, ?, ?)";
    //         $stmt = mysqli_stmt_init($conn);
    //         $prepareStmt = mysqli_prepare($stmt, $sql);
    //         if ($prepareStmt) {
    //             mysqli_stmt_bind_param($stmt, "ssss", $firstName, $lastName, $email, $passHash );
    //             mysqli_stmt_execute($stmt);
    //             echo "<div>Sucessfully Registered</div>";
    //         } else {
    //             die("Something went wrong");
    //         }
    //     }
    } 
    
    ?>

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
