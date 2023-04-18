<?php

// Подключение к базе данных MySQL
$mysqli = mysqli_connect('localhost', 'admin', 'zikrillo11', 'tuitjobs');

// Проверка соединения с базой данных
if ($mysqli->connect_error) {
    die("Ошибка подключения: " . $mysqli->connect_error);
}

// Выполнение SQL-запроса для получения данных из базы данных
$sql = "SELECT * FROM vacancy";
$result = $mysqli->query($sql);

// Проверка наличия результатов
if ($result->num_rows > 0) {
    // Вывод данных в виде HTML

    
    
    while ($row = $result->fetch_assoc()) {
        echo '<div class="response-list__vacancy-item">
        <div class="response-list__vacancy-item-header">
           '.$row["header"].'
        </div>
        <div class="response-list__vacancy-item-description">
        '.$row["comment"] .'
        </div>
    </div>';

        // echo "<td>" . $row["author"] . "</td>";
        
        // echo "<td>" . $row["salary"] . "</td>";
        // echo "<td>" . $row["region"] . "</td>";
        // echo "</tr>";
    }
} else {
    echo "Нет данных";
}

// Закрытие соединения с базой данных
$mysqli->close();

?>