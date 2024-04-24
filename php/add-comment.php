<?php
include('connection.php');

session_start();

if (!isset($_SESSION["first_name"])) {
    header("location:../index.php");
}

if (isset($_POST['post_id']) && isset($_POST['comment'])) {
    $post_id = $_POST['post_id'];
    $comment = $_POST['comment'];
    $user_id = $_SESSION['user_id'];

    try {
        $stmt = $connection->prepare("INSERT INTO comments (post_id, user_id, comment) VALUES (:post_id, :user_id, :comment)");
        $stmt->bindParam(':post_id', $post_id);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':comment', $comment);
        $stmt->execute();

        $response = array("res" => "success");
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
