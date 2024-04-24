$(document).ready(function() {
    // Function to load comments
    function loadComments(postId) {
        $.ajax({
            url: "../php/load-comments.php",
            type: "POST",
            data: {
                post_id: postId
            },
            success: function(data) {
                $("#commentBody").html(data);
            },
            error: function(xhr, status, error) {
                console.error("An error occurred while loading comments:", error);
                alert("An error occurred while loading comments. Please try again later.");
            }
        });
    }

    // Function to add comment
    $("#btn-submit-comment").click(function() {
        console.log("the correct button is pressed to add comment");
        var postId = $("#commentsPostId").val();
        // var postId = $(this).attr("id");
        var comment = $("#writeAComment").val();
        if (comment.trim().length > 0) {
            $.ajax({
                url: "../php/add-comment.php",
                type: "POST",
                data: {
                    post_id: postId,
                    comment: comment
                },
                success: function(data) {
                    let result = JSON.parse(data);
                    if (result.res == "success") {
                        $("#writeAComment").val('');
                        loadComments(postId);
                    } else {
                        alert("Failed to add comment. Please try again later.");
                    }
                },
                error: function(xhr, status, error) {
                    console.error("An error occurred while adding comment:", error);
                    alert("An error occurred while adding comment. Please try again later.");
                }
            });
        } else {
            alert("Please enter a comment.");
        }
    });

    // Open comments modal and load data inside it
    $(document).on("click", ".open-comments-modal", function() {
        var postId = $(this).attr("id");
        $("#commentsPostId").val(postId);
        
        loadComments(postId);
        $("#commentsModal").modal("show");
    });
    
    // Update and delete comment functions
    $(document).on("click", ".icon-update", function() {
        var commentId = $(this).data("comment-id");
        var commentText = $(this).parent().siblings(".post-comment").text().trim();
        var commentHTML = '<input type="text" class="form-control" id="updateCommentText" style="width: 100%;" value="' + commentText + '">';
        $(this).parent().siblings(".post-comment").html(commentHTML);
        $(this).removeClass("icon-update").addClass("icon-confirm").css("color", "green");
    });

    $(document).on("click", ".icon-confirm", function() {
        var commentId = $(this).data("comment-id");
        var commentText = $(this).parent().siblings(".post-comment").children("#updateCommentText").val().trim();
        var postId = $("#commentsPostId").val();

        $.ajax({
            url: "../php/update-comment.php",
            type: "POST",
            data: {
                comment_id: commentId,
                comment_text: commentText
            },
            success: function(data) {
                let result = JSON.parse(data);
                if (result.res == "success") {
                    loadComments(postId);
                } else {
                    alert("Failed to update comment. Please try again later.");
                }
            },
            error: function(xhr, status, error) {
                console.error("An error occurred while updating comment:", error);
                alert("An error occurred while updating comment. Please try again later.");
            }
        });

        $(this).removeClass("icon-confirm").addClass("icon-update").css("color", "black");
    });

    $(document).on("click", ".icon-delete", function() {
        var commentId = $(this).data("comment-id");
        var postId = $("#commentsPostId").val();

        if (confirm("Are you sure you want to delete this comment?")) {
            $.ajax({
                url: "../php/delete-comment.php",
                type: "POST",
                data: {
                    comment_id: commentId
                },
                success: function(data) {
                    let result = JSON.parse(data);
                    if (result.res == "success") {
                        loadComments(postId);
                    } else {
                        alert("Failed to delete comment. Please try again later.");
                    }
                },
                error: function(xhr, status, error) {
                    console.error("An error occurred while deleting comment:", error);
                    alert("An error occurred while deleting comment. Please try again later.");
                }
            });
        }
    });
});
