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
                <form action="" method="POST">
                    <!-- Input for full name -->
                    <label>Full Name:</label>
                    <input type="text" name="fullName" id="full-name" required>

                    <!-- Input for username -->
                    <label>Username:</label>
                    <input type="text" name="username" id="username" required>

                    <!-- Input for email address -->
                    <label>Email:</label>
                    <input type="email" name="email" id="email" required>

                    <!-- Input for changing password -->
                    <label>Change Password:</label>
                    <input type="password" name="password" id="password">

                    <!-- Input for confirming new password -->
                    <label>Confirm Password:</label>
                    <input type="password" name="confirmPassword" id="confirm_password">

                    <div class="button-container">
                        <!-- Button to cancel changes and navigate to the home page -->
                        <button type="button" class="reset-btn" onclick="goToHomePage()">Cancel</button>
                        <!-- Button to submit form and save changes -->
                        <button type="submit" class="submit-btn">Save</button>
                    </div>
                </form>
            </div>  
        </div>
    </div>

    <!-- Link to external JavaScript file for interactive functionality -->
    <script src="../script/editprofile.js"></script>
</body>
</html>
