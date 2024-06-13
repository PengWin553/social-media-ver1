<?php
include('connection.php');

session_start();
$user_id = $_SESSION["user_id"];

if (!isset($_SESSION["first_name"])) {
  header("location:../index.php");
  exit(); // Ensure script stops execution after redirection
}

$text_input = isset($_POST['text-input']) ? $_POST['text-input'] : null; // Check if text input is set
$image_inputs = [];

// Loop upload the imagess
if (isset($_FILES['image-input']) && !empty($_FILES['image-input']['name'][0])) {
    $uploadDir = '../images/';
    foreach ($_FILES['image-input']['tmp_name'] as $index => $tempFilePath) {
        if ($_FILES['image-input']['error'][$index] === UPLOAD_ERR_OK) {
            $fileName = uniqid() . '_' . $_FILES['image-input']['name'][$index];
            $targetFilePath = $uploadDir . $fileName;
            if (move_uploaded_file($tempFilePath, $targetFilePath)) {
                $image_inputs[] = $fileName; // Assign file name if upload successful
            } else {
                echo json_encode(['res' => 'error', 'message' => 'Failed to move uploaded file.']);
                exit(); // Stop script execution if file move fails
            }
        }
    }
}

try {
  $convjson = json_encode($image_inputs);
  $query = "INSERT INTO posts_table (text_input, image_input, user_id) VALUES (:text_input, :image_input, :user_id)";
  $statement = $connection->prepare($query); // Use $connection instead of undefined $connection variable
  $statement->bindParam(':text_input', $text_input);
  $statement->bindParam(':image_input', $convjson);
  $statement->bindParam(':user_id', $user_id);
  $statement->execute();

  echo json_encode(["res" => "success"]);
} catch (PDOException $th) {
  echo json_encode(['res' => 'error', 'message' => $th->getMessage()]);
}
?>
