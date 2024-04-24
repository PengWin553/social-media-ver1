<?php
include('connection.php');

session_start();

if (!isset($_SESSION["first_name"])) {
    header("location:../index.php");
}

$first_name = $_SESSION["first_name"];
$last_name = $_SESSION["last_name"];
$user_id =  $_SESSION["user_id"];

// Check if the request is POST and if the required data is provided
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["follower_id"]) && isset($_POST["followed_id"])) {
    $follower_id = $_POST["follower_id"];
    $followed_id = $_POST["followed_id"];

    // Check if the user is already following the other user
    $sql = "SELECT * FROM followers WHERE follower_id = :follower_id AND followed_id = :followed_id";
    $stmt = $connection->prepare($sql);
    $stmt->execute(['follower_id' => $follower_id, 'followed_id' => $followed_id]);

    if ($stmt->rowCount() > 0) {
        // If already following, then unfollow
        $sql = "DELETE FROM followers WHERE follower_id = :follower_id AND followed_id = :followed_id";
        $stmt = $connection->prepare($sql);
        $stmt->execute(['follower_id' => $follower_id, 'followed_id' => $followed_id]);
        echo 'unfollowed';
    } else {
        // If not following, then follow
        $sql = "INSERT INTO followers (follower_id, followed_id) VALUES (:follower_id, :followed_id)";
        $stmt = $connection->prepare($sql);
        $stmt->execute(['follower_id' => $follower_id, 'followed_id' => $followed_id]);
        echo 'followed';
    }
}
?>
