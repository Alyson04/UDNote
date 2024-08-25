<?php
require 'vendor/autoload.php'; // Load PHPMailer
require '_dbconn.php'; // Your database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    
    // Check if the email exists in your database
    $query = "SELECT ID FROM users WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Email exists, generate a unique token
        $token = bin2hex(random_bytes(50));
        $resetLink = "http://yourwebsite.com/reset_password.php?token=" . $token;
        
        // Store the token in the database with an expiration time (e.g., 1 hour)
        $expiry = date('Y-m-d H:i:s', strtotime('+1 hour'));
        $query = "INSERT INTO password_resets (email, token, expiry) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sss", $email, $token, $expiry);
        $stmt->execute();
        
        // Send the reset link using PHPMailer
        $mail = new PHPMailer\PHPMailer\PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.example.com'; // Your SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'your_email@example.com'; // Your email
        $mail->Password = 'your_email_password'; // Your email password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('your_email@example.com', 'Your Website Name');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = 'Password Reset Request';
        $mail->Body    = "Click <a href='$resetLink'>here</a> to reset your password. This link will expire in 1 hour.";

        if ($mail->send()) {
            echo 'A password reset link has been sent to your email.';
        } else {
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }
    } else {
        echo 'No account found with that email address.';
    }
}
?>
