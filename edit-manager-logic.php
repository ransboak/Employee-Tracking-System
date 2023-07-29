<?php
require 'config/database.php';

if (isset($_POST['submit'])) {
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $job = filter_var($_POST['job'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $contact = filter_var($_POST['contact'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $role = filter_var($_POST['role'], FILTER_SANITIZE_NUMBER_INT);


    if (!$firstname || !$lastname) {
        $_SESSION['edit-manager'] = 'Invalid form input on edit';
    } else {
        //update manager
        $query = "UPDATE managers SET firstname ='$firstname' , lastname='$lastname' , username='$username', job='$job' , 
        email='$email', contact='$contact',  is_owner='$role' WHERE id=$id LIMIT 1";
        $result = mysqli_query($connection, $query);

        if (!mysqli_errno($connection)) {
            $_SESSION['edit-manager-success'] = "Manager $firstname $lastname updated successfully";
        } else {
            $_SESSION['edit-manager'] = 'Update failed';
            header('location: ' . ROOT_URL . 'dashboard.php');
            die();
        }
    }
}
header("location: " . ROOT_URL . 'dashboard.php');
