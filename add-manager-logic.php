<?php
require 'config/database.php';

//get user form if submit button was clicked

if (isset($_POST['submit'])) {
    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $job = filter_var($_POST['job'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $contact = filter_var($_POST['contact'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $createpassword = filter_var($_POST['createpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $confirmpassword = filter_var($_POST['confirmpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $is_owner = filter_var($_POST['role'], FILTER_SANITIZE_NUMBER_INT);
    $avatar = $_FILES['avatar'];



    //validate input
    if (!$firstname) {
        $_SESSION['add-manager'] = "Please enter first name";
    } elseif (!$lastname) {
        $_SESSION['add-manager'] = "Please enter Last name";
    } elseif (!$username) {
        $_SESSION['add-manager'] = "Please enter Username";
    } elseif (!$job) {
        $_SESSION['add-manager'] = "Please enter a job";
    } elseif (!$email) {
        $_SESSION['add-manager'] = "Please enter a valid email";
    } elseif (!$contact) {
        $_SESSION['add-manager'] = "Please enter contact details";
    } elseif (strlen($createpassword) < 8 || strlen($confirmpassword) < 8) {
        $_SESSION['add-manager'] = "password should be 8+ characters";
    } elseif (!$avatar['name']) {
        $_SESSION['add-manager'] = "Please add avatar";
    } else {

        if ($createpassword !== $confirmpassword) {
            $_SESSION['add-manager'] = 'passwords do not match';
        } else {

            $hashed_password = password_hash(
                $createpassword,
                PASSWORD_DEFAULT
            );


            $user_check_query = "SELECT * FROM managers WHERE username = '$username'  OR email ='$email'";
            $user_check_result = mysqli_query($connection, $user_check_query);

            if (mysqli_num_rows($user_check_result) > 0) {
                $_SESSION['add-manager'] = 'Username or email already exists';
            } else {
                //WORK ON  AVATAR
                //rename avatar
                $time = time();
                $avatar_name = $time . $avatar['name'];
                $avatar_tmp_name = $avatar['tmp_name'];
                $avatar_destination_path = 'images/' . $avatar_name;

                //make sure file is an image
                $allowed_files = ['png', 'jpg', 'jpeg'];
                $extension = explode('.', $avatar_name);
                $extension = end($extension);
                //check if extension is an allowed extension
                if (in_array($extension, $allowed_files)) {
                    //make sure image is not to large (1mb+)
                    if ($avatar['size'] < 1000000) {
                        //upload avatar
                        move_uploaded_file($avatar_tmp_name, $avatar_destination_path);
                    } else {
                        $_SESSION['add-manager'] = "file too large, should be less than 1mb";
                    }
                } else {
                    $_SESSION['add-manager'] = "file should be png jpg or jpeg";
                }
            }
        }
    }


    if (isset($_SESSION['add-manager'])) {
        $_SESSION['add-manager-data'] = $_POST;
        header('location: ' . ROOT_URL . 'add-manager.php');
        die();
    } else {

        $insert_user_query = "INSERT INTO managers (firstname, lastname, username, job, email, contact, is_owner, password, avatar) 
        VALUES ('$firstname', '$lastname', '$username', '$job', '$email', '$contact', $is_owner, '$hashed_password','$avatar_name')";
        $insert_user_result = mysqli_query($connection, $insert_user_query);

        if (!mysqli_errno($connection)) {

            $_SESSION['add-manager-success'] = "New manager $firstname $lastname added successfully";
            header('location: ' . 'dashboard.php');
        }
    }
} else {
    header('location: ' . ROOT_URL . 'add-manager.php');
    die();
}
