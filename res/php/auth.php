<?php
$data  =  json_decode ( file_get_contents ( 'php://input' ),  true );
$login = $data["login"];
$password = $data["password"];
include "vars.php";
// Подключение к базе данных MySQL

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM users WHERE login='$login'";
$result = $conn->query($sql);
$hashpass = "";
$username = "";
$surname = "";
while ($row = mysqli_fetch_array($result)) {
  $hashpass = $row['password'];
  $username = $row['name'];
  $surname = $row['surname'];
}

if (password_verify($password,$hashpass)) {
  echo "1 $username $surname";
} else {
}
$conn->close();


?>