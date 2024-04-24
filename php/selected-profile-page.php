<?php
include('connection.php');

session_start();

if (!isset($_SESSION["first_name"])) {
    header("location:../index.php");
}

$first_name = $_SESSION["first_name"];
$last_name = $_SESSION["last_name"];
$user_id =  $_SESSION["user_id"];

$selected_user_id = $_GET['user_id'];

$sql = 'SELECT first_name, last_name FROM userInfo_table WHERE user_id = :selected_user_id';
$stmt = $connection->prepare($sql);
$stmt->execute(['selected_user_id' => $selected_user_id]);
$result = $stmt->fetch(PDO::FETCH_ASSOC);

$selected_first_name = $result['first_name'];
$selected_last_name = $result['last_name'];

// Check if the user and the selected user follow each other ------------------------------>

// check first_condition ----------->
$sql = 'SELECT COUNT(*) AS count FROM followers WHERE (follower_id = :user_id AND followed_id = :selected_user_id)';
$stmt = $connection->prepare($sql);
$stmt->execute(['user_id' => $user_id, 'selected_user_id' => $selected_user_id]);
$count = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
// echo ($count);

// check second_condition -------------->
$sql2 = 'SELECT COUNT(*) AS count2 FROM followers WHERE (follower_id = :selected_user_id AND followed_id = :user_id)';
$stmt2 = $connection->prepare($sql2);
$stmt2->execute(['selected_user_id' => $selected_user_id, 'user_id' => $user_id]);
$count2 = $stmt2->fetch(PDO::FETCH_ASSOC)['count2'];
// echo ($count2);

// store the count result inside a variable; both must be 1+1 = 2 for the if statement to be true and show the posts;
$count_result = $count + $count2;
// echo ($count_result);





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
</head>

<body>
   <?php include('global-header.php') ?>

    <main>
        <div class="main-profile-display-container">
            <div class="display-picture-container">
                <!-- <span>Hello</span> -->
            </div>

            <div class="left-side-sub-info-container">
                <div class="profile-picture-container">
                        <!-- put your picture inside here -->
                        <img src="../default_images/default facebook photo.jpg" alt="profile picture" class="big-profile">
                </div>
                <input type="hidden" value="<?php echo $selected_user_id ?>" id="selectedUserId">
                <p class="user-name"> <?php echo $selected_first_name . ' ' . $selected_last_name ?> </p>
            </div>
        </div>

        <div class="main-container">

            <!-- RESULT CONTAINER -->
            <div class="resultcontainer">
                <div id="resultBoxes" class="row">
                  <!-- the posts will be displayed here -->
                </div>
            </div>

            <!-- COMMENTS MODAL -->
             <div class="modal fade" id="commentsModal" tabindex="-1" aria-labelledby="CommentsModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="CommentsModalLabel">Comments</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" id="commentBody">
                            
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" id="commentsPostId">
                            <textarea id="writeAComment" maxlength="500" class="textarea write-a-comment-textarea"></textarea>
                            <!-- <button type="button" class="btn btn-primary" id="btn-submit-comment"> -->
                            <i class='bx bxs-up-arrow-alt' id="btn-submit-comment"></i>
                            <!-- </button> -->
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/comments.js"></script>
    <script src="../js/searchName.js"></script>
    <script src="../js/frontEnds.js"></script>

    <script>
        var selected_user_id = "<?php echo $selected_user_id; ?>";
        var selected_first_name = "<?php echo $selected_first_name; ?>";
        var selected_last_name = "<?php echo $selected_last_name; ?>";

        function loadData() {
            // alert(selected_user_id);
            $.ajax({
                url: "selected-user-posts.php",
                method: "POST",
                data: {
                    user_id: selected_user_id,
                    first_name: selected_first_name,
                    last_name: selected_last_name,
                }
            }).done(function(data) {
                try {
                    let result = JSON.parse(data);
                    if (result.res === "success") {
                        let resultBoxes = $("#resultBoxes");
                        let userData = result.data; // Store user data object
                        let fullName = userData.first_name + " " + userData.last_name;
                        userData.result.forEach(item => { // Iterate over result array
                            let resultBox = `
                                <div class="resultBox">
                                    <div class=".card-columns">
                                        <div class="card">
                                            <div class="parent-container">
                                                <div class="post-profile-container">
                                                    <img src="../default_images/default facebook photo.jpg" class="default-image card-img-top" alt="Profile Picture" style="margin-left: 2.7em; margin-top: -0.8em; width: 40px;">
                                                    <p class="post-user-name">${fullName}</p>
                                                    <p class="post-user-id">${userData.user_id}</p>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <p class="card-text">${item.text_input}</p>
                                                ${item.picture_url ?
                                                    `
                                                    <div class="image-container">
                                                        <img src="${item.picture_url}" class="post-image card-img-top" alt="Post Image">
                                                    </div>
                                                    `
                                                    : ''}

                                                    <div class="bottom-options-container">
                                                        <div class="like-button"><i class='bx bxs-like'></i> <span>Like</span> </div>
                                                        <div class="comment-button open-comments-modal" id="${item.post_id}"><i class='bx bxs-comment'></i> <span>Comment</span> </div>
                                                        <div class="share-button"><i class='bx bxs-share'></i><span> </span>Share</div>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>`;
                            resultBoxes.append(resultBox);
                        });
                    } else {
                        alert("Failed to load product data.");
                    }
                } catch (error) {
                    console.error("Error parsing JSON:", error);
                    // alert("An unexpected error occurred. Please try again later.");
                }
            }).fail(function(xhr, status, error) {
                console.error("An error occurred while fetching product data:", error);
                // alert("An error occurred while fetching product data. Please try again later.");
            });
        }

        if (<?php echo $count_result; ?> == 2) {
            loadData();
        } else {
            // Handle case where users don't follow each other
            $('#resultBoxes').html("<p style='text-align:center;'>You are not following each other.</p>");
        }
    </script>
        
</body>

</html>
