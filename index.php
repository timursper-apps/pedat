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
        <h2>Выберите модуль</h2>
        <section class="testTypes">
            <div class="createTest">
                <h3 align='right'>Создать</h3>
                <a href="fordirectors.php"><button>Перейти</button></a>
            </div><br>
            <div class="completeTest">
                <h3 align='right'>Пройти</h3>
                <a href='forteachers.php'><button>Перейти</button></a>
            </div>
            <div class='sendReport'>
                <h3 align='right'>Жалоба</h3>
                <a href='report.php'><button>Отправить</button></a>
            </div>
        </section>
    </center>
    <hr>
    <?php
        include "config.php";
        echo "<p>$ver</p>";
    ?>
    <hr>
    <a href='https://isouop.site'><button>Сайт ИСО «УОП»</button></a>
</body>
</html>