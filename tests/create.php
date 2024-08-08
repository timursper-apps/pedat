<?php
    require "../config.php";
    echo "<meta charset='UTF-8'>";
    echo "<link rel='stylesheet' href='../style.css'>";

    $sql = new mysqli($host, $user, $passw);
    if ($sql->connect_error) {
        die("Connection failed: " . $sql->connect_error);
    }

    $sql->query("USE $db");
    $sql->query("CREATE TABLE IF NOT EXISTS tests (
        testName TEXT,
        testAlias TEXT
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

    $sql->close();
?>

<html>
    <head>
        <title>АИС «Тесты»</title>
    </head>
    <body>
        <h2>Создание теста</h2>
        <font color='red'>Внимание! Не говорите кодовое слово от теста испытуемым! По кодовому слову можно зайти в настройки теста.</font>
        <form method="post" action="configureTest.php" class="createTestForm">
            <label>Введите название теста на латинице без пробелов: <input type="text" name="testName"></label><br>
            <label>Введите кодовое слово для входа: <input type="text" name="testAlias"></label><br>
            <input type="submit" value="Создать / Продолжить работу">
        </form>
        <hr>
        <p>Если вы хотите продолжить создание теста, то также укажите название теста и нажмите на кнопку</p>
        <a href='../fordirectors.php'><button>Завершить сессию</button></a>
        <?php
            echo "<hr><p>$ver</p>";
        ?>
    </body>
</html>