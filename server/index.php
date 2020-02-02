<?php
session_start();
if(!isset($_SESSION['user_id']))header('Location: ./login.html');
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
            <span style="font-weight: bold; margin-bottom: 1%">Народна Република България</span><br>Министерство на транспорта<br/>Главно управление на пътищата
        </div>
        <div style="display: inline-flex">
            <span><li><a href ="#" id="active">Начало</a></li></span>
            <span><li><a href ="./devices.php">Модули</a></li></span>
            <span><li><a href ="./logout.php">Изход</a></li></span>
        </div>
    </ul>
</div>
<div class="block" style="height: 90%">
<div id="map"></div>
<script>
    function initMap() {
        var myLatLng = {lat: 42.698334, lng: 23.319941};

        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 4,
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