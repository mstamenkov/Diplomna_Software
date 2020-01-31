<?php
    session_start();
    $username = filter_input(INPUT_POST, 'username');
    $password = filter_input(INPUT_POST, 'password');

if ( ! empty( $_POST ) ) {
    if ( isset($username) && isset($password) ) {
        // Getting submitted user data from database
        $con = new mysqli("127.0.0.1", "root", "root", "ALARM_SYSTEM");
        $stmt = $con->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_object();
        if(is_null($user)){
            echo("There is no user with this username");
            header("refresh:3;url=login.html");
            die();
        }

        // Verify user password and set $_SESSION
        if ( password_verify($password, $user->password ) ) {
            $_SESSION['user_id'] = $user->id;
            $_SESSION['username'] = $username;
            header("Location: ./index.php");
        }
        else{
            echo("no match");
            header("refresh:3;url=login.html");
        }

    }
}
else echo("no");
    //mysqli_close($link);

?>
