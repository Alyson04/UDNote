<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../vendor/autoload.php'; // Load PHPMailer and Dotenv
include '../pages/_dbconn.php'; // Your database connection file
$config = include '../config.php';

// Set timezone
date_default_timezone_set('Asia/Manila');



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];

    // Check if the email exists in the users table
    $query = "SELECT ID FROM users WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $userId = $user['ID'];

        // Generate a unique token and set expiration time
        $token = bin2hex(random_bytes(50));
        $expiry = date('Y-m-d H:i:s', strtotime('+1 hour'));

        // Insert the token into the password_resets table
        $query = "INSERT INTO password_resets (user_id, token, expiry) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("iss", $userId, $token, $expiry);
        $stmt->execute();

        // Prepare the reset link
        $resetLink = "http://localhost/UDNote/forgotpassword/_validatetoken.php?token=" . urlencode($token);

        // Configure PHPMailer
        $mail = new PHPMailer\PHPMailer\PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';  // Your SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'alysoncalimag@gmail.com'; // Your email
        $mail->Password = $config['EMAIL_PASSWORD']; // Your email password from .env
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('UDNote@gmail.com', 'UDNote');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = 'Password Reset Request';
        $mail->Body    = "Click <a href='$resetLink'>here</a> to reset your password. This link will expire in 1 hour.";

        // Send email and handle errors
        if ($mail->send()) {
            $_SESSION['success'] = "A password reset link has been sent to your email.";
            header("Location: forgotpass.php");
            exit;
        } else {
            $_SESSION['error'] = "Mailer Error: " . $mail->ErrorInfo;
            header("Location: forgotpass.php");
            exit;
        }
    } else {
        $_SESSION['error'] = "No account found with that email address.";
        header("Location: forgotpass.php");
        exit;
    }
}

