<?php
session_start();
    if (!isset($_SESSION['user_id'])) header('Location: ./login.html');

    $con = new mysqli("127.0.0.1", "root", "root", "ALARM_SYSTEM");
    $stmt = $con->prepare("SELECT * FROM modules WHERE userId = ?");
    $stmt->bind_param('i', $_SESSION['user_id']);
    $stmt->execute();
    $result = $stmt->get_result();
    //echo $modules->id;
    echo "<table>"; // start a table tag in the HTML

    while($row = mysqli_fetch_array($result)){   //Creates a loop to loop through results
        echo "<tr><td>" . $row['id'] . "</td></tr>";  //$row['index'] the index here is a field name

    }

    echo "</table>";
        $result->free();