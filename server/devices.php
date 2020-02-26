<?php
session_start();
    if(empty($_GET['apicall'])){
        if (!isset($_SESSION['user_id'])) header('Location: ./login.html');
 	require_once "./config.php";
        $stmt = $con->prepare("SELECT * FROM modules WHERE userId = ?");
        $stmt->bind_param('i', $_SESSION['user_id']);
        $stmt->execute();
        $result = $stmt->get_result();
    
   
    //echo $modules->id;
?>
<!DOCTYPE html>
<html>
<head>
    <title>ГУП - Информационна система</title>
    <link rel="icon" href="https://cache2.24chasa.bg/Images/Cache/160/Image_7034160_126.jpg">
    <meta charset="utf-8">
    <!--<link href="https://www.bgtoll.bg/content/assets/plugins/bootstrap-4.0.0/css/bootstrap.min.css" id="bootstrap-css" rel="stylesheet" type="text/css"> -->
    <link rel="stylesheet" href="style.css" type="text/css">

    <meta http-equiv="content-language" content="en-us, bg" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="viewport" content="initial-scale=1.0">
    <meta charset="utf-8">

    </head>

<?php
    $submit = $_POST;
    if($submit){
        if(filter_input(INPUT_POST, 'type') == 'add'){
            $moduleid = filter_input(INPUT_POST, 'moduleid');
            $stmt = $con->prepare("SELECT * FROM modules WHERE id = ?");
            $stmt->bind_param('i', $moduleid);
            $stmt->execute();
            $check = $stmt->get_result();
            if(empty(mysqli_fetch_array($check))){
                $stmt = $con->prepare("INSERT INTO modules(id,userId) values(?,?)");
                $stmt->bind_param("ii",$moduleid,$_SESSION['user_id']);
                if ($stmt->execute()) {
                    echo("OK");
                    header("Location: ./devices.php");
                } else {
                    echo "Something went wrong. Please try again later.";
                }
            }else{
                echo ("This module is already registered");
                header("refresh:3;url=./devices.php");
            }
        }else{
            $moduleid = filter_input(INPUT_POST, 'moduleid');
            $stmt = $con->prepare("SELECT * FROM modules WHERE id = ?");
            $stmt->bind_param('i', $moduleid);
            $stmt->execute();
            $check = $stmt->get_result();
            if(!empty(mysqli_fetch_array($check))){
                $stmt = $con->prepare("DELETE FROM modules WHERE id = ?");
                $stmt->bind_param("i",$moduleid);
                if ($stmt->execute()) {
                    echo("OK");
                    header("Location: ./devices.php");
                } else {
                    echo "Something went wrong. Please try again later.";
                }
            }else{
                echo ("This module is already deleted");
                header("refresh:3;url=./devices.php");
            }
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
            <span style="font-weight: bold; margin-bottom: 1%">ДСО "Респром"</span><br>Завод за автомобилна електроника "Бистра Башева"<br>Главно управление по контрол на трафика
        </div>
        <div style="display: inline-flex">
            <span><li><a href ="index.php">Начало</a></li></span>
            <span><li><a href ="./devices.php" id="active">Модули</a></li></span>
            <span><li><a href ="./events.php">Данни</a></li></span>
            <span><li><a href ="./logout.php">Изход</a></li></span>
        </div>
    </ul>
</div>
    <div class='block'>
        <form action='devices.php' method='POST'>
            <label for="moduleid">Module ID</label>
            <input name="moduleid" value=""/>
            <label for="add">Add</label>
            <input type="radio" name="type" value="add" checked="checked">
            <label for="delete">Delete</label>
            <input type="radio" name="type" value="delete">
            <button type="submit">Submit</button>
    </form>
        <?php
        //echo "<div class='block'>";
        echo "<table class='table'>";
        echo "<tr>";
        echo "<th>КН на регистрирани модули</th>";
        echo "</tr>";
        while($row = mysqli_fetch_array($result)){   //Creates a loop to loop through results
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";  //$row['index'] the index here is a field name
            echo "</tr>";
        }
        echo "</table>";
        ?>
    </div>
    </body>
    </html>
<?php
}else{

         require_once "./config.php";
         $stmt = $con->prepare("SELECT id FROM users WHERE username = ?");
         $stmt->bind_param("s", $_GET['username']);
         $stmt->execute();
         $result = $stmt->get_result();
         $row = mysqli_fetch_row($result);
	 $begin = $_GET['page'];
	 $end = $begin + 10;
         $stmt = $con->prepare("SELECT * FROM modules WHERE userId = ? LIMIT ?, ?");
         $stmt->bind_param('iii', $row[0], $begin, $end);
         $stmt->execute();
         $result = $stmt->get_result();
	 while($row = mysqli_fetch_array($result)){
	     echo $row[0];
	     echo(' ');
	 }
    }
?>
