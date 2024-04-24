// DELETE POST:
$(document).on("click", ".btnDelete", function() {
    var postId = $(this).attr("id");
  
    if (confirm("Are you sure you want to delete this post?")) {
      $.ajax({
        url: "../php/delete-post.php",
        type: "POST",
        data: {
          post_id: postId
        },
        success: function(data) {
          let result = JSON.parse(data);
          if (result.res == "success") {
            location.reload();
          } else {
            alert("Failed to delete post. Please try again later.");
          }
        },
        error: function(xhr, status, error) {
          console.error("An error occurred while deleting post:", error);
          alert("An error occurred while deleting post. Please try again later.");
        }
      });
    }
  });
  