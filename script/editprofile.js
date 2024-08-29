//Toast notification
setTimeout(function() {
    var toast = document.querySelector('.toast-container');
    if (toast) {
        toast.style.display = 'none';
    }
}, 2000); // 3 seconds

// Variables for the hamburger icon and sidebar
var hamburgerIcon = document.querySelector('.hamburger-icon');
var sidebar = document.getElementById('sidebar');

// Function to close the sidebar with a sliding effect
function closeSidebar() {
    sidebar.classList.add('closing');
    document.body.style.overflow = 'auto';
    setTimeout(function () {
        sidebar.classList.remove('show', 'closing');
    }, 500); // Match this duration with the CSS transition duration
}

// Toggle sidebar visibility when the hamburger menu is clicked
if (hamburgerIcon) {
    hamburgerIcon.addEventListener('click', function () {
        console.log('Hamburger icon clicked.');
        if (sidebar.classList.contains('show')) {
            closeSidebar();
        } else {
            sidebar.classList.add('show');
            document.body.style.overflow = 'hidden';
        }
    });
}

// Close sidebar if clicking outside
window.addEventListener('click', function (event) {
    if (sidebar && !sidebar.contains(event.target) && !hamburgerIcon.contains(event.target) && sidebar.classList.contains('show')) {
        console.log('Clicked outside sidebar.');
        closeSidebar();
    }
});


// Get the modal
var modal = document.getElementById("changePasswordModal");

// Get the button that opens the modal
var btn = document.getElementById("changePasswordBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
    modal.style.display = "flex";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

// Get the confirmation modal
var confirmationModal = document.getElementById("confirmationModal");

// Get the save button for profile info
var saveButton = document.querySelector(".submit-btn");

// Get the confirm and cancel buttons in the confirmation modal
var confirmSave = document.getElementById("confirmSave");
var cancelSave = document.getElementById("cancelSave");

// Get the form for profile information
var profileForm = document.getElementById("profile-form");

// Get the close button for the confirmation modal
var closeConfirmation = document.getElementsByClassName("close-confirmation")[0];

// When the user clicks the save button, open the confirmation modal
saveButton.onclick = function(event) {
    event.preventDefault(); // Prevent form submission
    confirmationModal.style.display = "flex";
}

// When the user clicks confirm, submit the profile form
confirmSave.onclick = function() {
    profileForm.submit(); // Submit the form
}

// When the user clicks cancel or close, close the confirmation modal
cancelSave.onclick = closeConfirmation.onclick = function() {
    confirmationModal.style.display = "none";
}

// Close modal if user clicks outside of it
window.onclick = function(event) {
    if (event.target == confirmationModal) {
        confirmationModal.style.display = "none";
    }
}

function goToHomePage() {
            window.location.href = '../pages/home.php'; 
        }

document.getElementById('camera-icon').addEventListener('click', function () {
    document.getElementById('upload-photo').click();
});        

document.getElementById('upload-photo').addEventListener('change', function (event) {
    const reader = new FileReader();
    reader.onload = function () {
        document.querySelector('.profile-pic').src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
});

