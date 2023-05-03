<?php
 include "vars.php";
// Подключение к базе данных
$mysqli = new mysqli($servername, $dbusername, $dbpassword, $dbname);
// Проверка соединения
if($mysqli->connect_error) {
    die("Ошибка подключения: " . $mysqli->connect_error);
}

// SQL-запрос с соединением таблиц
$sql = "SELECT users.name, users.surname, users.phone
        FROM responses
        JOIN users ON responses.login = users.login
        WHERE responses.vacancy_id = ?"; // Здесь вместо вопросительного знака ставится значение vacancy_id, которое нужно передать

// Создание подготовленного выражения
$stmt = $mysqli->prepare($sql);

// Проверка на ошибки создания подготовленного выражения
if(!$stmt) {
    die("Ошибка подготовки запроса: " . $mysqli->error);
}
// $fetchData = file_get_contents('php://input');
    
// function createVacancyFromFetch($fetchData) {
//     // Распарсить JSON-строку в PHP-массив
$data = json_decode(file_get_contents('php://input'), true);

// Привязка параметров
$vacancy_id = $data["id"]; // Здесь нужно указать значение vacancy_id, которое нужно передать
$stmt->bind_param("i", $vacancy_id);

// Выполнение запроса
$stmt->execute();

// Получение результата
$result = $stmt->get_result();

// Проверка на ошибки выполнения запроса
if(!$result) {
    die("Ошибка выполнения запроса: " . $mysqli->error);
}

// Обработка результата
while($row = $result->fetch_assoc()) {
    if($row['name'] != "")
    echo 
    // Вывод результатов или другая обработка
    '<div class="vacancy__user-list-item">

    <div class="header__nav-username">
        <div class="header__nav-username-logo">
        '.$row['name'][0]."". $row['surname'][0].'
        </div>
        <div class="header__nav-header">
            '.$row['name']." ". $row['surname'].'
        </div>
    </div>
    <div>'.$row['phone'].'</div>
</div>';
    }

// Закрытие подготовленного выражения и соединения
$stmt->close();
$mysqli->close();

?>
