<?php
session_start();
include('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $gmail = $_POST['gmail'];
    $password = $_POST['password'];

    try {
        $sql = "SELECT * FROM userinfo_table WHERE gmail = :gmail AND password = :password";
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(':gmail', $gmail);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            // Matching input found

            // SET SESSION GLOBAL VARIABLES
            $_SESSION["user_id"] = $row["user_id"];
            $_SESSION["first_name"] = $row["first_name"];
            $_SESSION["last_name"] = $row["last_name"]; // Add last name
            echo json_encode(["res" => "success", "message" => "Login successful!", "first_name" => $row["first_name"], "last_name" => $row["last_name"]]);
        } else {
            // No matching input found
            echo json_encode(["res" => "error", "message" => "Username or password incorrect"]);
        }
    } catch (PDOException $th) {
        echo json_encode(['res' => 'error', 'message' => $th->getMessage()]);
    }
} else {
    echo json_encode(['res' => 'error', 'message' => 'Invalid request method']);
}
?>
