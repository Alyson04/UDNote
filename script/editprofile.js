document.addEventListener('DOMContentLoaded', function() {
    const updatePhotoBtn = document.querySelector('.update-photo-btn');
    const uploadPhotoInput = document.querySelector('#upload-photo');

    updatePhotoBtn.addEventListener('click', function() {
        uploadPhotoInput.click();
    });
});
