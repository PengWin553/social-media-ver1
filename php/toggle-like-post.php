<?php
include('connection.php');
session_start();

$user_id = $_SESSION["user_id"];
$post_id = $_POST['post_id'];
$is_liked = filter_var($_POST['is_liked'], FILTER_VALIDATE_BOOLEAN);

try {
    // Fetch text_input from posts_table
    $query3 = "SELECT text_input FROM posts_table WHERE post_id = :post_id";
    $statement3 = $connection->prepare($query3);
    $statement3->bindParam(':post_id', $post_id, PDO::PARAM_INT);
    $statement3->execute();
    $result = $statement3->fetch(PDO::FETCH_ASSOC);
    $text_input = $result['text_input'];

    if ($is_liked) {
        // Like the post
        $query = "INSERT INTO post_likes (post_id, user_id) VALUES (:post_id, :user_id)";
        $query2 = "INSERT INTO notifications (post_id, user_id, message) VALUES (:post_id, :user_id, :text_input)";
    } else {
        // Unlike the post
        $query = "DELETE FROM post_likes WHERE post_id = :post_id AND user_id = :user_id";
        $query2 = "DELETE FROM notifications WHERE post_id = :post_id AND user_id = :user_id";
    }

    // Insert to post_likes table or delete from it
    $statement = $connection->prepare($query);
    $statement->bindParam(':post_id', $post_id, PDO::PARAM_INT);
    $statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $statement->execute();

    // Insert to or delete from notifications table based on the like status
    $statement2 = $connection->prepare($query2);
    $statement2->bindParam(':post_id', $post_id, PDO::PARAM_INT);
    $statement2->bindParam(':user_id', $user_id, PDO::PARAM_INT);

    if ($is_liked) {
        // Bind the text_input parameter only when inserting
        $statement2->bindParam(':text_input', $text_input, PDO::PARAM_STR);
    }

    $statement2->execute();

    echo json_encode(["res" => "success", "text_input" => $text_input]);
} catch (PDOException $th) {
    echo json_encode(['res' => 'error', 'message' => $th->getMessage()]);
}
?>
