<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="../styles/editprofile.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>EDIT PROFILE</h1>
        </header>
        <div class="form-control">
            <div class="photo-frame">
                <form action="" method="POST">
                <img src="../assets/jk.jpg" alt="Profile Photo" class="profile-pic" id="profile-photo">
                <input type="file" name="profile-photo" id="upload-photo" accept="image/*" style="display: none;">
                <button type="button" class="update-photo-btn">Update Photo</button>
                </form>
            </div>
            <div class="profile-details">
                <form action="" method="POST">
                    <label>Full Name:</label>
                    <input type="text" name="fullName" id="full-name" required>

                    <label>Username:</label>
                    <input type="text" name="username" id="username" required>

                    <label>Email:</label>
                    <input type="email" name="email" id="email" required>

                    <label>Change Password:</label>
                    <input type="password" name="password" id="password">

                    <label>Confirm Password:</label>
                    <input type="password" name="confirmPassword" id="confirm_password">

                    <div class="button-container">
                        <button type="reset" class="reset-btn">Cancel</button>
                        <button type="submit" class="submit-btn">Save</button>
                    </div>
                </form>
            </div>  
        </div>
    </div>
</body>
</html>
