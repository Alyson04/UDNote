<?php
session_start();
include './_greet.php';

// Redirect to login if user is not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>U'D NOTE</title>
    <link rel="stylesheet" href="../styles/home.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
</head>
<body>
<header>
    <div class="header-content">
        <div class="header-title">
            <h1>U'D NOTE</h1>
        </div>
        <div class="search-box">
            <div class="icon"><i class="uil uil-search"></i></div>
            <input type="text" id="search" placeholder="Search">
        </div>
        <div class="profile-container">
            <?php if (!empty($profile_picture)): ?>
                <img src="<?php echo htmlspecialchars($profile_picture); ?>?v=<?php echo time(); ?>" alt="Profile Picture" class="profile-pic" width="150px" height="150px">
            <?php else: ?>
                <img src="../assets/profile-icon.jpg" alt="Profile Picture" class="profile-pic" width="150px" height="150px">
            <?php endif; ?>
            <nav class="dropdown-menu" id="dropdown-menu">
                <div class="dropdown-item">
                    <p class="nav-item">Hello, <?php echo htmlspecialchars($username); ?></p>
                </div>
                <div class="dropdown-item">
                    <i class="uil uil-pen"></i>
                    <a href="./editprofile.php" class="nav-item"> Edit Profile</a>
                </div>
                <div class="dropdown-item">
                    <i class="uil uil-signout"></i>
                    <a href="./logout.php" class="nav-item"> Log Out</a>
                </div>  
            </nav>
        </div>  
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
    <div class="popup-box">
        <div class="popup">
            <div class="content">
                <header>
                    <p></p>
                    <i class="uil uil-times"></i>
                </header>
                <form id="noteForm">
                    <div class="row title">
                        <label>Title</label>
                        <input type="text" id="noteTitle" spellcheck="false">
                    </div>
                    <div class="row description">
                        <label>Description</label>
                        <textarea id="noteDesc" spellcheck="false"></textarea>
                    </div>
                    <button type="submit" id="addNoteBtn">Add Note</button>
                </form>
            </div>  
        </div>
    </div>

    <div class="wrapper">
        <li class="add-box">
            <div class="icon"><i class="uil uil-plus"></i></div>
            <p>Add new note</p>
        </li>
    </div>

<script src="../script/home.js"></script>

</body>
</html>
