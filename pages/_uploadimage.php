<?php
session_start();
include '_dbconn.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['profile_picture']['tmp_name'];
        $fileName = $_FILES['profile_picture']['name'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        // Define allowed file extensions
        $allowedExts = array('jpg', 'jpeg', 'png', 'gif');
        
        // Check if the file extension is allowed
        if (in_array($fileExtension, $allowedExts)) {
            // Directory where the file will be uploaded
            $uploadFileDir = '../uploads/';
            $newFileName = "profile_{$user_id}.$fileExtension";
            $dest_path = $uploadFileDir . $newFileName;

            // Check if there’s an existing profile picture and delete it
            $query = "SELECT profile_picture FROM users WHERE ID = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();

            if ($user['profile_picture'] && file_exists($user['profile_picture'])) {
                unlink($user['profile_picture']); // Delete the old file
            }

            // Move the new file to the uploads directory
            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                // Update the user's profile picture in the database
                $query = "UPDATE users SET profile_picture = ? WHERE ID = ?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("si", $dest_path, $user_id);

                if ($stmt->execute()) {
                    echo "Profile picture updated successfully.";
                    header("Location: home.php");
                    exit;
                } else {
                    echo "Error updating profile picture: " . $stmt->error;
                }
            } else {
                echo "Error moving the file.";
            }
        } else {
            echo "Invalid file type.";
        }
    } else {
        echo "No file uploaded or upload error.";
    }
} else {
    echo "Invalid request.";
}

$stmt->close();
$conn->close();
?>
