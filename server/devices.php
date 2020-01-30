<?php
session_start();
    if (!isset($_SESSION['user_id'])) header('Location: ./login.html');

    $con = new mysqli("127.0.0.1", "root", "root", "ALARM_SYSTEM");
    $con = new mysqli("127.0.0.1", "root", "root", "ALARM_SYSTEM");
    $stmt = $con->prepare("SELECT * FROM modules WHERE id = ?");
    $stmt->bind_param('i', $_SESSION['user_id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $modules = $result->fetch_object();