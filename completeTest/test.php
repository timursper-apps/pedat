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

$userCompleted = $sql->query("SELECT * FROM `testComplete` WHERE userName = '$teacherName'");
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
            $questionText = $row['question'];
            echo "<label class='completeTestForm'>$questionText<input type='text' name='answer$i'></label><br>";
            $i++;
        }
        echo "<input type='hidden' name='questions' value=$i>";
        echo "<input type='hidden' name='testName' value='$testName'>";
        echo "<input type='hidden' name='userName' value='$teacherName'>";
        echo "<input type='submit'>";
        echo "</form>";
    ?>
</body>
</html>
