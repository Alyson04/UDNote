<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../vendor/autoload.php'; // Load PHPMailer
require '../pages/_dbconn.php'; // Your database connection file

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

        // Generate a unique token
        $token = bin2hex(random_bytes(50));
        $expiry = date('Y-m-d H:i:s', strtotime('+1 hour'));

        // Insert the token into the password_resets table
        $query = "INSERT INTO password_resets (user_id, token, expiry) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("iss", $userId, $token, $expiry);
        $stmt->execute();

        // Send the reset link via PHPMailer
        $resetLink = "http://localhost/UDNote/forgotpassword/resetpass.php?token=" . $token;
        
        $mail = new PHPMailer\PHPMailer\PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';  // Your SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'alysoncalimag@gmail.com'; // Your email
        $mail->Password = 'pupq vlim uzcd muho '; // Your email password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('UDNote@gmail.com', 'UDNote');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = 'Password Reset Request';
        $mail->Body    = "Click <a href='$resetLink'>here</a> to reset your password. This link will expire in 1 hour.";

        if ($mail->send()) {
            echo 'A password reset link has been sent to your email.';
            echo $expiry;
        } else {
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }
    } else {
        echo 'No account found with that email address.';
    }
}

