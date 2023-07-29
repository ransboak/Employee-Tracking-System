<?php
require 'config/database.php';


?>
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
<?php if (isset($_SESSION['user_is_owner'])) : ?>

    <body>
        <section>
            <div class="container">
                <h2>Add Manager</h2>
                <?php if (isset($_SESSION['add-manager'])) : ?>
                    <div class="alert__message error">
                        <p>
                            <?= $_SESSION['add-manager'];
                            unset($_SESSION['add-manager'])
                            ?>
                        </p>
                    </div>
                <?php endif ?>
                <form action="add-manager-logic.php" enctype="multipart/form-data" method="POST">
                    <input type="text" name="firstname" placeholder="First Name" />
                    <input type="text" name="lastname" placeholder="Last Name" />
                    <input type="text" name="username" placeholder="Username" />
                    <input type="text" name="job" placeholder="Enter Job" />
                    <input type="email" name="email" placeholder="Email" />
                    <input type="tel" name="contact" placeholder="Enter Phone Number" />
                    <input type="password" name="createpassword" placeholder="Create Password" />
                    <input type="password" name="confirmpassword" placeholder="Confirm Password" />
                    <select name="role">
                        <option value="1">Owner</option>
                        <option value="0">Manager</option>
                    </select>

                    <div class="form__control">
                        <label for="avatar">Add Avatar: <small>file must be a jpg or png</small></label>
                        <input type="file" name="avatar" id="avatar" />
                    </div>
                    <button class="btn-primary" name="submit" type="submit">Add</button>
                </form>
            </div>
        </section>
    </body>
<?php endif ?>

</html>