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
        <title>АИС «ПА»</title>
    </head>
    <body>
        <h2>Создание теста</h2>
        <form method="post" action="configureTest.php" class="createTestForm">
            <label>Введите название теста на латинице без пробелов: <input type="text" name="testName"></label><br>
            <input type="submit" value="Создать / Продолжить работу">
        </form>
        <hr>
        <h2>Просмотр результатов теста</h2>
        <form method='post' action='results.php' class="createTestForm">
            <label>Введите название теста на латинице без пробелов: <input type="text" name="testName"></label><br>
            <input type="submit" value="Просмотр результатов">
        </form>
        <p>Если вы хотите продолжить создание теста, то также укажите название теста и нажмите на кнопку</p>
        <?php
            echo "<hr><p>$ver</p>";
        ?>
    </body>
</html>