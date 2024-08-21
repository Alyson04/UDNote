<?php
 session_start();
 include '_editprofile.php';

// if (!isset($_SESSION['user_id'])) {
//     header("Location: login.php");
//     exit;
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Define character encoding and viewport settings for responsive design -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <!-- Link to external CSS stylesheet for styling -->
    <link rel="stylesheet" href="../styles/editprofile.css">
</head>
<body>
    <div class="container">
        <!-- Header section with title -->
        <header>
            <h1>EDIT PROFILE</h1>
        </header>
        <div class="form-control">
            <!-- Section for updating profile photo -->
            <div class="photo-frame">
                <form action="" method="POST">
                    <!-- Display current profile photo -->
                    <img src="../assets/jk.jpg" alt="Profile Photo" class="profile-pic" id="profile-photo">
                    <!-- Hidden file input for selecting new profile photo -->
                    <input type="file" name="profile-photo" id="upload-photo" accept="image/*" style="display: none;">
                    <!-- Button to trigger photo upload -->
                    <button type="button" class="update-photo-btn">Update Photo</button>
                </form>
            </div>
            <!-- Section for editing profile details -->
            <div class="profile-details">
                <form action="_updateprofile.php" method="POST" autocomplete="off">
                    <!-- Input for full name -->
                    <label>Full Name:</label>
                    <input type="text" name="fullName" id="full-name" value="<?php echo $fullname; ?>" required>
                    <!-- Input for username -->
                    <label>Username:</label>
                    <input type="text" name="username" id="username" value="<?php echo $username; ?>" required>
                    <!-- Input for email address -->
                    <label>Email:</label>
                    <input type="email" name="email" id="email" value="<?php echo $email; ?>" required>
                    
                    <div class="button-container1">
                        <button type="button" id="changePasswordBtn">Change Password</button>
                    </div>

                    <div class="button-container">
                        <!-- Button to cancel changes and navigate to the home page -->
                        <button type="button" class="reset-btn" onclick="goToHomePage()">Cancel</button>
                        <!-- Button to submit form and save changes -->
                        <button type="submit" class="submit-btn">Save</button>
                    </div>
                </form>
            </div>  
        </div>
            <!-- Change Password Modal -->
<div id="changePasswordModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Change Password</h2>
        <form action="_changepassword.php" method="post">
            <div>
                <label for="old_password">Old Password:</label>
                <input type="password" id="old_password" name="old_password" required>
            </div>
            <div>
                <label for="new_password">New Password:</label>
                <input type="password" id="new_password" name="new_password" required>
            </div>
            <div>
                <label for="confirm_password">Confirm New Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>
            <div>
                <button type="submit">Change Password</button>
            </div>
        </form>
    </div>
</div>
    </div>
    <!-- Link to external JavaScript file for interactive functionality -->
    <script src="../script/editprofile.js"></script>
</body>
</html>