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

setTimeout(function() {
    var toast = document.querySelector('.toast-container');
    if (toast) {
        toast.style.display = 'none';
    }
}, 3000); // 3 seconds
