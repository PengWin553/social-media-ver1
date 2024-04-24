<?php
include ('connection.php');

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $user_id = $_POST['user_id'];
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];

    try {
        $query = "SELECT *, CONCAT('../images/', image_input) AS picture_url FROM posts_table WHERE user_id = :user_id ORDER BY post_id DESC"; 
        $statement = $connection->prepare($query);
        $statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        // Add first_name and last_name to the data array
        $data = [
            "user_id" => $user_id,
            "first_name" => $first_name,
            "last_name" => $last_name,
            "result" => $result
        ];

        echo json_encode(["res" => "success", "data" => $data]);
    } catch (PDOException $th) {
        echo json_encode(['res' => 'error', 'message' => $th->getMessage()]);
    }
}

?>



