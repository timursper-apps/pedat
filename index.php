<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>АИС «Педагогическая Аттестация»</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>АИС «Педагогическая Аттестация»</h1>
    <section class="testTypes">
        <div class="createTest">
            <h2>Создать тест</h2>
            <a href="tests/create.php"><button>Перейти к инструменту создания</button></a>
        </div><br>
        <div class="completeTest">
            <h2>Пройти тест</h2>
            <form action="completeTest/test.php" method="post">
                <input type="text" name="name" placeholder="Ваше ФИО"><br>
                <input type="text" name="testName" placeholder="Название теста"><br>
                <input type="submit" value="Пройти">
            </form>
        </div>
    </section>
    <hr>
    <?php
        include "config.php";
        echo "<p>$ver</p>";
    ?>
</body>
</html>