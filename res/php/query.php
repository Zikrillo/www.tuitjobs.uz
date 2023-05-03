<?
include "vars.php";


$fetchData = file_get_contents('php://input');

function createVacancyFromFetch($fetchData) {
    // Распарсить JSON-строку в PHP-массив
    $data = json_decode($fetchData, true);

    // Получение значений полей из массива
    $header = $data['header'];
    $author = $data['login'];
    $comment = $data['comment'];
    $salary = $data['salary'];  
    $region = $data['region'];
    echo $author;
    // Вызов функции для создания записи в таблице "vacancy"
    createVacancy($header, $author, $comment, $salary, $region);
}

function createVacancy($header, $author, $comment, $salary, $region) {
    // Подключение к базе данных
    include "vars.php";
    $conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);

    // Проверка соединения
    if (!$conn) {
        die("Ошибка подключения: " . mysqli_connect_error());
    }

    // Создание SQL-запроса
    $sql = "INSERT INTO vacancy (header, author, comment, salary, region) VALUES ('$header', '$author', '$comment', '$salary', '$region')";

    // Выполнение SQL-запроса
    if (mysqli_query($conn, $sql)) {
        echo "Запись успешно создана";
    } else {
        echo "Ошибка при создании записи: " . mysqli_error($conn);
    }

    // Закрытие соединения с базой данных
    mysqli_close($conn);
}
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

if (password_verify($password,$hashpass)) {
    createVacancyFromFetch($fetchData);
} else {
}
$conn->close();

?>