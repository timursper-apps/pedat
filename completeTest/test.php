<?php
require "../config.php";
echo "<meta charset='UTF-8'>";
echo "<link rel='stylesheet' href='../style.css'>";

if (isset($_POST["testName"]) && isset($_POST["name"])) {
    $testName = $_POST["testName"];
    $teacherName = $_POST["name"];
}

$sql = new mysqli($host, $user, $passw);
if ($sql->connect_error) {
    die("Connection failed: " . $sql->connect_error);
}
$sql->query("USE $db");

$query = "CREATE TABLE IF NOT EXISTS `testComplete` ( `testName` TEXT, `userName` TEXT, `correctAnswers` INTEGER, `incorrectAnswers` INTEGER ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";
$sql->query($query);

$userCompleted = $sql->query("SELECT * FROM `testComplete` WHERE userName = '$teacherName' AND `testName` = '$testName'");
if ($userCompleted->num_rows > 0) {
    die("Вы уже проходили данный тест!");
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <title>Прохождение теста</title>
</head>
<body>
    <?php
        $res = $sql->query("SELECT question FROM $testName");
        $i = 0;
        
        echo "<form action='result.php' method='POST'>";
        
        while ($row = $res->fetch_assoc()) {
            $questionText = explode("\n", $row['question']);
            echo "<label>";
            foreach ($questionText as $line) {
                echo $line . "<br>";
            }
            echo "Ответ: <input type='text' name='answer$i' required>"; // Добавляем атрибут required для проверки заполнения
            echo "</label><br><hr>";
            $i++;
        }
        echo "<input type='hidden' name='questionsCount' value='$i'>"; // Передача количества вопросов
        echo "<input type='hidden' name='testName' value='$testName'>"; // Передача названия теста
        echo "<input type='hidden' name='userName' value='$teacherName'>"; // Передача имени пользователя
        echo "<input type='submit' value='Отправить'>";
        echo "</form>";
        echo "<hr><p>$ver</p>";
    ?> 
</body>
</html>
