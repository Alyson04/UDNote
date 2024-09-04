document.addEventListener('DOMContentLoaded', function() {
    const addBox = document.querySelector(".add-box"),
          popupBox = document.querySelector(".popup-box"),
          popupTitle = popupBox.querySelector("header p"),
          closeIcon = popupBox.querySelector("header i"),
          titleTag = popupBox.querySelector("#noteTitle"),
          descTag = popupBox.querySelector("#noteDesc"),
          addBtn = popupBox.querySelector("#addNoteBtn"),
          searchBox = document.querySelector("#search"),
          profilePic = document.querySelector('.profile-pic'),
          dropdownMenu = document.getElementById('dropdown-menu'),
          hamburgerIcon = document.querySelector('.hamburger-icon'),
          sidebar = document.getElementById('sidebar'),
          modal = document.getElementById('deleteModal'),
          confirmDeleteButton = document.getElementById('confirmDelete'),
          cancelDeleteButton = document.getElementById('cancelDelete'),
          closeButton = document.querySelector('.modal .close');

    // Function to show notes
    function showNotes(query = "") {
        console.log('Showing notes with query:', query);
        document.querySelectorAll(".note").forEach(li => li.remove());
    
        fetch(`../notes/getnotes.php?query=${query}`, {
            method: 'GET'
        })
        .then(response => response.json())
        .then(notes => {
            console.log('Fetched notes:', notes);
            notes.forEach(note => {
                // Replace \n with <br/> in the description
                let filterDesc = note.description.replace(/\\n/g, '<br/>');
                
                // Use template literals and escape necessary characters
                let liTag = `
                    <li class="note">
                        <div class="details">
                            <p>${note.title}</p>
                            <span>${filterDesc}</span>
                        </div>
                        <div class="bottom-content">
                            <p>Last Updated: ${note.date}</p>
                            <div class="settings">
                                <i onclick="showMenu(this)" class="uil uil-ellipsis-h"></i>
                                <ul class="menu">
                                    <li onclick="updateNote(${note.id}, \`${note.title.replace(/'/g, "\\'")}\`, \`${filterDesc.replace(/'/g, "\\'")}\`)"><i class="uil uil-pen"></i>Edit</li>
                                    <li onclick="deleteNote(${note.id})"><i class="uil uil-trash"></i>Delete</li>
                                </ul>
                            </div>
                        </div>
                    </li>`;
                
                document.querySelector(".wrapper").insertAdjacentHTML("beforeend", liTag);
            });
        })
        .catch(error => {
            console.error('Error fetching notes:', error);
            logError(error); // Log error details if needed
        });
    }
    

    //Toast notification
setTimeout(function() {
    var toast = document.querySelector('.toast-container');
    if (toast) {
        toast.style.display = 'none';
    }
}, 2000); // 3 seconds

    // Initial call to display notes
    showNotes();

    // Add note event
    addBox.addEventListener("click", () => {
        console.log('Add note button clicked.');
        popupTitle.innerText = "Add a new Note";
        addBtn.innerText = "Add Note";
        popupBox.classList.add("show");
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

    // Add or update note event
    const noteForm = document.querySelector("#noteForm");
    noteForm.addEventListener("submit", (e) => {
        e.preventDefault();

        let title = titleTag.value.trim();
        let description = descTag.value.trim();
        let noteId = noteForm.getAttribute('data-id'); // Get note ID from data attribute

        console.log('Form submitted. Title:', title, 'Description:', description, 'Note ID:', noteId);

        if (title || description) {
            let requestBody = {
                note: {
                    title: title,
                    description: description
                }
            };

            if (noteId) {
                // Update existing note
                requestBody.note.id = noteId;
                fetch('../notes/updatenotes.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(requestBody)
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Update response:', data);
                    if (data.message) {
                        showNotes(searchBox.value); // Refresh notes
                        closeIcon.click(); // Close the popup
                        noteForm.removeAttribute('data-id'); // Clear ID attribute
                    }
                })
                .catch(error => {
                    console.error('Error updating note:', error);
                    logError(error); // Log error details if needed
                });
            } else {
                // Add new note
                fetch('../notes/addnotes.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(requestBody)
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Add response:', data);
                    if (data.message) {
                        showNotes(searchBox.value); // Refresh notes
                        closeIcon.click(); // Close the popup
                    }
                })
                .catch(error => {
                    console.error('Error adding note:', error);
                    logError(error); // Log error details if needed
                });
            }
        }
    });

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

    // Make the `showMenu`, `deleteNote`, and `updateNote` functions globally accessible
    window.showMenu = function(elem) {
        console.log('Show menu for element:', elem);
        elem.parentElement.classList.add("show");
        document.addEventListener("click", function handler(e) {
            if (e.target.tagName !== "I" || e.target !== elem) {
                elem.parentElement.classList.remove("show");
                document.removeEventListener("click", handler);
            }
        });
    };

    window.deleteNote = function(noteId) {
        modal.style.display = 'flex';

        closeButton.onclick = function() {
            modal.style.display = 'none';
        };

        cancelDeleteButton.onclick = function() {
            modal.style.display = 'none';
        };

        // Handle confirm delete button click
    confirmDeleteButton.onclick = function() {
        console.log('Delete note with ID:', noteId);
        fetch('../notes/deletenotes.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: new URLSearchParams({
                note_id: noteId
            })
        })
        .then(response => response.json())
        .then(data => {
            console.log('Delete response:', data);
            if (data.message) {
                showNotes(searchBox.value); // Refresh notes
            }
            modal.style.display = 'none'; // Hide modal after deletion
        })
        .catch(error => {
            console.error('Error deleting note:', error);
            logError(error); // Log error details if needed
            modal.style.display = 'none'; // Hide modal on error
        });
    };

    // Hide the modal if the user clicks outside of it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    };
        
    };

    window.updateNote = function(noteId, title, filterDesc) {
        console.log('Update note with ID:', noteId, 'Title:', title, 'Description:', filterDesc);
        let description = filterDesc.replace(/<br\/>/g, '\n');
        titleTag.value = title;
        descTag.value = description;
        popupTitle.innerText = "Update a Note";
        addBtn.innerText = "Update Note";
        popupBox.classList.add("show");
        document.body.style.overflow = "hidden";

        // Set note ID on form
        noteForm.setAttribute('data-id', noteId);
    };

    // Search functionality
    searchBox.addEventListener("input", function() {
        console.log('Search input changed:', searchBox.value);
        showNotes(searchBox.value);
    });
});

