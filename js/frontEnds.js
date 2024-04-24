// LOADS IMAGES ON UPATE MODAL DYNAMICALLY
    document.addEventListener("DOMContentLoaded", function() {
        const currentPicture = document.getElementById("currentPicture");
        const updatePicture = document.getElementById("updatePicture");
        const removePictureBtn = document.getElementById("removePictureBtn");
        const updateImagePreview = document.getElementById("updateImagePreview");

        // Function to load image into modal if present
        function loadImageIntoModal() {
            const currentImageSrc = currentPicture.getAttribute("src");
            if (currentImageSrc) {
                currentPicture.style.display = "block";
                updatePicture.value = ""; // Clear the file input
                currentPicture.src = currentImageSrc;
                removePictureBtn.style.display = "block";
            } else {
                currentPicture.style.display = "none";
                removePictureBtn.style.display = "none";
            }
        }

        // Check if there's an existing image on modal open
        $('#updateModal').on('show.bs.modal', function (event) {
            loadImageIntoModal();
        });

        // Handle image change event
        updatePicture.addEventListener("change", function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    currentPicture.src = e.target.result;
                    removePictureBtn.style.display = "block";

                    // Display image preview
                    updateImagePreview.src = e.target.result;
                    updateImagePreview.style.display = "block";
                };
                reader.readAsDataURL(file);
            }
        });

        // Remove Image Functionality
        removePictureBtn.addEventListener("click", function() {
            currentPicture.src = ""; // Remove the image
            updatePicture.value = ""; // Clear the file input
            currentPicture.style.display = "none"; // Hide the current picture element
            removePictureBtn.style.display = "none"; // Hide the remove button
            updateImagePreview.src = ""; // Remove the image preview
            updateImagePreview.style.display = "none"; // Hide the image preview
        });
    });


// LOADS IMAGES ON CREATE MODAL DYNAMICALLY
document.addEventListener("DOMContentLoaded", function() {
    const createPostPicture = document.getElementById("picture");
    const createPostImagePreview = document.getElementById("createPostImagePreview");

    // Function to load image preview into create post modal
    function loadCreatePostImagePreview() {
        const file = createPostPicture.files[0];
        if (file) {
            createPostImagePreview.src = URL.createObjectURL(file);
            createPostImagePreview.style.display = "block";
        } else {
            createPostImagePreview.style.display = "none";
        }
    }

    // Handle image change event in create post modal
    createPostPicture.addEventListener("change", function() {
        loadCreatePostImagePreview();
    });

    // Load image preview on modal show
    $('#createPostModal').on('show.bs.modal', function (event) {
        loadCreatePostImagePreview();
    });

    // Hide image preview on modal hide
    $('#createPostModal').on('hidden.bs.modal', function (event) {
        createPostImagePreview.style.display = "none";
    });

    // Clear image input and preview when modal is closed
    $('#createPostModal').on('hidden.bs.modal', function (event) {
        createPostPicture.value = "";
        createPostImagePreview.src = "";
    });
});