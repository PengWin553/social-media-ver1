<?php
include('connection.php');

session_start();

if (!isset($_SESSION["first_name"])) {
    header("location:../index.php");
}

if (isset($_POST['post_id'])) {
    $post_id = $_POST['post_id'];

    try {
        $stmt = $connection->prepare("SELECT comments.comment_id, comments.comment, userInfo_table.first_name, userInfo_table.last_name FROM comments INNER JOIN userInfo_table ON comments.user_id = userInfo_table.user_id WHERE comments.post_id = :post_id");
        $stmt->bindParam(':post_id', $post_id);
        $stmt->execute();

        $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($comments) > 0) {
            foreach ($comments as $comment) {
                echo '
                <div class="comment-card">
                    <div class="comments-icon-container">
                        <i class="bx bx-edit-alt comment-icon icon-update" data-comment-id="' . $comment['comment_id'] . '"></i>
                        <i class="bx bx-trash comment-icon icon-delete" data-comment-id="' . $comment['comment_id'] . '"></i>
                    </div>

                    <img src="../default_images/default facebook photo.jpg" class="default-image" alt="Profile Picture">
                    <p class="post-user-name p-tags comment-username">' . $comment['first_name'] . ' ' . $comment['last_name'] . '</p>
                    <p class="post-comment p-tags">' . $comment['comment'] . '</p>
                </div>';
            }
        } else {
            echo '<p>No comments yet.</p>';
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Invalid data received.";
}
?>
