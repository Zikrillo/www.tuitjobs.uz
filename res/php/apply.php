<?php
function chechAuth(){
  $data  =  json_decode ( file_get_contents ( 'php://input' ),  true );
  $login = $data["login"];
  $password = $data["password"];
  include "vars.php";

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
  $conn->close();
  return password_verify($password,$hashpass);
}

if(chechAuth()){
    $servername = "localhost";
    $dbusername = "admin";
    $dbpassword = "zikrillo11";
    $dbname = "tuitjobs";
    
    
    $fetchData = file_get_contents('php://input');
    
    function createVacancyFromFetch($fetchData) {
        // Распарсить JSON-строку в PHP-массив
        $data = json_decode($fetchData, true);
    
        // Получение значений полей из массива
        $author = $data['login'];
        $id = $data['id'];
        // Вызов функции для создания записи в таблице "vacancy"
        createVacancy($author, $id);
    }
    
    function createVacancy($author, $id) {
        // Подключение к базе данных
        $conn = mysqli_connect('localhost', 'admin', 'zikrillo11', 'tuitjobs');
    
        // Проверка соединения
        if (!$conn) {
            die("Ошибка подключения: " . mysqli_connect_error());
        }
    
        // Создание SQL-запроса
        $sql = "INSERT INTO responses (vacancy_id,login) VALUES ('$id','$author')";
    
        // Выполнение SQL-запроса
        if (mysqli_query($conn, $sql)) {
            echo "Запись успешно создана";
        } else {
            echo "Ошибка при создании записи: " . mysqli_error($conn);
        }
    
        // Закрытие соединения с базой данных
        mysqli_close($conn);
    }
    createVacancyFromFetch($fetchData);
}
?>