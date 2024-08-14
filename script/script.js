



// THIS IS FOR NAV
const navBar = document.getElementById("navBar");

function renderNav() {
    navBar.innerHTML = `

     <div class="nav">
            <div class="left-nav">
                <img src="" alt="PROFILE PIC">
            </div>
                 <div class="right-nav">
                 <a href="#"  id="home" class="nav-link active">HOME</a>
                 <a href="#" id="about" class="nav-link">ABOUT</a>
                 <a href="#"  id="blog" class="nav-link">BLOG</a>
                 <a href="#"  id="dev" class="nav-link">DEVELOPERS</a>
                 <a href="../pages/_logout.php"  id="logout" class="nav-link">LOGOUT</a>
             </div>
        </div>
`;

}

renderNav();


