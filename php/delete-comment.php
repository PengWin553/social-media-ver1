<?php
include('connection.php');

session_start();

if (!isset($_SESSION["first_name"])) {
    header("location:../index.php");
}

if (isset($_POST['comment_id'])) {
    $comment_id = $_POST['comment_id'];

    try {
        $stmt = $connection->prepare("SELECT user_id FROM comments WHERE comment_id = :comment_id");
        $stmt->bindParam(':comment_id', $comment_id);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result && $result['user_id'] == $_SESSION['user_id']) {
            $deleteStmt = $connection->prepare("DELETE FROM comments WHERE comment_id = :comment_id");
            $deleteStmt->bindParam(':comment_id', $comment_id);
            $deleteStmt->execute();

            echo json_encode(array("res" => "success"));
        } else {
            echo json_encode(array("res" => "error", "message" => "You do not have permission to delete this comment."));
        }
    } catch (PDOException $e) {
        echo json_encode(array("res" => "error"));
    }
} else {
    echo json_encode(array("res" => "error"));
}
?>
