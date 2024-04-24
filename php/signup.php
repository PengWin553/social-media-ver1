<?php
include('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $dob_month = $_POST['dob_month'];
    $dob_day = $_POST['dob_day'];
    $dob_year = $_POST['dob_year'];
    $gender = $_POST['gender'];
    $gmail = $_POST['gmail'];
    $password = $_POST['password'];

    try {
        $query = "INSERT INTO userinfo_table (first_name, last_name, dob_month, dob_day, dob_year, gender, gmail, password ) VALUES (:first_name, :last_name, :dob_month, :dob_day, :dob_year, :gender, :gmail, :password)";
        $statement = $connection->prepare($query);
        $statement->bindParam(':first_name', $first_name);
        $statement->bindParam(':last_name', $last_name);
        $statement->bindParam(':dob_month', $dob_month);
        $statement->bindParam(':dob_day', $dob_day);
        $statement->bindParam(':dob_year', $dob_year);
        $statement->bindParam(':gender', $gender);
        $statement->bindParam(':gmail', $gmail);
        $statement->bindParam(':password', $password);
        $statement->execute();

        echo json_encode(["res" => "success"]);
    } catch (PDOException $th) {
        echo json_encode(['res' => 'error', 'message' => $th->getMessage()]);
    }
} else {
    echo json_encode(['res' => 'error', 'message' => 'Invalid request method']);
}
?>
