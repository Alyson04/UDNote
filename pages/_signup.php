<?php
    include './_dbconn.php';
    
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if (!empty($_POST['fullName']) && !empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['confirmPassword'])) {
                $fullName = $_POST['fullName'];
                $username = $_POST['username'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $confirmPassword = $_POST['confirmPassword'];

                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $_SESSION['error'] = "Invalid email format";
                    header("Location: ./signup.php");
                    exit;
                }
        
                // Check if password and confirmPassword match
                if ($password !== $confirmPassword) {
                    $_SESSION['error'] = "Password does not match";
                    header("Location: ./signup.php");
                    exit;
                }

                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                $stmt = $conn->prepare("INSERT INTO users(fullName, username, email, password) VALUES (?,?,?,?)");
                if ($stmt == false) {
                    die('Prepare failed:' . htmlspecialchars($conn -> error));
                }
                
                $stmt->bind_param("ssss", $fullName, $username, $email, $hashed_password);

                if ($stmt -> execute()) {
                    $_SESSION['success'] = "New record created successfully";
                } else {
                    echo "Error: " . $stmt ->error;
                }

                $stmt->close();
                $conn->close();
            } else {
                $_SESSION['error'] = "All fields are required";
                header("Location: ./signup.php");
                exit;
            }
        }
