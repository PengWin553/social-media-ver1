<?php
include('connection.php');

session_start();

if (!isset($_SESSION["first_name"])) {
    header("location:../index.php");
}

if (isset($_POST['comment_id']) && isset($_POST['comment_text'])) {
    $comment_id = $_POST['comment_id'];
    $comment_text = $_POST['comment_text'];

    try {
        $stmt = $connection->prepare("SELECT user_id FROM comments WHERE comment_id = :comment_id");
        $stmt->bindParam(':comment_id', $comment_id);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result && $result['user_id'] == $_SESSION['user_id']) {
            $updateStmt = $connection->prepare("UPDATE comments SET comment = :comment_text WHERE comment_id = :comment_id");
            $updateStmt->bindParam(':comment_text', $comment_text);
            $updateStmt->bindParam(':comment_id', $comment_id);
            $updateStmt->execute();

            echo json_encode(array("res" => "success"));
        } else {
            echo json_encode(array("res" => "error", "message" => "You do not have permission to update this comment."));
        }
    } catch (PDOException $e) {
        echo json_encode(array("res" => "error"));
    }
} else {
    echo json_encode(array("res" => "error"));
}
?>
