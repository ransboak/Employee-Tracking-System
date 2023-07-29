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

<body>
    <section>
        <div class="container">
            <h2>Employee Register</h2>
            <?php if (isset($_SESSION['register'])) : ?>
                <div class="alert__message error">
                    <p>
                        <?= $_SESSION['register'];
                        unset($_SESSION['register'])
                        ?>
                    </p>
                </div>
            <?php elseif (isset($_SESSION['end-session'])) : ?>
                <div class="alert__message error">
                    <p>
                        <?= $_SESSION['end-session'];
                        unset($_SESSION['end-session'])
                        ?>
                    </p>
                </div>
            <?php endif ?>
            <form action="register-logic.php" method="POST">
                <input type="text" name="username" placeholder="Username or Email" />
                <input type="text" name="id" placeholder="Enter employee id..." />
                <button class="btn-primary" name="submit" type="submit">Register</button>
            </form>
        </div>
    </section>
</body>

</html>