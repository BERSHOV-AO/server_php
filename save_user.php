<?php

$server_name = "localhost";
$user_name = "root";
$password = "";
$db_name = "test_db";
$table_name = "users";

$connect = new mysqli($server_name, $user_name, $password, $db_name);

if($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}

$data = json_decode(file_get_contents("php://input"), true);

$name = mysqli_real_escape_string($connect, $data['name']);
$tel = mysqli_real_escape_string($connect, $data['tel']);
$time = mysqli_real_escape_string($connect, $data['time']);
$age = mysqli_real_escape_string($connect, $data['age']);

$sql = "INSERT INTO $table_name (name, tel, time, age) VALUES ('$name', '$tel', '$time', '$age')";

if ($connect->query($sql) === TRUE) {
    echo json_encode(array("message" => "User saved!"));
} else {
    echo json_encode(array("message" => "User not saved! Get some error!"));
}
$connect->close();
?>