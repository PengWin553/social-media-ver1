<?php
include('connection.php');
session_start();

$user_id = $_SESSION["user_id"];

try {
    $query = "SELECT p.*, CONCAT('../images/', p.image_input) AS picture_url, u.user_id, u.first_name, u.last_name,
                     (SELECT COUNT(*) FROM post_likes WHERE post_id = p.post_id) AS like_count,
                     (SELECT COUNT(*) FROM post_likes WHERE post_id = p.post_id AND user_id = :user_id) AS is_liked
              FROM posts_table p
              LEFT JOIN followers f1 ON p.user_id = f1.followed_id AND f1.follower_id = :user_id
              LEFT JOIN followers f2 ON p.user_id = f2.follower_id AND f2.followed_id = :user_id
              INNER JOIN userInfo_table u ON p.user_id = u.user_id
              WHERE p.user_id = :user_id OR (f1.followed_id IS NOT NULL AND f2.follower_id IS NOT NULL)
              ORDER BY p.post_id DESC";

    $statement = $connection->prepare($query);
    $statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);

    // Add user_id, first_name, and last_name to the data array
    $data = [
        "user_id" => $user_id,
        "result" => $result
    ];

    echo json_encode(["res" => "success", "data" => $data]);
} catch (PDOException $th) {
    echo json_encode(['res' => 'error', 'message' => $th->getMessage()]);
}

?>
