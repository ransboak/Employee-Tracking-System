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
                <div class="alert__message success">
                    <p>
                        <?= $_SESSION['register'];
                        unset($_SESSION['register'])
                        ?>
                    </p>
                </div>
            <?php endif ?>
            <form action="end-session.php" method="POST">
                <button class="btn-primary" name="submit" type="submit">End Session</button>
            </form>
        </div>
    </section>
</body>

</html>