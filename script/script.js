// THIS IS FOR NAV
const navBar = document.getElementById("navBar");

function renderNav() {
    navBar.innerHTML = `

     <div class="nav">
            <div class="left-nav">
                <img src="" alt="PROFILE PIC">
            </div>
            // <div class="right-nav">
            //     <a href="../index.html"  id="home" class="nav-link active">HOME</a>
            //     <a href="./pages/about_page.html" id="about" class="nav-link">ABOUT</a>
            //     <a href="./pages/blog_page.html"  id="blog" class="nav-link">BLOG</a>
            //     <a href="./pages/dev_page.html"  id="dev" class="nav-link">DEVELOPERS</a>
            // </div>
        </div>
`;

}

renderNav();