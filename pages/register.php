<?php
$host = 'localhost';
$dbname = 'udnote';
// $dbname = 'UDNOTE';
$username = 'root'; // default MySQL user for XAMPP
$password = ''; // leave empty by default

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $email = $_POST['email'];
        $pass = password_hash($_POST['password'], PASSWORD_BCRYPT);
        

        $stmt = $conn->prepare("INSERT INTO users (firstName, lastName, email, password) VALUES (:firstName, :lastName, :email, :password)");
        $stmt->bindParam(':firstName', $firstName);
        $stmt->bindParam(':lastName', $lastName);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $pass);
        $stmt->execute();

        
        echo "Registration successful!";
    }
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
