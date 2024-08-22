//Toast notification
setTimeout(function() {
    var toast = document.querySelector('.toast-container');
    if (toast) {
        toast.style.display = 'none';
    }
}, 2000); // 3 seconds

// Get the modal
var modal = document.getElementById("changePasswordModal");

// Get the button that opens the modal
var btn = document.getElementById("changePasswordBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
    modal.style.display = "block";
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
    confirmationModal.style.display = "block";
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
