<?php


session_start();
include '_dbconn.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Process profile picture upload
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['profile_picture']['tmp_name'];
        $fileName = $_FILES['profile_picture']['name'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        $allowedExts = array('jpg', 'jpeg', 'png', 'gif');
        
        if (in_array($fileExtension, $allowedExts)) {
            $uploadFileDir = '../uploads/';
            $newFileName = "profile_{$user_id}.$fileExtension";
            $dest_path = $uploadFileDir . $newFileName;

            $query = "SELECT profile_picture FROM users WHERE ID = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();

            if ($user['profile_picture'] && file_exists($user['profile_picture'])) {
                unlink($user['profile_picture']);
            }

            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                $query = "UPDATE users SET profile_picture = ? WHERE ID = ?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("si", $dest_path, $user_id);

                if (!$stmt->execute()) {
                    $_SESSION['error'] = "Error updating profile picture: " . $stmt->error;
                    header("Location: editprofile.php");
                    exit;
                }
            } else {
                $_SESSION['error'] = "Error moving the file";
                header("Location: editprofile.php");
                exit;
            }
        } else {
            $_SESSION['error'] = "Invalid file type";
            header("Location: editprofile.php");
            exit;
        }
    }

    // Process profile details update
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $fullname = htmlspecialchars($_POST['fullName']);

    if (empty($username) || empty($email) || empty($fullname)) {
        $_SESSION['error'] = "Fields cannot be empty";
    } else {
        $query = "UPDATE users SET username = ?, email = ?, fullName = ? WHERE ID = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssi", $username, $email, $fullname, $user_id);
        
        if ($stmt->execute()) {
            $_SESSION['success'] = "Profile updated successfully!";
        } else {
            $_SESSION['error'] = "Error updating profile: " . $stmt->error;
        }
    }

    // Redirect back to profile page
    header("Location: editprofile.php");
    exit();
}
