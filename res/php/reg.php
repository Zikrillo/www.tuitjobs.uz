<?php
$data  =  json_decode ( file_get_contents ( 'php://input' ),  true );
$login = $data["login"];
$password = $data["password"];
$username = $data["username"];
$surname = $data["surname"];
$phone = $data["phone"];

function connectDB($query){
    $servername = "localhost";
    $dbusername = "admin";
    $dbpassword = "zikrillo11";
    $dbname = "tuitjobs";
    //Create connection
    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
    //Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }
    //Send query
    if ($conn->query($query) === TRUE) {
    echo "1";
    } else {
    echo $conn->error;
    }
    //Close connecton
    $conn->close();
}

function registrate($login, $password, $username, $surname, $phone){
    $pass = password_hash($password,PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (login, password, name, surname, phone) VALUES ('$login', '$pass', '$username', '$surname', '$phone');"; 
    connectDB($sql);
};

registrate($login, $password, $username, $surname, $phone);
?>