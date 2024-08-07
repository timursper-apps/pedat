<?php
    require "../config.php";
    echo "<meta charset='utf-8'>";
    echo '<link rel="stylesheet" href="../style.css">';
    $testName = $_GET["name"];

    $sql = new mysqli($host, $user, $passw);
    if ($sql->connect_error) {
        die("Connection failed: " . $sql->connect_error);
    }
    $sql->query("USE $db");

    $res = $sql->query("SELECT userName, correctAnswers, incorrectAnswers FROM testcomplete WHERE testName = '$testName'");
    if ($res->num_rows > 0) {
        echo "<table border='1'>";
        echo "<tr>";
        echo "<td>ФИО испытуемого</td><td>Правильные ответы</td><td>Неправильные ответы</td>";
        echo "</tr>";
        foreach ($res as $row){
            echo "<tr>";
            foreach ($row as $el){
                echo "<td>$el</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    } else {
        die("Никто не прошел тест");
    }
    echo "<a href='../fordirectors.php'><button>На главную</button></a>";
    echo "<hr>$ver";