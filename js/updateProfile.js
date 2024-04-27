// Function to update profile picture
$("#btn-submit-profile").click(function() {
    var profilePicture = $("#profileImageInput")[0].files[0]; // Get the selected image file

    // Create a FormData object to send data to the server
    var formData = new FormData();
    formData.append('profilePicture', profilePicture); // Use 'profilePicture' as key
  
    // Make an AJAX request to update the profile picture
    $.ajax({
        url: "../php/update-profile-picture.php", // Adjust the path to your PHP script
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
    }).done(function(data) {
        var result = JSON.parse(data);
        if (result.res === "success") {
            location.reload();
        } else {
            alert("Error updating profile picture. Please try again.");
        }
    }).fail(function(xhr, status, error) {
        console.error("An error occurred while updating profile picture:", error);
        alert("An error occurred while updating profile picture. Please try again later.");
    });
});
