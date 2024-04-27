const profilePhotoDisplay = document.getElementById("profilePhotoImagePreview");
const profileInput = document.getElementById("profileImageInput");

profileInput.addEventListener("change", () => {
    profilePhotoDisplay.style.display = "block"; 
    profilePhotoDisplay.style.margin = "auto";
    profilePhotoDisplay.src = URL.createObjectURL(profileInput.files[0]);
});
