<?php
include('connection.php');

session_start();

if (!isset($_SESSION["first_name"])) {
    header("location:../index.php");
}

$first_name = $_SESSION["first_name"];
$last_name = $_SESSION["last_name"];
$user_id =  $_SESSION["user_id"];

// Function to check if a user is already followed
function is_followed($follower_id, $followed_id, $connection) {
    $sql = "SELECT * FROM followers WHERE follower_id = :follower_id AND followed_id = :followed_id";
    $stmt = $connection->prepare($sql);
    $stmt->execute(['follower_id' => $follower_id, 'followed_id' => $followed_id]);
    return $stmt->rowCount() > 0;
}

// Function to follow or unfollow a user
function follow_unfollow_user($follower_id, $followed_id, $connection) {
    if (is_followed($follower_id, $followed_id, $connection)) {
        // Unfollow
        $sql = "DELETE FROM followers WHERE follower_id = :follower_id AND followed_id = :followed_id";
        $stmt = $connection->prepare($sql);
        $stmt->execute(['follower_id' => $follower_id, 'followed_id' => $followed_id]);
        return false; // Unfollowed
    } else {
        // Follow
        $sql = "INSERT INTO followers (follower_id, followed_id, follow_date) VALUES (:follower_id, :followed_id, NOW())";
        $stmt = $connection->prepare($sql);
        $stmt->execute(['follower_id' => $follower_id, 'followed_id' => $followed_id]);
        return true; // Followed
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facebook</title>
    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="../css/profile-page.css">
    <link rel="stylesheet" href="../css/search-results-page.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .follow-btn{
            padding: 3px 10px;
            margin-right: 1.3em;
            border: none;
            background: white;
        }

        .follow-btn:hover{
            color: grey;
        }

        .result-card1{
            /* background: yellow; */
            display: flex;
            justify-content: space-between;
        }

        .image-container1{
            /* background: orange; */
            margin-left: -7em;
            
        }

        .search-result-card1{
            /* background: pink; */
            margin-left: -1em;
        }
    </style>
</head>

<body>
    <?php include('global-header.php') ?>

    <main>
        <div class="main-result-display-container">
            <div class="result-card-container1">
                <?php
                if (isset($_GET['query'])) {
                    $inpText = $_GET['query'];
                    $sql = 'SELECT user_id, first_name, last_name FROM userInfo_table WHERE first_name LIKE :first_name';
                    $stmt = $connection->prepare($sql);
                    $stmt->execute(['first_name' => '%' . $inpText . '%']);
                    $result = $stmt->fetchAll();

                    if ($result) {
                        foreach ($result as $row) {
                            $followStatus = is_followed($user_id, $row['user_id'], $connection) ? 'Unfollow' : 'Follow';
                            echo '
                                <div class="result-card1" data-userid="' . $row['user_id'] . '" id="result-card1">
                                    <a href="selected-profile-page.php?user_id=' . $row['user_id'] . '">
                                        <div class="image-container1">
                                            <img src="../default_images/default facebook photo.jpg" alt="This is a picture">
                                            <div class="link-container1">
                                                <a href="#" class="search-result-card1">' . $row['first_name'] . ' ' . $row['last_name'] . '</a>
                                            </div>
                                        </div>
                                    </a>
                                
                                    <div class="follow-container1">
                                        <button class="follow-btn" data-follower="' . $user_id . '" data-followed="' . $row['user_id'] . '">' . $followStatus . '</button>
                                    </div>
                                </div>
                            ';
                        }
                    } else {
                        echo '<p class="list-group-item border-1">No Record</p>';
                    }
                }
                ?>
            </div>
        </div>

    </main>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/main.js"></script>
    <script src="../js/searchName.js"></script>
    <script src="../js/frontEnds.js"></script>

    <script>
        // Cloning and showing the search results
        $(document).ready(function () {
            $('#searchResults').on('input', function () {
                var query = $(this).val();
                var resultItems = $('.search-result');
                resultItems.hide().filter(function () {
                    return $(this).text().toLowerCase().indexOf(query.toLowerCase()) !== -1;
                }).show();
            });

            // Follow or Unfollow Button
            $('.follow-btn').click(function () {
                var follower_id = $(this).data('follower');
                var followed_id = $(this).data('followed');
                var button = $(this);
                $.ajax({
                    url: 'follow.php',
                    type: 'post',
                    data: {follower_id: follower_id, followed_id: followed_id},
                    success: function (response) {
                        if (response == 'followed') {
                            button.text('Unfollow');
                        } else if (response == 'unfollowed') {
                            button.text('Follow');
                        }
                    }
                });
            });
        });
    </script>

</body>
</html>
