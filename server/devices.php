<?php
session_start();
    if(empty($_GET['apicall'])){
        if (!isset($_SESSION['user_id'])) header('Location: ./login.html');
 	require_once "./config.php";
        $stmt = $con->prepare("SELECT * FROM modules WHERE userId = ?");
        $stmt->bind_param('i', $_SESSION['user_id']);
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
	 
         $stmt = $con->prepare("SELECT * FROM modules WHERE userId = ?");
         $stmt->bind_param('i', $row[0]);
         $stmt->execute();
         $result = $stmt->get_result();
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

<?php
    $submit = $_POST;
    if($submit){
        $moduleid = filter_input(INPUT_POST, 'moduleid');
        $stmt = $con->prepare("INSERT INTO modules(id,userId) values(?,?)");
        $stmt->bind_param("ii",$moduleid,$_SESSION['user_id']);
        if ($stmt->execute()) {
            echo("OK");
            header("Location: ./devices.php");
        } else {
            echo "Something went wrong. Please try again later.";
        }
    }

?>
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
            <span><li><a href ="./devices.php" id="active">Модули</a></li></span>
            <span><li><a href ="./logout.php">Изход</a></li></span>
        </div>
    </ul>
</div>
<?php
echo "<div class='block'>";
// start a table tag in the HTML

while($row = mysqli_fetch_array($result)){   //Creates a loop to loop through results
    echo "<span>" . $row['id'] . "</span>". "<br>";  //$row['index'] the index here is a field name

}
?>
    <form action='devices.php' method='POST'>
    module ID <input name="moduleid" value=""/>

    <a href="#"><button type="submit" style="margin-left: 84px">Save</button></a>
    </form>
    </div>
    </body>
    </html>
