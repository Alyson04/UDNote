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

    // Constants
    const months = ["January", "February", "March", "April", "May", "June", "July",
                     "August", "September", "October", "November", "December"];
    let notes = JSON.parse(localStorage.getItem("notes") || "[]");
    let isUpdate = false, updateId;

    // Function to show notes
    function showNotes(query = "") {
        // Remove existing notes
        document.querySelectorAll(".note").forEach(li => li.remove());
        // Filter notes based on the query
        const filteredNotes = notes.filter(note =>
            note.title.toLowerCase().includes(query.toLowerCase()) ||
            note.description.toLowerCase().includes(query.toLowerCase())
        );

        // Add filtered notes to the DOM
        filteredNotes.forEach((note, id) => {
            let filterDesc = note.description.replaceAll("\n", '<br/>');
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
                                        <li onclick="updateNote(${id}, '${note.title}', '${filterDesc}')"><i class="uil uil-pen"></i>Edit</li>
                                        <li onclick="deleteNote(${id})"><i class="uil uil-trash"></i>Delete</li>
                                    </ul>
                                </div>
                            </div>
                        </li>`;
            addBox.insertAdjacentHTML("afterend", liTag);
        });
    }

    // Initial call to display notes
    showNotes();

    // Add note event
    addBox.addEventListener("click", () => {
        popupTitle.innerText = "Add a new Note";
        addBtn.innerText = "Add Note";
        popupBox.classList.add("show");
        document.body.style.overflow = "hidden";
        if (window.innerWidth > 660) titleTag.focus();
    });

    // Close popup event
    closeIcon.addEventListener("click", () => {
        isUpdate = false;
        titleTag.value = descTag.value = "";
        popupBox.classList.remove("show");
        document.body.style.overflow = "auto";
    });

    // Add or update note event
    addBtn.addEventListener("click", e => {
        e.preventDefault();
        let title = titleTag.value.trim(),
            description = descTag.value.trim();

        if (title || description) {
            let currentDate = new Date(),
                month = months[currentDate.getMonth()],
                day = currentDate.getDate(),
                year = currentDate.getFullYear();

            let noteInfo = { title, description, date: `${month} ${day}, ${year}` };
            if (!isUpdate) {
                notes.push(noteInfo);
            } else {
                isUpdate = false;
                notes[updateId] = noteInfo;
            }
            localStorage.setItem("notes", JSON.stringify(notes));
            showNotes(searchBox.value); // Refresh notes with the current search query
            closeIcon.click();
        }
    });

    // Toggle dropdown menu
    if (profilePic) {
        profilePic.addEventListener('click', toggleDropdown);
    }

    function toggleDropdown() {
        if (dropdownMenu) {
            console.log('Dropdown toggled'); // Check if this is logged
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
                document.removeEventListener("click", handler); // Clean up event listener
            }
        });
    };

    window.deleteNote = function(noteId) {
        if (confirm("Are you sure you want to delete this note?")) {
            notes.splice(noteId, 1);
            localStorage.setItem("notes", JSON.stringify(notes));
            showNotes(searchBox.value); // Refresh notes with the current search query
        }
    };

    window.updateNote = function(noteId, title, filterDesc) {
        let description = filterDesc.replaceAll('<br/>', '\r\n');
        updateId = noteId;
        isUpdate = true;
        addBox.click();
        titleTag.value = title;
        descTag.value = description;
        popupTitle.innerText = "Update a Note";
        addBtn.innerText = "Update Note";
    };

    // Search functionality
    searchBox.addEventListener("input", function() {
        showNotes(searchBox.value);
    });
});
