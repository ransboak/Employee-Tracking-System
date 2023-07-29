<?php
require './config/database.php';

if (isset($_POST['submit'])) {
    $username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $employee_id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);

    $employees_query = "SELECT * FROM employees WHERE id = $employee_id";
    $employees = mysqli_query($connection, $employees_query);
    $employee = mysqli_fetch_assoc($employees);
    $employee_firstname = $employee['firstname'];
    $employee_lastname = $employee['lastname'];

    if (!$username) {
        $_SESSION['register'] = 'Please enter your username';
    } elseif (!$employee_id) {
        $_SESSION['register'] = 'Please enter your employee id';
    } else {

        $employee_check_query = "SELECT * FROM register WHERE employee_id = $employee_id";
        $employee_check_result = mysqli_query($connection, $employee_check_query);
        $employee_details = mysqli_fetch_assoc($employee_check_result);
        $employee_is_online = $employee_details['is_online'];

        if (mysqli_num_rows($employee_check_result) > 0) {
            if ($employee_is_online == 0) {
                $employee_update = "UPDATE register SET is_online = 1 WHERE employee_id = $employee_id";
                $employee_update_results = mysqli_query($connection, $employee_update);
                $_SESSION['user-id'] = $employee_id;
                $_SESSION['register'] = "You have been logged back in";
                header('location: ' . ROOT_URL . 'employee-dashboard.php');
                die();
            } else {
                $_SESSION['register'] = 'Employee has already been registered';
                header('location: ' . ROOT_URL . 'register.php');
                die();
            }
        } else {
            $_SESSION['user-id'] = $employee_id;
            $employee_insert_query = "INSERT INTO register SET username = '$username', firstname = '$employee_firstname', lastname = '$employee_lastname', employee_id = $employee_id, is_online = 1";
            $employee_insert_result = mysqli_query($connection, $employee_insert_query);

            if (!mysqli_errno($connection)) {
                $_SESSION['register'] = "You have been registered successfully you are not to end session until your shift ends";
                header('location: ' . ROOT_URL . 'employee-dashboard.php');
                die();
            }
        }
    }
} else {
    header("location: " . ROOT_URL . 'register.php');
    die();
}
