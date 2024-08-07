<?php
    require "../config.php";
    echo "<meta charset='utf-8'>";
    echo '<link rel="stylesheet" href="../style.css">';
    $userName = $_GET["name"];

    $sql = new mysqli($host, $user, $passw);
    if ($sql->connect_error) {
        die("Connection failed: " . $sql->connect_error);
    }
    $sql->query("USE $db");

    $res = $sql->query("SELECT testName, correctAnswers, incorrectAnswers FROM testcomplete WHERE userName = '$userName'");
    if ($res->num_rows > 0) {
        echo "<table border='1'>";
        echo "<tr>";
        echo "<td>Название теста</td><td>Правильные ответы</td><td>Неправильные ответы</td>";
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
        die("Вы ещё не проходили ни одного теста");
    }
    echo "<a href='../forteachers.php'><button>На главную</button></a>";
    echo "<hr>$ver";