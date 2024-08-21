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
          dropdownMenu = document.getElementById('dropdown-menu');

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
                let filterDesc = note.description.replace(/\n/g, '<br/>');
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
                document.querySelector(".wrapper").insertAdjacentHTML("beforeend", liTag);
            });
        })
        .catch(error => {
            console.error('Error fetching notes:', error);
            logError(error); // Log error details if needed
        });
    }

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
        if (confirm("Are you sure you want to delete this note?")) {
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
            })
            .catch(error => {
                console.error('Error deleting note:', error);
                logError(error); // Log error details if needed
            });
        }
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
