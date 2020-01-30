<?php
    session_start();
    $username = filter_input(INPUT_POST, 'username');
    $password = filter_input(INPUT_POST, 'password');

    if (!empty($username) and !empty($password)){
        $link = mysqli_connect("127.0.0.1", "root", "root", "ALARM_SYSTEM");

        if (mysqli_connect_error()){
            die('Connect Error ('. mysqli_connect_errno() .') '
                . mysqli_connect_error());
        }
        else{
            $stmt = $link->prepare("SELECT * FROM users WHERE username = ?");
            $stmt->bind_param('s', $username);
            $stmt->execute();
            $result = $stmt->get_result();
            $user = $result->fetch_object();

            if(!is_null($user))exit("username is already taken");

            $stmt = $link->prepare("INSERT INTO users(username,password) values(?,?)");
            $password_hash = password_hash($password,PASSWORD_DEFAULT);
            $stmt->bind_param("ss", $username,$password_hash);
                if ($stmt->execute()) {
                    echo("OK");
                    header("Location: ./login.html");
                } else {
                    echo "Something went wrong. Please try again later.";
                }



            mysqli_close($link);
        }
    }
    else{
        echo "username or password should not be empty";
        die();
    }

?>

    