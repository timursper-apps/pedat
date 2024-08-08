<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>АИС «Тесты»</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <center>
    <h1>АИС «Тесты»</h1>
        <section class="testTypes">
            <div class="completeTest">
                <h2 align='right'>Пройти</h2>
                <form action="completeTest/test.php" method="post">
                    <input type="text" name="name" placeholder="Ваше ФИО"><br>
                    <input type="text" name="testName" placeholder="Название теста"><br>
                    <input type="submit" value="Пройти">
                </form>
            </div>
            <div class="statsByTests">
                <h2 align='right'>Статистика</h2>
                <form action="stats/userstats.php" method="get">
                    <input type="text" name="name" placeholder="Ваше ФИО"><br>
                    <input type="submit" value="Проверить">
                </form>
            </div>
        </section>
    </center>
    <a href='index.php'><button style='margin-top:15px;'>Назад</button></a>
    <hr>
    <?php
        include "config.php";
        echo "<p>$ver</p>";
    ?>
    <hr>
    <a href='https://isouop.site'><button>Сайт ИСО «УОП»</button></a>
</body>
</html>