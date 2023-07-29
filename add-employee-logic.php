<?php
require './config/database.php';

if (isset($_POST['submit'])) {
    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $job = filter_var($_POST['job'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $contact = filter_var($_POST['contact'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $status = filter_var($_POST['status'], FILTER_SANITIZE_NUMBER_INT);
    $avatar = $_FILES['avatar'];


    if (!$firstname) {
        $_SESSION['add-employee'] = 'Enter firstname';
    } elseif (!$lastname) {
        $_SESSION['add-employee'] = 'Enter lasttname';
    } elseif (!$job) {
        $_SESSION['add-employee'] = 'Enter job title';
    } elseif (!$email) {
        $_SESSION['add-employee'] = 'Enter email';
    } elseif (!$contact) {
        $_SESSION['add-employee'] = 'Enter contact';
    } elseif (!$status) {
        $_SESSION['add-employee'] = 'Enter status';
    } elseif (!$avatar['name']) {
        $_SESSION['add-employee'] = 'Add profile picture';
    } else {
        $user_check_query = "SELECT * FROM users WHERE email = '$email'";
        $user_check_results = mysqli_query($connection, $user_check_query);

        if (mysqli_num_rows($user_check_results) > 0) {
            $_SESSION['add-employee'] = 'Employee already exists is the database';
        } else {

            $time = time();
            $avatar_name = $time . $avatar['name'];
            $avatar_tmp_name = $avatar['tmp_name'];
            $avatar_destination_path = 'images/' . $avatar_name;

            $allowed_files = ['png', 'jpg', 'jpeg'];
            $extension = explode('.', $avatar_name);
            $extension = end($extension);

            if (in_array($extension, $allowed_files)) {
                //if file < 1 mb
                if ($avatar['size'] < 1000000) {
                    move_uploaded_file($avatar_tmp_name, $avatar_destination_path);
                } else {
                    $_SESSION['add-employee'] = 'file too large';
                }
            } else {
                $_SESSION['add-employee'] = 'File must be a png, jpg or jpeg';
            }
        }
    }
    if (isset($_SESSION['add-employee'])) {
        $_SESSION['add-employee-data'] = $_POST;
        header('location: ' . ROOT_URL . 'add-employee.php');
        die();
    } else {
        $insert_employee_query = "INSERT into employees SET firstname='$firstname', 
        lastname='$lastname', job='$job', email='$email', contact='$contact', status=$status, avatar='$avatar_name' ";
        $insert_employee_results = mysqli_query($connection, $insert_employee_query);

        if (!mysqli_errno($connection)) {
            $_SESSION['add-employee-success'] = "Employee $firstname $lastname added successfully";
            header('location: ' . 'dashboard.php');
            die();
        }
    }
} else {
    header('location: ' . ROOT_URL . 'add-employee.php');
    die();
}
