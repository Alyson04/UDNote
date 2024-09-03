<?php
 session_start();
 include '_dbconn.php';
 include '_displayprofile.php';

 if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit;
}

 $user_id = $_SESSION['user_id'];
 $query = "SELECT * FROM users WHERE ID = $user_id";
 $result = mysqli_query($conn, $query);
 $user = mysqli_fetch_assoc($result);

// if (!isset($_SESSION['user_id'])) {
//     header("Location: login.php");
//     exit;
// }
// Define the path to a default profile picture
//$default_profile_picture = '../assets/profile-icon.jpg'; // Update this path as needed

// Use the default profile picture if $profile_picture is empty
//$profile_picture_src = !empty($profile_picture) ? htmlspecialchars($profile_picture) : $default_profile_picture;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="../styles/editprofile.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
</head>
<body>
    <div class="container">
        <header>
        <div class="hamburger-container">
            <div class="hamburger-icon"><i class="uil uil-bars"></i></div>
        </div>
        <div class="header-title">
            <h1>EDIT PROFILE</h1>
        </div>
        </header>

        <?php
            if (isset($_SESSION['error'])) {
                echo '
                <div class="toast-container">
                    <p class="error">' . $_SESSION['error'] . '</p>
                </div>';
                unset($_SESSION['error']);
            }

            if (isset($_SESSION['success'])) {
                echo '
                <div class="toast-container">
                    <p class="success">' . $_SESSION['success'] . '</p>
                </div>';

                unset($_SESSION['success']);
            }
        ?>
        
        <!-- Section for updating profile photo -->
        <form action="_updateprofile.php" method="POST" autocomplete="off" id="profile-form" enctype="multipart/form-data">
            <div class="form-control">
                <div class="photo-frame">
                    <?php if (!empty($user['profile_picture'])): ?>
                        <img src="<?php echo htmlspecialchars($user['profile_picture']); ?>?v=<?php echo time(); ?>" alt="Profile Picture" class="profile-pic" width="150" height="150">
                    <?php else: ?>
                        <img src="../assets/profile-icon.jpg" alt="Profile Picture" class="profile-pic" width="150px" height="150px">
                    <?php endif; ?>
                    <i class="uil uil-camera" id="camera-icon"></i>
                    <input type="file" name="profile_picture" id="upload-photo" style="display: none;">
                </div>
            <!-- Section for editing profile details -->
                <div class="profile-details">
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
                        <button type="button" id="changePasswordBtn">CHANGE PASSWORD</button>
                    </div>
                    <div class="button-container">
                        <!-- Button to cancel changes and navigate to the home page -->
                        <button type="button" class="reset-btn" onclick="goToHomePage()">CANCEL</button>
                        <!-- Button to submit form and save changes -->
                        <button type="submit" class="submit-btn">SAVE</button>
                    </div>
                </div>  
            </div>
        </form>
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
                        <button type="submit">UPDATE</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Confirmation Modal -->
        <div id="confirmationModal" class="modal">
            <div class="confirmmodal-content">
                <span class="close-confirmation">&times;</span>
                <h3>Confirm Changes?</h3>
                <div class="confirmation-buttons">
                    <button id="cancelSave" class="cancel-btn" onclick="goToHomePage()">CANCEL</button>
                    <button id="confirmSave" class="confirm-btn">ACCEPT</button>
                </div>
            </div>
        </div>
    </div>
<!--This is for the sidebar that will only appear in 600px max width-->
    <div class="sidebar" id="sidebar">
        <nav class="sidebar-menu">
            <div class="sidebar-item profile">
                <?php if (!empty($user['profile_picture'])): ?>
                    <img src="<?php echo htmlspecialchars($user['profile_picture']); ?>?v=<?php echo time(); ?>" alt="Profile Picture" class="sidebar-profile-pic">
                <?php else: ?>
                    <img src="../assets/profile-icon.jpg" alt="Profile Picture" class="sidebar-profile-pic">
                <?php endif; ?>
                    <p>Hello, <?php echo htmlspecialchars($username); ?></p>
            </div>
            <div class="sidebar-item">
                <i class="uil uil-home"></i>
                <a href="./home.php" class="sidebar-nav-item"> Home</a>
            </div>
            <div class="sidebar-item active">
                <i class="uil uil-pen"></i>
                <a href="./editprofile.php" class="sidebar-nav-item"> Edit Profile</a>
            </div>
            <div class="sidebar-item logout">
                <i class="uil uil-signout"></i>
                <a href="./logout.php" class="sidebar-nav-item"> Log Out</a>
            </div>
        </nav>
    </div>
    <!-- Link to external JavaScript file for interactive functionality -->
    <script src="../script/editprofile.js"></script>
<?php 
$stmt->close();
$conn->close();
?>
</body>
</html>