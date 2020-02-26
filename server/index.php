<?php
ini_set('display_errors',1);
session_start();
if(!isset($_SESSION['user_id']))header('Location: ./login.html');
?>

<?php
$id = $_SESSION['user_id'];
require_once "./config.php";
$stmt = $con->prepare("SELECT * FROM moduleData LEFT JOIN modules m on m.userId = $id WHERE moduleId = m.id ;");
//$stmt->bind_param('i', $row[0]);
$stmt->execute();
$result = $stmt->get_result();
while($list = mysqli_fetch_array($result)){   //Creates a loop to loop through results
    //if($count >= 10)break;
    //echo "<span>" . $list['eventTime'] . " " . $list['moduleId'] . " " . $list['latitude'] . " " . $list['longitude'] . " " . $list['imuEvent'] . "</span>". "<br>";
    $lat = $list['latitude'];
    $lng = $list['longitude'];
}
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
    <style>
        /* Always set the map height explicitly to define the size of the div
         * element that contains the map. */
        #map {
            height: 100%;
        }
        /* Optional: Makes the sample page fill the window. */
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
    </style>
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
            <span><li><a href ="#" id="active">Начало</a></li></span>
            <span><li><a href ="./devices.php">Модули</a></li></span>
            <span><li><a href ="./events.php">Данни</a></li></span>
            <span><li><a href ="./logout.php">Изход</a></li></span>
        </div>
    </ul>
</div>
<div class="block" style="height: 90%">
<div id="map"></div>

    <script>
    function initMap() {
        var lat = <?php echo $lng ?>;
        var lng = <?php echo $lat; ?>;
        //alert(lat);
        var myLatLng = {lat,lng};

        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 15,
            center: myLatLng
        });

        var marker = new google.maps.Marker({
            position: myLatLng,
            map: map,
            title: 'Hello World!'
        });
    }
</script>
</div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAwDuh7kjG4WrsgYXnx6dn4d2lKfSvoKLw&callback=initMap"
        async defer></script>
</body>
</html>
