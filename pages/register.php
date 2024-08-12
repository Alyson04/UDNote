<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);


$host = 'localhost';
//$dbname = 'udnote';
$dbname = 'UDNOTE';
$username = 'root'; // default MySQL user for XAMPP
$password = ''; // leave empty by default

$conn = mysqli_connect($host, $dbname, $username, $password);

if (!$conn) {
    echo "Unsuccess";
}



// try {
//     $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
//     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//         $firstName = $_POST['firstName'];
//         $lastName = $_POST['lastName'];
//         $email = $_POST['email'];
//         $pass = password_hash($_POST['password'], PASSWORD_BCRYPT);
        

//         $stmt = $conn->prepare("INSERT INTO users (firstName, lastName, email, password) VALUES (:firstName, :lastName, :email, :password)");
//         $stmt->bindParam(':firstName', $firstName);
//         $stmt->bindParam(':lastName', $lastName);
//         $stmt->bindParam(':email', $email);
//         $stmt->bindParam(':password', $pass);
//         $stmt->execute();

//         echo "<script type='text/javascript'>
//         alert('Signup successful! You will be redirected to the login page.');
//         window.location.href = 'login.php';
//     </script>";
//     exit();
//     }
// } catch(PDOException $e) {
//     echo "Error: " . $e->getMessage();
// }
?>
