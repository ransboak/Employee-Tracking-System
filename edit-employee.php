<?php
require './config/database.php';

if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $employee_query = "SELECT * FROM employees WHERE id=$id";
    $employee_result = mysqli_query($connection, $employee_query);
    $employee = mysqli_fetch_assoc($employee_result);
}

?>


<?php if (isset($_SESSION['user_is_manager'])) : ?>
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
                <h2>update Employee</h2>
                <?php if (isset($_SESSION['edit-employee'])) : ?>
                    <div class="alert__message error">
                        <p>
                            <?= $_SESSION['edit-employee'];
                            unset($_SESSION['edit-employee'])
                            ?>
                        </p>
                    </div>
                <?php endif ?>
                <form action="edit-employee-logic.php" enctype="multipart/form-data" method="POST">
                    <input type="hidden" value="<?= $employee['id'] ?>" name="id">
                    <input type="text" name="firstname" value="<?= $employee['firstname'] ?>" placeholder="First Name" />
                    <input type="text" name="lastname" value="<?= $employee['lastname'] ?>" placeholder="Last Name" />
                    <input type="text" name="job" value="<?= $employee['job'] ?>" placeholder="Enter Job" />
                    <input type="email" name="email" value="<?= $employee['email'] ?>" placeholder="Email" />
                    <input type="text" name="contact" value="<?= $employee['contact'] ?>" placeholder="Enter Phone Number" />
                    <select name="status">
                        <option value="1">Remote</option>
                        <option value="2">Onsite</option>
                    </select>

                    <div class="form__control">
                        <label for="avatar">Add Avatar: <small>file must be a jpg or png</small></label>
                        <input type="file" name="avatar" id="avatar" />
                    </div>
                    <button class="btn-primary" name="submit" type="submit">UPDATE</button>
                </form>
            </div>
        </section>
    </body>
    < </html>
    <?php endif ?>