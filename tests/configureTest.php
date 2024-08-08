<?php
require "../config.php";

// Включаем отображение ошибок
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<meta charset='UTF-8'>";
echo "<link rel='stylesheet' href='../style.css'>";

if (isset($_POST["testName"]) && isset($_POST["testAlias"])) {
    $testName = $_POST["testName"];
    $testAlias = $_POST["testAlias"];
}

if (empty($testName) || empty($testAlias)) {
    die("Название теста и псевдоним теста не должны быть пустыми.");
}

$sql = new mysqli($host, $user, $passw, $db);
if ($sql->connect_error) {
    die("Ошибка подключения: " . $sql->connect_error);
}

if (!empty($testName) && !empty($testAlias)) {
    $stmt = $sql->prepare("SELECT * FROM tests WHERE testName = ?");
    if (!$stmt) {
        die("Ошибка подготовки запроса: " . $sql->error);
    }
    $stmt->bind_param("s", $testName);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows < 1) {
        $stmt = $sql->prepare("INSERT INTO tests(testName, testAlias) VALUES (?, ?)");
        if (!$stmt) {
            die("Ошибка подготовки запроса: " . $sql->error);
        }
        $stmt->bind_param("ss", $testName, $testAlias);
        $stmt->execute();
    } else {
        $found = false;
        while ($row = $res->fetch_assoc()) {
            if ($row["testAlias"] == $testAlias && $row["testName"] == $testName) {
                $found = true;
                break;
            }
        }
        if (!$found) {
            die("Вы ввели неверные данные");
        }
    }
    $stmt->close();
}

$query = "CREATE TABLE IF NOT EXISTS `$testName` ( `question` TEXT, `answer` TEXT ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";
$sql->query($query);

if (isset($_POST["question"]) && isset($_POST["answer"])) {
    $question = $_POST["question"];
    $answer = $_POST["answer"];

    $stmt = $sql->prepare("INSERT INTO `$testName` (`question`, `answer`) VALUES (?, ?)");
    if (!$stmt) {
        die("Ошибка подготовки запроса: " . $sql->error);
    }
    $stmt->bind_param("ss", $question, $answer);
    $res = $stmt->execute();

    if ($res) {
        echo "<script>alert('Вопрос успешно добавлен');</script>";
    } else {
        echo "<script>alert('Ошибка при добавлении вопроса: " . $stmt->error . "');</script>";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Создание теста <?php echo htmlspecialchars($testName, ENT_QUOTES, 'UTF-8'); ?></title>
</head>
<body>
<h1>Создание теста <?php echo htmlspecialchars($testName, ENT_QUOTES, 'UTF-8'); ?></h1>
<div class="createTestForm">
    <h2>Создание вопроса</h2>
    <form method="post">
        <input name="testName" type="hidden" value="<?php echo htmlspecialchars($testName, ENT_QUOTES, 'UTF-8'); ?>">
        <input name="testAlias" type="hidden" value="<?php echo htmlspecialchars($testAlias, ENT_QUOTES, 'UTF-8'); ?>">
        <label for="question">Вопрос: <textarea name="question"></textarea></label><br>
        <label for="answer">Ответ: <input name="answer" type="text"></label><br>
        <input type="submit" value="Добавить">
    </form>
</div>
<div class="questionsCheck">
    <h2>Все вопросы</h2>
    <form method="post" action="checkTest.php">
        <label>Название теста: <input name="testName" type="text" value="<?php echo htmlspecialchars($testName, ENT_QUOTES, 'UTF-8'); ?>"></label>
        <input type="submit" value="Показать">
    </form>
</div>
<p>Вы можете завершить создание в любой момент. Каждый вопрос автоматически сохраняется после нажатия на кнопку "Добавить"</p>
<a href="create.php"><button>Завершить сессию</button></a><br>
</body>
</html>

<?php
$sql->close();
?>
