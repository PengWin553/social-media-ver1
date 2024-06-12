<?php
include('connection.php');
session_start();

$user_id = $_SESSION["user_id"];

try {
    // Fetch unseen notifications related to the posts created by the session user
    $sql = "SELECT n.post_id, n.user_id, n.message, n.seen_status, u.first_name, u.last_name 
            FROM notifications n
            JOIN userinfo_table u ON n.user_id = u.user_id
            JOIN posts_table p ON n.post_id = p.post_id
            WHERE n.seen_status = 0 AND p.user_id = :user_id ORDER BY n.post_id DESC";
    
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    
    $response = array();
    $response['count'] = $stmt->rowCount();

    if ($stmt->rowCount() > 0) {
        $notifications = "";
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $user_name = $row['first_name'] . " " . $row['last_name'];
            $message = $row['message'];
            $notifications .= "<p>{$user_name} liked your post \"{$message}\"</p>";
        }
        $response['notifications'] = $notifications;
    } else {
        $response['notifications'] = "<p>No new notifications</p>";
    }

    echo json_encode($response);

} catch (PDOException $e) {
    echo json_encode(['res' => 'error', 'message' => $e->getMessage()]);
}
?>
