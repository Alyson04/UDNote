document.addEventListener('DOMContentLoaded', function() {
    const addBox = document.querySelector(".add-box"),
          popupBox = document.querySelector(".popup-box"),
          popupTitle = popupBox.querySelector("header p"),
          closeIcon = popupBox.querySelector("header i"),
          titleTag = popupBox.querySelector("#noteTitle"),
          descTag = popupBox.querySelector("#noteDesc"),
          updateNoteBtn = popupBox.querySelector("#updateNoteBtn"),
          updateNoteIdField = popupBox.querySelector("#updateNoteIdField"),
          profilePic = document.querySelector('.profile-pic'),
          dropdownMenu = document.getElementById('dropdown-menu'),
          hamburgerIcon = document.querySelector('.hamburger-icon'),
          sidebar = document.getElementById('sidebar'),
          modal = document.getElementById('deleteModal'),
          confirmDeleteButton = document.getElementById('confirmDelete'),
          cancelDeleteButton = document.getElementById('cancelDelete'),
          closeButton = document.querySelector('.modal .close');

    // Function to handle form submission for adding or updating notes
    function handleNoteSubmission(event) {
        event.preventDefault(); // Prevent default form submission

        const noteId = updateNoteIdField.value;
        const title = titleTag.value;
        const description = descTag.value;

        const url = noteId ? '../notes/updatenotes.php' : '../notes/addnotes.php';

        const xhr = new XMLHttpRequest();
        xhr.open("POST", url, true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    location.reload(); // Reload the page to reflect changes
                } else {
                    showToast("Error: " + xhr.statusText, 'error');
                }
            }
        };

        const data = `note_id=${encodeURIComponent(noteId)}&title=${encodeURIComponent(title)}&description=${encodeURIComponent(description)}`;
        console.log('Data to be sent:', data); // Debugging
        xhr.send(data);
    }

    // Show or hide toast notifications
    setTimeout(function() {
        var toast = document.querySelector('.toast-container');
        if (toast) {
            toast.style.display = 'none';
        }
    }, 3000); // Toasts disappear after 3 seconds

    // Define the editNote function
    function editNote(event, noteId, title, description) {
        // Open the popup box for updating a note
        event.stopPropagation();
        openPopupBox('update', noteId, title, description);
        updateNoteBtn.style.display = "block";
    }

    function openPopupBox(action, noteId = null, title = '', description = '') {
        if (action === 'add' || action === 'update') {
            titleTag.removeAttribute('readonly');
            descTag.removeAttribute('readonly');
            titleTag.value = title || '';
            descTag.value = description || '';
            console.log(description);
            updateNoteIdField.value = noteId || '';
            updateNoteBtn.style.display = "block"; // Ensure button is visible
            if (action === 'add') {
                popupTitle.innerText = "Add a new Note";
                updateNoteBtn.innerText = "Add Note";
            } else {
                popupTitle.innerText = "Update Note";
                updateNoteBtn.innerText = "Update Note";
            }
        } else if (action === 'view') {
            titleTag.removeAttribute('readonly', true);
            descTag.removeAttribute('readonly', true);
            popupTitle.innerText = "View Note";
            titleTag.value = title;

            // Replace <br> tags with newline characters for the description
            
            descTag.value = description;
            

            updateNoteBtn.style.display = "none"; // Hide button in view mode
        }
        popupBox.classList.add("show");
        document.body.style.overflow = "hidden";
        if (window.innerWidth > 660) titleTag.focus();
    }    

    // Attach function to window object
    window.openPopupBox = openPopupBox;

    // Attach the editNote function to the global object
    window.editNote = editNote;

    // Add note event
    addBox.addEventListener("click", () => {
        console.log('Add note button clicked.');
        popupTitle.innerText = "Add a new Note";
        popupBox.classList.add("show");
        updateNoteBtn.innerText = "Add Note";
        document.body.style.overflow = "hidden";
        if (window.innerWidth > 660) titleTag.focus();
    });

    // Close popup event
    closeIcon.addEventListener("click", () => {
        console.log('Popup closed.');
        titleTag.value = descTag.value = "";
        popupBox.classList.remove("show");
        document.body.style.overflow = "auto";
    });

    // Attach the form submission handler
    updateNoteBtn.addEventListener("click", handleNoteSubmission);

    // Define the toggleDropdown function
    function toggleDropdown() {
        console.log('Profile picture clicked.');
        if (dropdownMenu) {
            dropdownMenu.classList.toggle('show');
        }
    }

    // Toggle dropdown menu
    if (profilePic) {
        profilePic.addEventListener('click', toggleDropdown);
    }

    // Close dropdown menu if clicking outside
    window.addEventListener('click', (event) => {
        if (dropdownMenu && profilePic && !profilePic.contains(event.target) && !dropdownMenu.contains(event.target)) {
            console.log('Clicked outside dropdown menu.');
            dropdownMenu.classList.remove('show');
        }
    });

    // Function to close the sidebar with sliding effect
    function closeSidebar() {
        sidebar.classList.add('closing');
        document.body.style.overflow = 'auto';
        setTimeout(() => {
            sidebar.classList.remove('show', 'closing');
        }, 500); // Match this duration with the CSS transition duration
    }

    // Toggle sidebar visibility when hamburger menu is clicked
    hamburgerIcon.addEventListener('click', () => {
        console.log('Hamburger icon clicked.');
        if (sidebar.classList.contains('show')) {
            closeSidebar();
        } else {
            sidebar.classList.add('show');
            document.body.style.overflow = 'hidden';
        }
    });

    // Close sidebar if clicking outside
    window.addEventListener('click', (event) => {
        if (sidebar && !sidebar.contains(event.target) && !hamburgerIcon.contains(event.target) && sidebar.classList.contains('show')) {
            console.log('Clicked outside sidebar.');
            closeSidebar();
        }
    });

    // Make the showMenu, deleteNote, and updateNote functions globally accessible
    window.showMenu = function(elem, event) {
        if (event) {
            event.stopPropagation(); // Prevent click event from bubbling up
        }
        console.log('Show menu for element:', elem);
        elem.parentElement.classList.add("show");

        // Close the menu if clicking outside
        const menu = elem.parentElement;
        const handler = function(e) {
            // Check if the click was inside the menu or the ellipsis icon
            if (!menu.contains(e.target)) {
                menu.classList.remove("show");
                document.removeEventListener("click", handler);
            }
        };
        document.addEventListener("click", handler);
    };

    // Function to open delete modal
    let noteIdToDelete = null;
    window.deleteNote = function(noteId) {
        noteIdToDelete = noteId;
        modal.style.display = 'flex';
    };

    confirmDeleteButton.onclick = function() {
        if (noteIdToDelete !== null) {
            // Create and send a POST request to delete the note
            const xhr = new XMLHttpRequest();
            xhr.open('POST', '../notes/deletenotes.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    // Reload the page to reflect changes
                    window.location.reload();
                } else {
                    console.error('Failed to delete note.');
                }
            };
            xhr.send('note_id=' + encodeURIComponent(noteIdToDelete));
        }
        modal.style.display = 'none';
    };

    cancelDeleteButton.onclick = function() {
        modal.style.display = 'none';
    };

    closeButton.onclick = function() {
        modal.style.display = 'none';
    };

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    };

    document.querySelectorAll('.note').forEach(note => {
        console.log('Attaching event listener to note:', note);
        note.addEventListener("click", () => {
            console.log('Note clicked:', note);
            const noteId = note.getAttribute('data-id');
            const noteTitle = note.querySelector('p').innerText;
            let noteDescription = note.querySelector('span').innerHTML;
            
            // Convert <br> tags to newlines for viewing mode
            noteDescription = noteDescription.replace(/<br\s*\/?>/gi, '');
    
            openPopupBox('view', noteId, noteTitle, noteDescription);
        });
    });
    
});
