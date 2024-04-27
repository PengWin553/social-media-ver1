<?php
include('connection.php');
session_start();
$user_id = $_SESSION["user_id"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_SESSION['user_id'] ?? null;
    if ($userId !== null) {
        if (isset($_FILES['profilePicture']) && $_FILES['profilePicture']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = '../images/';
            $tempFilePath = $_FILES['profilePicture']['tmp_name'];
            $fileName = uniqid() . '_' . $_FILES['profilePicture']['name'];
            $targetFilePath = $uploadDir . $fileName;

            if (move_uploaded_file($tempFilePath, $targetFilePath)) {
                try {
                    $query = "UPDATE userInfo_table SET profile_picture = :profile_picture WHERE user_id = :user_id";
                    $statement = $connection->prepare($query);
                    $statement->bindParam(':profile_picture', $fileName);
                    $statement->bindParam(':user_id', $userId);
                    $statement->execute();
                    echo json_encode(["res" => "success"]);
                } catch (PDOException $th) {
                    echo json_encode(['res' => 'error', 'message' => $th->getMessage()]);
                }
            } else {
                echo json_encode(['res' => 'error', 'message' => 'Failed to move uploaded file.']);
            }
        } else {
            echo json_encode(['res' => 'error', 'message' => 'No file uploaded or error uploading file.']);
        }
    } else {
        echo json_encode(['res' => 'error', 'message' => 'User not logged in.']);
    }
} else {
    echo json_encode(['res' => 'error', 'message' => 'Invalid request method']);
}
?>
