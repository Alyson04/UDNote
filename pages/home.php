<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <!-- Character encoding for the document -->
    <meta charset="utf-8">
    <!-- Title of the webpage -->
    <title>U'D NOTE</title>
    <!-- Link to the external stylesheet for page styles -->
    <link rel="stylesheet" href="../styles/home.css">
    <!-- Viewport settings for responsive design -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Link to external icon library for icons -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
</head>
<body>
<header>
    <!-- Header section containing title, search box, and profile container -->
    <div class="header-content">
        <!-- Title section -->
        <div class="header-title">
            <h1>U'D NOTE</h1>
        </div>
        <!-- Search box section -->
        <div class="search-box">
            <div class="icon"><i class="uil uil-search"></i></div>
            <input type="text" id="search" placeholder="Search">
        </div>
        <!-- Profile container with dropdown menu -->
        <div class="profile-container">
            <!-- Profile picture with click event to toggle dropdown -->
            <img src="../assets/jk.jpg" alt="Profile Picture" class="profile-pic" onclick="toggleDropdown()">
            <nav class="dropdown-menu" id="dropdown-menu">
                <!-- Links for dropdown menu items -->
                <div class="icon"><i class="uil uil-pen"></i>
                <a href="#edit-profile" class="nav-item">Edit Profile</a>
                </i></div>
                <div class="icon"><i class="uil uil-signout">
                <a href="#logout" class="nav-item">Log Out</a>
                </i></div>
            </nav>
        </div>  
    </div>
</header>

<!-- Popup box for creating/editing notes -->
<div class="popup-box">
    <div class="popup">
        <div class="content">
            <header>
                <!-- Popup title and close icon -->
                <p></p>
                <i class="uil uil-times"></i>
            </header>
            <form action="#">
                <!-- Form for note creation/editing -->
                <div class="row title">
                    <label>Title</label>
                    <input type="text" spellcheck="false">
                </div>
                <div class="row description">
                    <label>Description</label>
                    <textarea spellcheck="false"></textarea>
                </div>
                <button></button>
            </form>
        </div>  
    </div>
</div>

<!-- Wrapper for note items -->
<div class="wrapper">
    <!-- Box for adding new notes -->
    <li class="add-box">
        <div class="icon"><i class="uil uil-plus"></i></div>
        <p>Add new note</p>
    </li>
</div>

<!-- Link to external JavaScript f  ile for interactive functionality -->
<script src="../script/home.js"></script>

</body>
</html>
