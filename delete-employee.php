<?php
require 'config/database.php';

if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $employee_query = "SELECT * FROM employees WHERE id = $id";
    $employee_result = mysqli_query($connection, $employee_query);
    $employee = mysqli_fetch_assoc($employee_result);

    if (mysqli_num_rows($employee_result) == 1) {
        $avatar_name = $employee['avatar'];
        $avatar_path = 'images/' . $avatar_name;

        //delete image if available
        if ($avatar_path) {
            unlink($avatar_path);
        }
    }

    $delete_employee_query = "DELETE FROM employees WHERE id=$id";
    $delete_employee_results = mysqli_query($connection, $delete_employee_query);

    if (!mysqli_errno($connection)) {
        $_SESSION['delete-employee-success'] = "{$employee['firstname']}  {$employee['lastname']} deleted successfully";
        header('location: ' . 'dashboard.php');
    } else {
        $_SESSION['delete-employee'] = "Couldn't delete {$employee['firstname']}  {$employee['lastname']}";
    }
}
