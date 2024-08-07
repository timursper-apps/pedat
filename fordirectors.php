<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>АИС «Тесты»</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>АИС «Тесты» для директоров</h1>
    <section class="testTypes">
        <div class="createTest">
            <h2 align='right'>Создать</h2>
            <a href="tests/create.php"><button>Создать</button></a>
        </div>
        <div class="statsByTests">
            <h2 align='right'>Статистика</h2>
            <form action="stats/dirstats.php" method="get">
                <input type="text" name="name" placeholder="Название теста"><br>
                <input type="submit" value="Проверить">
            </form>
        </div>
    </section>
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