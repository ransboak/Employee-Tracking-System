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
      <h2>Manager SignIn</h2>
      <?php if (isset($_SESSION['signin'])) : ?>
        <div class="alert__message error">
          <p>
            <?= $_SESSION['signin'];
            unset($_SESSION['signin'])
            ?>
          </p>
        </div>
      <?php endif ?>
      <form action="signin-logic.php" enctype="multipart/form-data" method="POST">
        <input type="text" name="username_email" placeholder="Username or Email" />
        <input type="password" name="password" placeholder="Password" />
        <button class="btn-primary" name="submit" type="submit">Sign In</button>
        <small>Are you an employee? <a href="register.php" style="color: blue;">Employee Registeration</a></small>
      </form>
    </div>
  </section>
</body>

</html>