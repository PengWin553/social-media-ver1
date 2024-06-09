<?php
include('connection.php');
session_start();

$user_id = $_SESSION["user_id"];
$post_id = $_POST['post_id'];
$is_liked = filter_var($_POST['is_liked'], FILTER_VALIDATE_BOOLEAN);

try {
    if ($is_liked) {
        // Like the post
        $query = "INSERT INTO post_likes (post_id, user_id) VALUES (:post_id, :user_id)";
    } else {
        // Unlike the post
        $query = "DELETE FROM post_likes WHERE post_id = :post_id AND user_id = :user_id";
    }

    $statement = $connection->prepare($query);
    $statement->bindParam(':post_id', $post_id, PDO::PARAM_INT);
    $statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $statement->execute();

    echo json_encode(["res" => "success"]);
} catch (PDOException $th) {
    echo json_encode(['res' => 'error', 'message' => $th->getMessage()]);
}
?>
