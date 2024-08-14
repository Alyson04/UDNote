//THIS IS FOR TOAST NOTIFICATION
// document.addEventListener("DOMContentLoaded", function() {
//     const toasts = document.querySelectorAll('.toast-container');
//     toasts.forEach(toast => {
//         toast.style.display = 'flex';
//         setTimeout(() => {
//             toast.style.display = 'none';
//         }, 3000); // Hide after 3 seconds
//         window.location.href = "index.php"
//     });
// });
//Toast notification
setTimeout(function() {
    var toast = document.querySelector('.toast-container');
    if (toast) {
        toast.style.display = 'none';
    }
}, 3000); // 3 seconds
//Redirector
document.addEventListener("DOMContentLoaded", function() {
    // Check if the URL contains the redirect query parameter
    const params = new URLSearchParams(window.location.search);
    if (params.has('redirect')) {
        setTimeout(function() {
            window.location.href = 'index.php';
        }, 4000); // Redirect after 5 seconds
    }
});
