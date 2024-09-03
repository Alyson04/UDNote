//toast notification
setTimeout(function() {
    var toast = document.querySelector('.toast-container');
    if (toast) {
        toast.style.display = 'none';
    }
}, 3000); // 3 seconds
//redirection
document.addEventListener("DOMContentLoaded", function() {
    // Check if the URL contains the redirect query parameter
    const params = new URLSearchParams(window.location.search);
    if (params.has('redirect')) {
        setTimeout(function() {
            window.location.href = '../index.php';
        }, 4000); // Redirect after 5 seconds
    }
});