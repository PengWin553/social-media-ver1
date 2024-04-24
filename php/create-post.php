<?php
include('connection.php');

session_start();
$user_id = $_SESSION["user_id"];

if (!isset($_SESSION["first_name"])) {
  header("location:../index.php");
  exit(); // Ensure script stops execution after redirection
}

$text_input = isset($_POST['text-input']) ? $_POST['text-input'] : null; // Check if text input is set
$image_input = null;

if (isset($_FILES['image-input']) && $_FILES['image-input']['error'] === UPLOAD_ERR_OK) {
  $uploadDir = '../images/';
  $tempFilePath = $_FILES['image-input']['tmp_name'];
  $fileName = uniqid() . '_' . $_FILES['image-input']['name'];
  $targetFilePath = $uploadDir . $fileName;
  if (move_uploaded_file($tempFilePath, $targetFilePath)) {
    $image_input = $fileName; // Assign file name if upload successful
  } else {
    echo json_encode(['res' => 'error', 'message' => 'Failed to move uploaded file.']);
    exit(); // Stop script execution if file move fails
  }
}

try {
  $query = "INSERT INTO posts_table (text_input, image_input, user_id) VALUES (:text_input, :image_input, :user_id)";
  $statement = $connection->prepare($query); // Use $connection instead of undefined $connection variable
  $statement->bindParam(':text_input', $text_input);
  $statement->bindParam(':image_input', $image_input);
  $statement->bindParam(':user_id', $user_id);
  $statement->execute();

  echo json_encode(["res" => "success"]);
} catch (PDOException $th) {
  echo json_encode(['res' => 'error', 'message' => $th->getMessage()]);
}
?>
