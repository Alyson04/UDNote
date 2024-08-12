<?php
$host = 'localhost';
//$dbname = 'udnote';
$dbname = 'UDNOTE';
$username = 'root';
$password = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'];
        $pass = $_POST['password'];

        $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($pass, $user['password'])) {
            echo "Login successful! Welcome, " . $user['firstName'], " ", $user['lastName'];
        } else {
            echo "Invalid email or password!";
        }
    }
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
