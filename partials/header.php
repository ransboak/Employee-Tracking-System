<?php
require 'config/database.php';

if (isset($_SESSION['user-id'])) {
    $id = $_SESSION['user-id'];
    $manager_query = "SELECT * FROM managers WHERE id = $id";
    $manager_results = mysqli_query($connection, $manager_query);
    $manager = mysqli_fetch_assoc($manager_results);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!--------- CSS ------------>
    <link rel="stylesheet" href="./css/style.css" />
    <!--------- BOXICONS CDN --------->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <title>Employee Management System</title>

</head>

<?php if (isset($_SESSION['user-id'])) : ?>

    <body>
        <nav>
            <div class="profile">
                <div class="profile-img">
                    <img src="<?= 'images/' . $manager['avatar'] ?>" alt="" />
                </div>
                <div class="profile-details">
                    <p class="profile-name"><?= $manager['firstname'] ?> <?= $manager['lastname'] ?></p>
                    <small class="role" style="color: var(--color-light);"><?= $manager['job'] ?></small>
                </div>
            </div>

            <ul class="buttons">

                <li>
                    <a href=""><i class="bx bxs-bell-ring"></i> Notifications</a>
                </li>
                <li>
                    <a href=""><i class="bx bx-cog"></i> Settings</a>
                </li>
                <li>
                    <a href="<?= ROOT_URL ?>logout.php"><i class="bx bx-log-out"></i> Log Out</a>
                </li>
            </ul>
        </nav>
    <?php endif ?>