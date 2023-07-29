<?php
require 'config/database.php';

if (isset($_POST['submit'])) {
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $job = filter_var($_POST['job'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $contact = filter_var($_POST['contact'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $status = filter_var($_POST['status'], FILTER_SANITIZE_NUMBER_INT);


    if (!$firstname || !$lastname) {
        $_SESSION['edit-employee'] = 'Invalid form input on edit';
    } else {
        //update employee
        $query = "UPDATE employees SET firstname ='$firstname' , lastname='$lastname' , job='$job' , 
        email='$email', contact='$contact',  status='$status' WHERE id=$id LIMIT 1";
        $result = mysqli_query($connection, $query);

        if (!mysqli_errno($connection)) {
            $_SESSION['edit-employee-success'] = "$firstname $lastname's details updated successfully";
        } else {
            $_SESSION['edit-employee'] = 'Update failed';
            header('location: ' . ROOT_URL . 'dashboard.php');
            die();
        }
    }
}
header("location: " . ROOT_URL . 'dashboard.php');
