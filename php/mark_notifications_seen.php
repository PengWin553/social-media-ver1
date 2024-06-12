<?php
include('connection.php');
session_start();

$user_id = $_SESSION["user_id"];

try {
    // Update seen_status to 1 for all unseen notifications related to the posts created by the session user
    $sql = "UPDATE notifications n
            JOIN posts_table p ON n.post_id = p.post_id
            SET n.seen_status = 1
            WHERE n.seen_status = 0 AND p.user_id = :user_id";
    
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();

    echo json_encode(['res' => 'success']);
} catch (PDOException $e) {
    echo json_encode(['res' => 'error', 'message' => $e->getMessage()]);
}
?>
