<?php
require 'config/database.php';

if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $manager_query = "SELECT * FROM managers WHERE id = $id";
    $manager_result = mysqli_query($connection, $manager_query);
    $manager = mysqli_fetch_assoc($manager_result);

    if (mysqli_num_rows($manager_result) == 1) {
        $avatar_name = $manager['avatar'];
        $avatar_path = 'images/' . $avatar_name;

        //delete image if available
        if ($avatar_path) {
            unlink($avatar_path);
        }
    }
    $delete_manager_query = "DELETE FROM managers WHERE id=$id";
    $delete_manager_results = mysqli_query($connection, $delete_manager_query);

    if (!mysqli_errno($connection)) {
        $_SESSION['delete-manager-success'] = "{$manager['firstname']}  {$manager['lastname']} deleted successfully";
        header('location: ' . 'dashboard.php');
    } else {
        $_SESSION['delete-manager'] = "Couldn't delete {$manager['firstname']}  {$manager['lastname']}";
    }
}
header("location: " . ROOT_URL . 'dashboard.php');
