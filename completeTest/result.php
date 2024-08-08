<?php
require "../config.php";

// Получаем данные POST-запроса с проверкой на их наличие
$testName = isset($_POST["testName"]) ? $_POST["testName"] : '';
$questionsCount = isset($_POST["questionsCount"]) ? (int)$_POST["questionsCount"] : 0;
$userName = isset($_POST["userName"]) ? $_POST["userName"] : '';

// Если нужные данные не получены, выдаем ошибку
if (empty($testName) || $questionsCount === 0 || empty($userName)) {
    die("Ошибка: Неполные данные.");
}

// Подключение к базе данных
$sql = new mysqli($host, $user, $passw);
if ($sql->connect_error) {
    die("Connection failed: " . $sql->connect_error);
}
$sql->query("USE $db");

$userCompleted = $sql->query("SELECT * FROM `testComplete` WHERE userName = '$teacherName' AND `testName` = '$testName'");
if ($userCompleted->num_rows > 0) {
    die("Вы уже проходили данный тест!");
}

// Переменные для подсчёта правильных и неправильных ответов
$correctAnswers = 0;
$incorrectAnswers = 0;

// Проходим по всем вопросам
for ($i = 0; $i < $questionsCount; $i++) {
    // Получаем ответ пользователя
    $userAnswer = isset($_POST["answer$i"]) ? trim($_POST["answer$i"]) : '';

    // Получаем правильный ответ из базы данныхquestions
    $query = "SELECT answer FROM $testName WHERE question = (SELECT question FROM $testName LIMIT 1 OFFSET $i)";
    $result = $sql->query($query);
    if ($result && $row = $result->fetch_assoc()) {
        $correctAnswer = $row['answer'];

        // Сравниваем ответ пользователя с правильным ответом
        if (strcasecmp($userAnswer, $correctAnswer) === 0) {
            $correctAnswers++;
        } else {
            $incorrectAnswers++;
        }
    } else {
        // Обработка ошибки, если вопрос не найден
        echo "Ошибка: вопрос с номером $i не найден.<br>";
    }
}

// Сохраняем результаты в базу данных
$query = "INSERT INTO testComplete (testName, userName, correctAnswers, incorrectAnswers) 
          VALUES ('$testName', '$userName', $correctAnswers, $incorrectAnswers)";
$sql->query($query);

// Закрываем подключение к базе данных
$sql->close();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <title>Результаты теста</title>
</head>
<body>
    <h1>Результаты теста</h1>
    <p>Правильных ответов: <?php echo $correctAnswers; ?></p>
    <p>Неправильных ответов: <?php echo $incorrectAnswers; ?></p>
    <hr>
    <?php
        $incorrectAnswersPerecent = ceil(intval($incorrectAnswers) / intval($questionsCount) * 100);
    ?>
    <p>Процент правильных ответов: <?php echo $incorrectAnswersPerecent;?>%</p>
    <p>Процент неправильных ответов: <?php echo 100 - $incorrectAnswersPerecent?>%</p>
    <?php
        echo "<hr><p>$ver</p>";
    ?>
</body>
</html>
