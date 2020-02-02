<?php
session_start();
if(empty($_GET['apicall'])){
    require_once "./config.php";
    if (!isset($_SESSION['user_id'])) header('Location: ./login.html');
    $id = $_SESSION['user_id'];
    $stmt = $con->prepare("SELECT * FROM moduleData LEFT JOIN modules m on m.userId = $id WHERE moduleId = m.id ;");
    //$stmt->bind_param('i', $row[0]);
    $stmt->execute();
    $result = $stmt->get_result();
}else{
    require_once "./config.php";
    $username = $_GET['username'];
    $stmt = $con->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->bind_param('i', $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = mysqli_fetch_row($result);

}

//echo $modules->id;
?>
<!DOCTYPE html>
<html>
<head>
    <title>ГУП - Информационна система</title>
    <link rel="icon" href="https://cache2.24chasa.bg/Images/Cache/160/Image_7034160_126.jpg">
    <meta charset="utf-8">
    <link href="https://www.bgtoll.bg/content/assets/plugins/bootstrap-4.0.0/css/bootstrap.min.css" id="bootstrap-css" rel="stylesheet" type="text/css">
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
            <span style="font-weight: bold; margin-bottom: 1%">Народна Република България</span><br>Министерство на транспорта<br/>Главно управление на пътищата
        </div>
        <div style="display: inline-flex">
            <span><li><a href ="index.php">Начало</a></li></span>
            <span><li><a href ="./devices.php">Модули</a></li></span>
            <span><li><a href ="./events.php" id="active">Данни</a></li></span>
            <span><li><a href ="./logout.php">Изход</a></li></span>
        </div>
    </ul>
</div>
<?php
echo "<div class='block'>";
// start a table tag in the HTML
$count = 0;
while($list = mysqli_fetch_array($result)){   //Creates a loop to loop through results
    if($count >= 10)break;
    echo "<span>" . $list['eventTime'] . " " . $list['moduleId'] . " " . $list['latitude'] . " " . $list['longitude'] . " " . $list['imuEvent'] . "</span>". "<br>";  //$row['index'] the index here is a field name
    $count++;
}
?>
</div>
</body>
</html>