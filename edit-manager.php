<?php
require './config/database.php';

if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $manager_query = "SELECT * FROM managers WHERE id=$id";
    $manager_result = mysqli_query($connection, $manager_query);
    $manager = mysqli_fetch_assoc($manager_result);
}

?>


<?php if (isset($_SESSION['user_is_owner'])) : ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=Blog web
    , initial-scale=1.0" />
        <title>Add User</title>
        <!----------css stylesheet---------->
        <link rel="stylesheet" href="./css/add-employee.css">

        <!--------Google Fonts -------->
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />


    </head>

    <body>
        <section>
            <div class="container">
                <h2>Update manager</h2>
                <?php if (isset($_SESSION['edit-manager'])) : ?>
                    <div class="alert__message error">
                        <p>
                            <?= $_SESSION['edit-manager'];
                            unset($_SESSION['edit-manager'])
                            ?>
                        </p>
                    </div>
                <?php endif ?>
                <form action="edit-manager-logic.php" enctype="multipart/form-data" method="POST">
                    <input type="hidden" value="<?= $manager['id'] ?>" name="id">
                    <input type="text" name="firstname" value="<?= $manager['firstname'] ?>" placeholder="First Name" />
                    <input type="text" name="lastname" value="<?= $manager['lastname'] ?>" placeholder="Last Name" />
                    <input type="text" name="username" value="<?= $manager['username'] ?>" placeholder="Username" />
                    <input type="text" name="job" value="<?= $manager['job'] ?>" placeholder="Enter Job" />
                    <input type="email" name="email" value="<?= $manager['email'] ?>" placeholder="Email" />
                    <input type="text" name="contact" value="<?= $manager['contact'] ?>" placeholder="Enter Phone Number" />
                    <select name="role">
                        <option value="1">Owner</option>
                        <option value="0">Manager</option>
                    </select>

                    <div class="form__control">
                        <label for="avatar">Add Avatar: <small>file must be a jpg or png</small></label>
                        <input type="file" name="avatar" id="avatar" />
                    </div>
                    <button class="btn-primary" name="submit" type="submit">Update manager</button>
                </form>
            </div>
        </section>
    </body>
    < </html>
    <?php endif ?>