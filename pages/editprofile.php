<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <!-- Link to external stylesheet for custom styles -->
    <link rel="stylesheet" href="../styles/editprofile.css">
    <!-- Link to external icon library -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
</head>
<body>
    <div class="container">
        <header>
            <!-- Link to home page -->
            <a href="./home.php">
                <div class="icon">
                    <!-- Home icon from the icon library -->
                    <i class="uil uil-home"></i>
                </div>
            </a>
            <div class="title-container">
                <!-- Page title -->
                <h1>EDIT PROFILE</h1>
            </div>
        </header>

        <!-- Form for editing profile -->
        <form action="" method="post" enctype="multipart/form-data">
            <div class="photo-frame">
                <!-- Profile photo display -->
                <img src="../assets/jk.jpg" alt="Profile Photo" class="profile-pic" id="profile-photo">
                <!-- File input for uploading new profile photo -->
                <input type="file" name="profile-photo" id="upload-photo" accept="image/*">
                <!-- Label for photo update -->
                <div>Update Photo</div>
            </div>
            <div class="profile-details">
                <!-- Full name input -->
                <label for="full_name">Full Name:</label>
                <input type="text" name="full_name" id="full_name" required>

                <!-- Username input -->
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" required>

                <!-- Email input -->
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required>

                <!-- Password change input -->
                <label for="password">Change Password:</label>
                <input type="password" name="password" id="password">

                <!-- Confirm password input -->
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" name="confirm_password" id="confirm_password">

                <!-- Button container with Cancel and Save buttons -->
                <div class="button-container">
                    <button type="reset" class="reset-btn">Cancel</button>
                    <button type="submit" class="submit-btn">Save</button>
                </div>
            </div>
        </form>
    </div>
    <!-- Link to external JavaScript file -->
    <script src="script.js.1"></script>
</body>
</html>
