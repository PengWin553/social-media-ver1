// LOAD SELECTED POST DATA INTO THE UPDATE POST MODAL
$(document).on("click", ".btnUpdate", function() {

    var PostId = $(this).attr("id");
    var PostName = $(this).attr("name");
    var currentPictureUrl = $(this).closest(".card").find(".post-image").attr("src");
  
    // Set values in the update modal
    // $("#updatePostId").val(PostId);
  
    $("#updatePostId").val(PostId); // Ensure this matches the key used in PHP
    $("#updatePostName").val(PostName);
  
    // Check if there's a picture URL
    if (currentPictureUrl) {
      $("#currentPicture").attr("src", currentPictureUrl);
    } else {
      // If no picture URL, hide the image element
      $("#currentPicture").hide();
    }
  
    $("#updateModal").modal("show");
  });
  
  
  // ig pislit nimo sa btnUpdate sud sa Update Modal
  $("#btnUpdatePost").click(function() {
     // Retrieve updated data from the modal
     var postId = $("#updatePostId").val();
     var postName = $("#updatePostName").val();
     var picture = $("#updatePicture")[0].files[0]; // Get the selected image file
  
     // Create a FormData object to send data to the server
     var formData = new FormData();
     formData.append('updatePostId', postId);
     formData.append('updatePostName', postName);
     formData.append('updatePicture', picture); // Use 'image_input' instead of 'picture'
  
     // Check if post name is not empty
     if (postName.length > 0 || picture !== undefined) {
         // Make an AJAX request to update the post
         $.ajax({
             url: "../php/update-post.php", // Adjust the path to your PHP script
             type: "POST",
             data: formData,
             contentType: false,
             processData: false,
         }).done(function(data) {
             var result = JSON.parse(data);
             if (result.res === "success") {
                 // Reload the page or update the UI as needed
                 location.reload();
             } else {
                 alert("Error updating post. Please try again.");
             }
         }).fail(function(xhr, status, error) {
             console.error("An error occurred while updating post:", error);
             alert("An error occurred while updating post. Please try again later.");
         });
     } else {
         alert("Post name cannot be empty.");
     }
  });