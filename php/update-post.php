<?php
include('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $postId = $_POST['updatePostId'] ?? null;
    $textInput = $_POST['updatePostName'] ?? null;

    if ($postId !== null && $textInput !== null) {
        if (isset($_FILES['updatePicture']) && $_FILES['updatePicture']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = '../images/';
            $tempFilePath = $_FILES['updatePicture']['tmp_name'];
            $fileName = uniqid() . '_' . $_FILES['updatePicture']['name'];
            $targetFilePath = $uploadDir . $fileName;

            if (move_uploaded_file($tempFilePath, $targetFilePath)) {
                try {
                    $query = "UPDATE posts_table SET text_input = :text_input, image_input = :image_input WHERE post_id = :post_id";
                    $statement = $connection->prepare($query);
                    $statement->bindParam(':text_input', $textInput);
                    $statement->bindParam(':image_input', $fileName);
                    $statement->bindParam(':post_id', $postId);
                    $statement->execute();
                    echo json_encode(["res" => "success"]);
                } catch (PDOException $th) {
                    echo json_encode(['res' => 'error', 'message' => $th->getMessage()]);
                }
            } else {
                echo json_encode(['res' => 'error', 'message' => 'Failed to move uploaded file.']);
            }
        } else {
            try {
                $query = "UPDATE posts_table SET text_input = :text_input WHERE post_id = :post_id";
                $statement = $connection->prepare($query);
                $statement->bindParam(':text_input', $textInput);
                $statement->bindParam(':post_id', $postId);
                $statement->execute();
                echo json_encode(["res" => "success"]);
            } catch (PDOException $th) {
                echo json_encode(['res' => 'error', 'message' => $th->getMessage()]);
            }
        }
    } else {
        echo json_encode(['res' => 'error', 'message' => 'Missing required parameters']);
    }
} else {
    echo json_encode(['res' => 'error', 'message' => 'Invalid request method']);
}
?>
