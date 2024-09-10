<?php
session_start();
include './_greet.php';

// Redirect to login if user is not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit;
}

// Define the path to a default profile picture
$default_profile_picture = '../assets/profile-icon.jpg'; // Update this path as needed

// Use the default profile picture if $profile_picture is empty
$profile_picture_src = !empty($profile_picture) ? htmlspecialchars($profile_picture) : $default_profile_picture;

// Fetch notes from the database
include '../pages/_dbconn.php';
$user_id = $_SESSION['user_id'];
$sql = "SELECT id, title, description, date FROM notes WHERE user_id = $user_id ORDER BY date DESC";
$result = mysqli_query($conn, $sql);
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
        <div class="hamburger-container">
            <div class="hamburger-icon"><i class="uil uil-bars"></i></div>
        </div>
        <div class="header-title">
            <h1 class="nav-item">Hello, <?php echo htmlspecialchars($username); ?></h1>
        </div>
        <div class="search-box">
            <div class="icon"><i class="uil uil-search"></i></div>
            <input type="text" id="search" placeholder="Search">
        </div>
        <div class="profile-container">
            <img src="<?php echo $profile_picture_src; ?>?v=<?php echo time(); ?>" alt="Profile Picture" class="profile-pic" width="150px" height="150px">
            <nav class="dropdown-menu" id="dropdown-menu">
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

<div class="sidebar" id="sidebar">
    <nav class="sidebar-menu">
        <div class="sidebar-item profile">
            <img src="<?php echo $profile_picture_src; ?>" alt="Profile Picture" class="sidebar-profile-pic">
            <p>Hello, <?php echo htmlspecialchars($username); ?></p>
        </div>
        <div class="sidebar-item active">
            <i class="uil uil-home"></i>
            <a href="./home.php" class="sidebar-nav-item"> Home</a>
        </div>
        <div class="sidebar-item">
            <i class="uil uil-pen"></i>
            <a href="./editprofile.php" class="sidebar-nav-item"> Edit Profile</a>
        </div>
        <div class="sidebar-item logout">
            <i class="uil uil-signout"></i>
            <a href="./logout.php" class="sidebar-nav-item"> Log Out</a>
        </div>
    </nav>
</div>

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
            <form id="NoteForm">
                <div class="row title">
                    <label>Title</label>
                    <input type="text" name="title" placeholder="Note Title" id="noteTitle" spellcheck="false" required>
                </div>
                <div class="row description">
                    <label>Description</label>
                    <textarea name="description" id="noteDesc" spellcheck="false" maxlength="1000" placeholder="Note Description" required></textarea>
                    <!-- Hidden input field for storing the note ID -->
                    <input type="hidden" id="updateNoteIdField">
                </div>
                <button type="submit" id="updateNoteBtn">Add Note</button>
            </form>
        </div>  
    </div>
</div>

<div class="wrapper">
    <li class="add-box">
        <div class="icon"><i class="uil uil-plus"></i></div>
        <p>Add new note</p>
    </li>
    <?php while ($row = mysqli_fetch_assoc($result)): 
        // Encode the ID normally since it's a number
        $noteId = htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8');
        // Use json_encode to safely escape title and description for JavaScript
        $noteTitle = json_encode($row['title'], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
        $noteDescription = json_encode($row['description'], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
    ?>
        <li class='note' data-id="<?php echo $noteId; ?>">
            <div class='details'>
                <p><?php echo htmlspecialchars($row['title'], ENT_QUOTES); ?></p>
                <span><?php echo nl2br(htmlspecialchars($row['description'], ENT_QUOTES)); ?></span>
            </div>
            
            <div class="bottom-content">
                <p>Last Updated: <?php echo htmlspecialchars($row['date'], ENT_QUOTES); ?></p>
                <div class="settings">
                    <i onclick="showMenu(this, event)" class="uil uil-ellipsis-h"></i>
                    <ul class="menu">
                        <!-- Pass the title and description using json_encode to ensure valid JS strings -->
                        <li onclick='editNote(event, <?php echo $noteId; ?>, <?php echo $noteTitle; ?>, <?php echo $noteDescription; ?>)'>
                            <i class="uil uil-pen"></i>Edit
                        </li>
                        <li onclick="deleteNote(<?php echo $noteId; ?>); event.stopPropagation();">
                            <i class="uil uil-trash"></i>Delete
                        </li>
                    </ul>
                </div>
            </div>
        </li>
    <?php endwhile; ?>
</div>



<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <p>Are you sure you want to delete this note?</p>
        <div class="buttons">
            <button id="confirmDelete" class="btn">Yes</button>
            <button id="cancelDelete" class="btn">No</button>
        </div>
    </div>
</div>

<script src="../script/home.js"></script>

</body>
</html>
