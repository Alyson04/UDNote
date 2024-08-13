<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = 'localhost';
$dbname = 'udnote';
$username = 'root';
$password = '';


try {
    // Establish a connection to the database
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Get the form inputs
        $email = $_POST['email'];
        $pass = $_POST['password'];

        // Validate form inputs
        if (empty($email) || empty($pass)) {
            $_SESSION['Error'] = 'Fields are empty';
        } else {
            // Prepare the SQL statement
            $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Verify the password
            if ($user && password_verify($pass, $user['password'])) {
                // Start a session and store user info (optional)
                session_start();
                $_SESSION['ID'] = $user['ID'];
                $_SESSION['firstName'] = $user['firstName'];
                $_SESSION['lastName'] = $user['lastName'];

                //$_SESSION['Success'] = 'Log in Success';
                
                // Redirect to a dashboard or another page (optional)
                header("Location: index.php");
                exit;
            } else {
                $_SESSION['Error'] = 'Invalid email or password!';
            }
        }
    }
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

