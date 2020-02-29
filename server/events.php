<?php
session_start();
if(empty($_GET['apicall'])){
    require_once "./config.php";
    if (!isset($_SESSION['user_id'])) header('Location: ./login.html');
    $id = $_SESSION['user_id'];
    $stmt = $con->prepare("SELECT * FROM modules WHERE userId = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $modulesIdArray = $stmt->get_result();
}else{
    require_once "./config.php";
    $username = $_GET['username'];
    $stmt = $con->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->bind_param('i', $username);
    $stmt->execute();
    $result = $stmt->get_result();
    //$row = mysqli_fetch_row($result);
}

//echo $modules->id;
?>
<!DOCTYPE html>
<html>
<head>
    <title>ГУП - Информационна система</title>
    <link rel="icon" href="https://cache2.24chasa.bg/Images/Cache/160/Image_7034160_126.jpg">
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css" type="text/css">

    <meta http-equiv="content-language" content="en-us, bg" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="viewport" content="initial-scale=1.0">
    <meta charset="utf-8">

</head>

<body>
<div class="header_box">
    <ul>
        <div class="header">
            <img src="./textures/logo.png" alt="logo">
        </div>
        <div id="text">
            <span style="font-weight: bold; margin-bottom: 1%">ДСО "Респром"</span><br>Завод за автомобилна електроника "Бистра Башева"<br>Главно управление по контрол на трафика
        </div>
        <div style="display: inline-flex">
            <span><li><a href ="index.php">Начало</a></li></span>
            <span><li><a href ="./devices.php">Модули</a></li></span>
            <span><li><a href ="./events.php" id="active">Данни</a></li></span>
            <span><li><a href ="./logout.php">Изход</a></li></span>
        </div>
    </ul>
</div>
<div class='block'>
    <label for="moduleId">Налични модули:</label>
    <form action='events.php' method='POST'>
    <select name="moduleId">
        <?php
        while($res = mysqli_fetch_array($modulesIdArray)){   //Creates a loop to loop through results
            echo "<option value=".$res['id'] .">" .$res['id']. "</option>";

        }
        echo "</select>";
        echo "<button type=\"submit\">Изпрати</button>";
        echo "</form>";
        $moduleId = filter_input(INPUT_POST,'moduleId');
        $stmt = $con->prepare("SELECT * FROM  (SELECT * FROM moduleData where moduleId = ? ORDER BY id DESC LIMIT 20) sub LEFT JOIN modules m on m.userId = ? and m.id = ? ORDER BY sub.id ASC ;");
        $stmt->bind_param('iii',$moduleId, $id, $moduleId);
        $stmt->execute();
        $result = $stmt->get_result();
        if($moduleId[0] == '1'){
            echo "<table class='table'>";
            echo "<tr>";
            echo "<th>Час и дата</th>";
            echo "<th>КН на модул</th>";
            echo "<th>Географска ширина</th>";
            echo "<th>Географска дължина</th>";
            echo "<th>Данни IMU</th>";
            echo "</tr>";
            while($list = mysqli_fetch_array($result)){   //Creates a loop to loop through results
                echo "<tr>";
                echo "<td>" . $list['eventTime'] . "</td><td>" . $list['moduleId'] . "</td><td>" . $list['latitude'] . "</td><td>" . $list['longitude'] . "</td><td>" . $list['imuEvent'] . "</td>";
                echo "</tr>";
            }
        }
        else{
            echo "<table class='table'>";
            echo "<tr>";
            echo "<th>Час и дата</th>";
            echo "<th>КН на модул</th>";
            echo "<th>Шок сензор</th>";
            echo "<th>RFID потвърждение</th>";
            echo "</tr>";
            while($list = mysqli_fetch_array($result)){   //Creates a loop to loop through results
                echo "<tr>";
                echo "<td>" . $list['eventTime'] . "</td><td>" . $list['moduleId'] . "</td><td>" . $list['shockEvent'] . "</td><td>" . $list['rfidEvent'] . "</td>";
                echo "</tr>";
            }
        }

        ?>
</div>
</body>
</html>