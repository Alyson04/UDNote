//THIS IS FOR TOAST NOTIFICATION
document.addEventListener("DOMContentLoaded", function() {
    const toasts = document.querySelectorAll('.toast');
    toasts.forEach(toast => {
        toast.style.display = 'block';
        setTimeout(() => {
            toast.style.display = 'none';
        }, 3000); // Hide after 3 seconds
    });
});