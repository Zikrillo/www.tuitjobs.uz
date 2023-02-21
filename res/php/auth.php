<?php
$data  =  json_decode ( file_get_contents ( 'php://input' ),  true );
$login = $data["login"];
$password = $data["password"];
$servername = "localhost";
$dbusername = "admin";
$dbpassword = "zikrillo11";
$dbname = "tuitjobs";


$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT login, password FROM users WHERE login='$login'";
$result = $conn->query($sql);
$hashpass = "";
while ($row = mysqli_fetch_array($result)) {
  $hashpass = $row['password'];
}

if (password_verify($password,$hashpass)) {
  echo "1";
} else {
}
$conn->close();


?>