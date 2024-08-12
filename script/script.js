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
                 <a href="../pages/logout.php"  id="logout" class="nav-link">LOGOUT</a>
             </div>
        </div>
`;

}

renderNav();

//THIS IS FOR TOAST NOTIFICATION
function showToast(message) {
    var toast = document.createElement('div');
    toast.className = 'toast';
    toast.textContent = message;
    var container = document.getElementById('toast-container');
    container.appendChild(toast);
    setTimeout(function() {
        toast.classList.add('show');
    }, 100);
    setTimeout(function() {
        toast.classList.remove('show');
        setTimeout(function() {
            container.removeChild(toast);
        }, 500);
    }, 3000);
}