<?php
    require "../config.php";
    echo "<meta charset='UTF-8'>";
    $testName = $_POST['testName'];

    $sql = new mysqli($host, $user, $passw);
    if ($sql->connect_error) {
        die("Connection failed: " . $sql->connect_error);
    }

    $sql->query("USE $db");
    $res = $sql->query("SELECT * FROM testComplete WHERE testName = '$testName'");

    $sql->close();

    echo "<link rel='stylesheet' href='../style.css'>";

    if ($res->num_rows > 0) {
        echo "<table border='1'>";
        echo "<tr><td>Название теста</td><td>Имя тестирующего</td><td>Правильные ответы</td><td>Неправильные ответы</td></tr>";
        foreach ($res as $row){
            echo "<tr>";
            foreach ($row as $el){
                echo "<td>$el</td>";
            }
            echo "</tr>";
        }
    
        echo "</table>";
    } else{
        echo "Никто ещё не прошел тестирование";
        echo "<a href='../index.html'><button>На главную</button></a>";
    }