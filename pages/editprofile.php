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
    <div style="text-align:center"><h1>EDIT PROFILE</h1></div>
    <form action=" " method="post" enctype="multipart/form-data">
            <div class="profile-section">
                <div class="photo-frame">
                    <img src="../assets/jk.jpg" alt="Profile Photo" id="profile-photo">
                    <input type="file" name="profile-photo"
                    id="upload-photo" accept="image/*">
                    <div style ='font:21px/21px Goblin One; color:#000000'>Update Photo</div>
                    
</div>
<div class="profile-details">
    <label for="full_name">Full Name:</label>
    <input type="text" name="full_name" id="full name" required>

    <label for="username">Username:</label>
    <input type="text" name="username" id="username" required>

    <label for="email">Email:</label>
    <input type="email" name="name" id="name" required>

    <label for="password">Change Password:</label>

    <label for="password" id="password">

    <input type="password" name="password" id="password">

    <label for="confirm_password">Confirm Password:</label>
    <input type="password" name="confirm_password" id="confirm_password">


    <div class="button-container">
  <button type="reset" class="reset-btn">Cancel</button>
  <button type="submit" class="submit=btn">Save</button>
</div>


               </div>
          </div>
    </form>
</div>
<script src="script.js.1"></script>


    
</body>
</html>


