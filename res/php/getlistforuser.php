<?php
include "vars.php";
// Подключение к базе данных MySQL
$mysqli = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);

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
        if($row['header'] != "")
        echo '<div class="main__vacancy-list-item">
        <div class="main__vacancy-list-header">
        '.$row["header"].'
        </div>
        <div class="main__vacancy-list-sub-header">
        '.$row["comment"] .'
        </div>
        <div class="main__vacancy-list-apply">
            <div class="main__vacancy-list-apply-salary">
            '.$row["salary"] .' SOM
            </div>
            <button class="main__vacancy-apply" id="'.$row["id"] .'">Topshirish</button>
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