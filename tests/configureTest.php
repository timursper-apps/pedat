<?php
    require "../config.php";
    echo "<meta charset='UTF-8'>";
    echo "<link rel='stylesheet' href='../style.css'>";

    if (isset($_POST["testName"])) {
        $testName = $_POST["testName"];
    }

    $sql = new mysqli($host, $user, $passw);
    if ($sql->connect_error) {
        die("Connection failed: " . $sql->connect_error);
    }

    $sql->query("USE $db");
    $query = "CREATE TABLE IF NOT EXISTS `$testName` ( `question` TEXT, `answer` TEXT ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";
    $sql->query($query);
?>

<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <title>Создание теста <?php echo $testName ?></title>
    </head>
    <body>
        <h1>Создание теста <?php echo $testName ?></h1>
        <h2>Создание вопроса</h2>
        <a href='../img/hint.png' target="_blank" rel="noopener noreferrer"><button>Перенос текста</button></a>
        <form method="post">
            <input name="testName" type='hidden' value=<?php echo $testName ?>>
            <label for="question">Вопрос: <textarea name="question"></textarea></label><br>
            <label for="answer">Правильный ответ: <input name="answer" type="text"></label><br>
            <input type="submit" value="Добавить">
        </form>
        <h2>Все вопросы</h2>
        <form method='post' action='checkTest.php'>
            <label>Название теста: <input name='testName' type='text' value=<?php echo $testName ?>></label>
            <input type="submit" value="Показать">
        </form>
        <p>Вы можете завершить создание в любой момент. Каждый вопрос автоматически сохраняется после нажатия на кнопку "Добавить"</p>
        <a href='create.php'><button>Завершить сессию</button></a><br>
    </body>
</html>

<?php
    $testName = $_POST["testName"];
    if (isset($_POST["question"]) && isset($_POST["answer"])) {
        $question = $_POST["question"];
        $answer = $_POST["answer"];

        $query = "INSERT INTO `$testName` (`question`, `answer`) VALUES ('$question', '$answer')";
        $res = $sql->query($query);
        if ($res) {
            echo "<script>alert('Добавлено!');</script>";
        } else{
            echo "<script>alert('Ошибка!\n$res->error');</script>";
        }
    } 
    echo "<hr><p>$ver</p>";
?>