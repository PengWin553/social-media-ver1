<?php
include('connection.php');

session_start();

if (!isset($_SESSION["first_name"])) {
    header("location:../index.php");
}

if (isset($_POST['post_id'])) {
    $post_id = $_POST['post_id'];
    $user_id = $_SESSION['user_id'];

    try {
        // Check if the user has already liked the post
        $checkQuery = $connection->prepare("SELECT * FROM post_likes WHERE post_id = :post_id AND user_id = :user_id");
        $checkQuery->bindParam(':post_id', $post_id);
        $checkQuery->bindParam(':user_id', $user_id);
        $checkQuery->execute();
        
        if ($checkQuery->rowCount() == 0) {
            // User has not liked the post yet, insert a new like
            $stmt = $connection->prepare("INSERT INTO post_likes (post_id, user_id) VALUES (:post_id, :user_id)");
            $stmt->bindParam(':post_id', $post_id);
            $stmt->bindParam(':user_id', $user_id);
            $stmt->execute();
            $response = array("res" => "success", "action" => "liked");
        } else {
            // User has already liked the post, remove the like
            $stmt = $connection->prepare("DELETE FROM post_likes WHERE post_id = :post_id AND user_id = :user_id");
            $stmt->bindParam(':post_id', $post_id);
            $stmt->bindParam(':user_id', $user_id);
            $stmt->execute();
            $response = array("res" => "success", "action" => "unliked");
        }
        
        echo json_encode($response);
    } catch (PDOException $e) {
        $response = array("res" => "error", "message" => $e->getMessage());
        echo json_encode($response);
    }
} else {
    $response = array("res" => "error", "message" => "Invalid data received.");
    echo json_encode($response);
}
?>
