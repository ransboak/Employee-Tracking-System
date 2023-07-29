<?php
require './config/database.php';

if (isset($_SESSION['user-id'])) {
    $id = $_SESSION['user-id'];

    $employee_update = "UPDATE register SET is_online=0 WHERE employee_id=$id";
    $employee_result = mysqli_query($connection, $employee_update);

    if (!mysqli_errno($connection)) {
        $_SESSION['end-session'] = 'You have ended your session';
    } else {
        $_SESSION['end-session'] = 'An error occured';
        header("location: " . 'register.php');
        die();
    }
}
header("location: " . 'register.php');
die();
