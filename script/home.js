document.addEventListener('DOMContentLoaded', function() {
    // Element selections
    const addBox = document.querySelector(".add-box"),
          popupBox = document.querySelector(".popup-box"),
          popupTitle = popupBox.querySelector("header p"),
          closeIcon = popupBox.querySelector("header i"),
          titleTag = popupBox.querySelector("input"),
          descTag = popupBox.querySelector("textarea"),
          addBtn = popupBox.querySelector("button"),
          searchBox = document.querySelector("#search"),
          profilePic = document.querySelector('.profile-pic'),
          dropdownMenu = document.getElementById('dropdown-menu');

    // CSRF token (assuming it's included in the HTML meta tags for security)
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Function to show notes with optional search query
    function showNotes(query = "") {
        // Remove all existing notes
        document.querySelectorAll(".note").forEach(li => li.remove());

        // Fetch notes from the server with an optional search query
        fetch(`getNotes.php?query=${query}`, {
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        })
        .then(response => response.json())
        .then(notes => {
            notes.forEach(note => {
                // Format description to handle line breaks
                let filterDesc = note.description.replace(/\n/g, '<br/>');
                // Create HTML for each note
                let liTag = `<li class="note">
                                <div class="details">
                                    <p>${note.title}</p>
                                    <span>${filterDesc}</span>
                                </div>
                                <div class="bottom-content">
                                    <span>${note.date}</span>
                                    <div class="settings">
                                        <i onclick="showMenu(this)" class="uil uil-ellipsis-h"></i>
                                        <ul class="menu">
                                            <li onclick="updateNote(${note.id}, '${note.title}', '${filterDesc}')"><i class="uil uil-pen"></i>Edit</li>
                                            <li onclick="deleteNote(${note.id})"><i class="uil uil-trash"></i>Delete</li>
                                        </ul>
                                    </div>
                                </div>
                            </li>`;
                // Insert the note into the DOM
                document.querySelector(".wrapper").insertAdjacentHTML("beforeend", liTag);
            });
        })
        .catch(error => console.error('Error fetching notes:', error));
    }

    // Initial call to display notes
    showNotes();

    // Add note event
    addBox.addEventListener("click", () => {
        // Prepare the popup for adding a new note
        popupTitle.innerText = "Add a new Note";
        addBtn.innerText = "Add Note";
        popupBox.classList.add("show");
        document.body.style.overflow = "hidden";
        if (window.innerWidth > 660) titleTag.focus();
        // Reset the form fields
        titleTag.value = "";
        descTag.value = "";
        addBtn.dataset.action = 'add'; // Set action to add
    });

    // Close popup event
    closeIcon.addEventListener("click", () => {
        popupBox.classList.remove("show");
        document.body.style.overflow = "auto";
    });

    // Add or update note event
    addBtn.addEventListener("click", (e) => {
        e.preventDefault();
        let title = titleTag.value.trim(),
            description = descTag.value.trim();

        // Proceed if there is a title or description
        if (title || description) {
            let action = addBtn.dataset.action;
            let url = action === 'update' ? 'updateNote.php' : 'addNote.php';
            let requestBody = {
                note: {
                    title: title,
                    description: description
                }
            };

            if (action === 'update') {
                requestBody.note.id = addBtn.dataset.noteId; // Add ID for update
            }

            // Send request to add or update the note
            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify(requestBody)
            })
            .then(response => response.json())
            .then(data => {
                if (data.message) {
                    showNotes(searchBox.value); // Refresh notes list
                    closeIcon.click(); // Close the popup
                }
            })
            .catch(error => console.error('Error processing note:', error));
        }
    });

    // Toggle dropdown menu
    if (profilePic) {
        profilePic.addEventListener('click', toggleDropdown);
    }

    // Function to toggle dropdown visibility
    function toggleDropdown() {
        if (dropdownMenu) {
            dropdownMenu.classList.toggle('show');
        }
    }

    // Close dropdown menu if clicking outside
    window.addEventListener('click', (event) => {
        if (dropdownMenu && profilePic && !profilePic.contains(event.target) && !dropdownMenu.contains(event.target)) {
            dropdownMenu.classList.remove('show');
        }
    });

    // Make the `showMenu`, `deleteNote`, and `updateNote` functions globally accessible
    window.showMenu = function(elem) {
        elem.parentElement.classList.add("show");
        document.addEventListener("click", function handler(e) {
            if (e.target.tagName !== "I" || e.target !== elem) {
                elem.parentElement.classList.remove("show");
                document.removeEventListener("click", handler);
            }
        });
    };

    // Function to delete a note
    window.deleteNote = function(noteId) {
        if (confirm("Are you sure you want to delete this note?")) {
            fetch('deleteNote.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: new URLSearchParams({
                    note_id: noteId
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.message) {
                    showNotes(searchBox.value); // Refresh notes list
                }
            })
            .catch(error => console.error('Error deleting note:', error));
        }
    };

    // Function to open popup for updating a note
    window.updateNote = function(noteId, title, filterDesc) {
        let description = filterDesc.replace(/<br\/>/g, '\n');
        titleTag.value = title;
        descTag.value = description;
        popupTitle.innerText = "Update a Note";
        addBtn.innerText = "Update Note";
        addBtn.dataset.action = 'update'; // Set action to update
        addBtn.dataset.noteId = noteId; // Set the note ID for update
        popupBox.classList.add("show");
        document.body.style.overflow = "hidden";
    };

    // Search functionality
    searchBox.addEventListener("input", function() {
        showNotes(searchBox.value); // Refresh notes list based on search query
    });
});
