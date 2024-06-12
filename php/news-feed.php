<?php
include('connection.php');

session_start();

if (!isset($_SESSION["first_name"])) {
    header("location:../index.php");
}

$first_name = $_SESSION["first_name"];
$last_name = $_SESSION["last_name"];
$user_id =  $_SESSION["user_id"];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facebook</title>
    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="../css/profile-page.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        .notification-counter {
            position: relative;
            display: inline-block;
        }
        .notification-counter .count {
            position: absolute;
            top: -15px;
            left: 1em;
            background: red;
            color: white;
            border-radius: 50%;
            padding: 5px 10px;
            display: none; /* Initially hidden */
            font-size: 14px;
        }
        .notification-content {
            display: none; /* Initially hidden */
            background-color: white;
            color: black;
            border: 1px solid #ddd;
            padding: 10px;
            position: absolute;
            right: 15em;
            top: 50px;
            width: 300px;
            z-index: 1000;
            max-height: 400px; /* Optional: Limit height */
            overflow-y: auto; /* Optional: Enable scrolling if content is too large */
        }
    </style>
</head>

<body>
    <?php include('global-header.php') ?>
   
    <main>

        <aside class="left-side-panel">
            <div class="main-div">
                <div class="small-profile-container">
                    <img src="../default_images/default facebook photo.jpg" alt="post profile picture" class="newsfeed-small-profile go-to-profile" id="goToProfile">
                </div>
                <p class="user-name-display"> <?php echo $first_name . ' ' . $last_name ?> </p>
            </div>
        </aside>

        <div class="main-container">

            <!-- ADD POST BUTTON -->
            <div class="btn-create-post-container">
                <div class="main-div">
                    <div class="small-profile-container">
                        <img src="../default_images/default facebook photo.jpg" alt="post profile picture" class="small-profile">
                    </div>
                    <input type="text" class="like-text-box-btn" placeholder="What's on your mind, <?php echo $first_name . ' ' . $last_name ?>? " data-bs-toggle="modal" data-bs-target="#createPostModal" id="btn-create-post">
                </div>

                <div class="sub-div">
                    <div class="option-container option-one"><i class='bx bx-text'><span>Text </span> </i> </div>
                    <div class="option-container option-two"> <i class='bx bx-image-add'> <span>Text with photo </span> </i></div>
                    <div class="option-container option-three"> <i class='bx bx-image-add'> <span>Photo</span> </i> </div>
                </div>
            </div>

            <!-- ADD POST MODAL -->
            <div class="modal fade" id="createPostModal" tabindex="-1" aria-labelledby="createPostModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="createPostForm" enctype="multipart/form-data">
                                <textarea id="text-input" name="text-input" placeholder="What's on your mind?" maxlength="500" class="textarea"></textarea>
                                <input type="file" name="image-input" id="picture" class="form-control" required>
                                <img id="createPostImagePreview" class="img-thumbnail mt-2" alt="Image Preview" style="display: none;">
                            </form>
                        </div>
                        <div class="modal-footer">
                            <!-- tiral -->
                            <button class="send-button" id="btn-submit-post">
                                <div class="svg-wrapper-1">
                                    <div class="svg-wrapper">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                            <path fill="none" d="M0 0h24v24H0z"></path>
                                            <path fill="currentColor" d="M1.946 9.315c-.522-.174-.527-.455.01-.634l19.087-6.362c.529-.176.832.12.684.638l-5.454 19.086c-.15.529-.455.547-.679.045L12 14l6-8-8 6-8.054-2.685z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <span></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- RESULT CONTAINER -->
            <div class="resultcontainer">
                <div id="resultBoxes" class="row">
                    <!-- the posts will be displayed here -->
                </div>
            </div>

            <!-- UPDATE MODAL -->
            <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="updateModalLabel">Update Post</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="updatePostForm" enctype="multipart/form-data">
                                <input type="hidden" id="updatePostId">
                                <div class="mb-3">
                                    <textarea id="updatePostName" maxlength="500" class="textarea"></textarea>
                                </div>
                                <div class="mb-3">
                                    <input type="file" name="image_input" id="updatePicture" class="form-control">
                                    <img id="updateImagePreview" class="img-thumbnail mt-2" alt="Image Preview" style="display: none;">
                                    <img id="currentPicture" class="img-thumbnail mt-2" alt="Current Picture">
                                    <button type="button" class="btn btn-sm btn-danger mt-2" id="removePictureBtn" style="display: none;">Remove Image</button>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="btnUpdatePost">Update</button>
                        </div>
                    </div>
                </div>
            </div>

            <?php include('comments-modal.php') ?>

        </div>
    </main>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="../js/loadNewsFeed.js"></script> 
    <script src="../js/createPost.js"></script>
    <script src="../js/updatePost.js"></script>
    <script src="../js/deletePost.js"></script>
    <script src="../js/comments.js"></script>
    <script src="../js/searchName.js"></script>
    <script src="../js/frontEnds.js"></script>
    <!-- <script src="../js/notifications.js"></script> -->

    <script>
        document.getElementById("goToProfile").addEventListener("click", function() {
            window.location.href = "profile-page.php";
        });
    </script>

    <script type="text/javascript">
        function loadDoc() {
            setInterval(function() {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        var response = JSON.parse(this.responseText);
                        var countElement = document.getElementById("noti_number");
                        var contentElement = document.getElementById("noti_content");

                        if (response.count > 0) {
                            countElement.innerHTML = response.count;
                            countElement.style.display = 'inline-block';
                            contentElement.innerHTML = response.notifications;
                        } else {
                            countElement.style.display = 'none';
                            contentElement.innerHTML = '<p>No new notifications</p>';
                        }
                    }
                };
                xhttp.open("GET", "fetch-notifications.php", true);
                xhttp.send();
            }, 1000);
        }

        document.addEventListener('DOMContentLoaded', (event) => {
            loadDoc();

            let clickCount = 0;

            document.getElementById("noti_icon").onclick = function() {
                clickCount++;
                var contentElement = document.getElementById("noti_content");

                if (clickCount === 1) {
                    contentElement.style.display = "block";
                } else if (clickCount === 2) {
                    contentElement.style.display = "none";
                    clickCount = 0; // Reset click count

                    // Send AJAX request to mark notifications as seen
                    var xhttp = new XMLHttpRequest();
                    xhttp.open("POST", "mark_notifications_seen.php", true);
                    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    xhttp.send();

                    // Hide the notification count after marking as seen
                    var countElement = document.querySelector(".count");
                    countElement.style.display = 'none';
                }
            };
        });

    </script>

</body>

</html>

