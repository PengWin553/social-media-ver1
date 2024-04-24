<?php 
include ('connection.php');

if (isset($_POST['post_id'])) {
    $postId = $_POST['post_id'];
    try {
        $query = "DELETE FROM posts_table WHERE post_id = :post_id";
        $statement = $connection->prepare($query);
        $statement->bindParam(':post_id', $postId);
        $statement->execute();

        echo json_encode(["res" => "success"]);
    } catch (PDOException $th) {
        echo json_encode(['res' => 'error', 'message' => $th->getMessage()]);
    }
} else {
    echo json_encode(['res' => 'error', 'message' => 'Post ID not provided.']);
}
?>
