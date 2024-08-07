<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>АИС «Тесты»</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>АИС «Тесты»</h1>
    <section class="testTypes">
        <div class="createTest">
            <h2 align='right'>Я директор</h2>
            <a href="fordirectors.php"><button>Перейти</button></a>
        </div><br>
        <div class="completeTest">
            <h2 align='right'>Я учитель</h2>
            <a href='forteachers.php'><button>Перейти</button></a>
        </div>
    </section>
    <hr>
    <?php
        include "config.php";
        echo "<p>$ver</p>";
    ?>
    <hr>
    <a href='https://isouop.site'><button>Сайт ИСО «УОП»</button></a>
</body>
</html>