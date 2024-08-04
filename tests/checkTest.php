<?php
    require "../config.php";
    echo "<meta charset='UTF-8'>";
    echo "<link rel='stylesheet' href='../style.css'>";

    if (isset($_POST["testName"])) {
        $testName = $_POST["testName"];
    }

    $sql = new mysqli($host, $user, $passw);
    if ($sql->connect_error) {
        die("Connection failed: " . $sql->connect_error);
    }

    $sql->query("USE $db");

    $query = "SELECT * FROM $testName";
    $result = $sql->query($query);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "Вопрос: " . $row["question"]. " - Ответ: " . $row["answer"]. "<br>";
        }
    } else {
        echo "Нет результатов";
    }
    $sql->close();
    echo "<hr><p>$ver</p>";
?>