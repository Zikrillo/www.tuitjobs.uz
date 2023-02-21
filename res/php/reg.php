<?php
$data  =  json_decode ( file_get_contents ( 'php://input' ),  true );
$login = $data["login"];
$password = $data["password"];


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

function registrate($login, $password){
    $pass = password_hash($password,PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (login, password) VALUES ('$login', '$pass');"; 
    connectDB($sql);
};

registrate($login, $password);
?>