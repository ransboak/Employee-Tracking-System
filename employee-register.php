<?php
include './partials/header.php';

$register_query = "SELECT * FROM register";
$register_results = mysqli_query($connection, $register_query);
$registered_number = mysqli_num_rows($register_results) - 1;
$registered_employees = mysqli_fetch_assoc($register_results);
$employee_id = $registered_employees['employee_id'];



$onsite_query = "SELECT * FROM employees WHERE status=2";
$onsite_employees = mysqli_query($connection, $onsite_query);
$onsite_number = mysqli_num_rows($onsite_employees);

?>


<?php if (isset($_SESSION['user-id'])) : ?>
    <div class="container">
        <div class="side-nav">
            <ul>
                <li>
                    <a href="dashboard.php"><i class="bx bx-user"></i> <span>Personnel</span>
                    </a>
                </li>
                <li>
                    <a class="active" href=""><i class="bx bx-compass"></i> <span> Register </span>
                    </a>
                </li>
                <li>
                    <a href=""><i class="bx bxs-bell-ring"></i> News</a>
                </li>
                <li>
                    <a href=""><i class="bx bx-calendar-event"></i> Events</a>
                </li>
                <li>
                    <a href=""><i class="bx bx-cog"></i> Settings</a>
                </li>
            </ul>
        </div>

        <div class="box">
            <div class="box-container">
                <?php if (isset($_SESSION['user_is_owner'])) : ?>
                    <h2>Managers <span><?= $managers_number ?></span></h2>
                <?php else : ?>
                    <h2>Registered Employees <span><?= $registered_number ?> </span></h2>
                <?php endif ?>
                <div>
                    <div class="events">
                        <div class="event">
                            <p>|||</p>
                            <div class="event-item">
                                <i class="bx bx-health"></i> <span>4</span>
                            </div>
                        </div>
                        <div class="event">
                            <p>Vacation</p>
                            <div class="event-item">
                                <i class="bx bxs-plane-alt"></i> <span>4</span>
                            </div>
                        </div>
                        <div class="event">
                            <p>Day off</p>
                            <div class="event-item">
                                <i class="bx bx-pin"></i> <span>4</span>
                            </div>
                        </div>
                        <div class="event">
                            <p>At office</p>
                            <div class="event-item">
                                <i class="bx bx-paperclip"></i> <span><?= $onsite_number ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="box-buttons">
                        <?php if (isset($_SESSION['user_is_manager'])) : ?>
                            <a href="<?= ROOT_URL ?>add-manager.php" class="btn"><i class='bx bx-calendar-plus'></i> Add event</a>

                            <a href="<?= ROOT_URL ?>add-employee.php" class="btn btn-primary"><i class='bx bx-user-plus'></i> Add employee</a>
                        <?php else : ?>

                            <a href="add-manager.php" class="btn btn-primary"><i class='bx bx-user-plus'></i> Add a new manager</a>
                        <?php endif ?>
                    </div>
                </div>

                <div class="search-bar-container">
                    <form action="search.php" method="GET">
                        <input type="text" name="search" placeholder="Search by name" autocomplete="tru" />
                        <button type="submit" name="submit"><i class="bx bx-search-alt-2"></i></button>
                    </form>
                    <select class="position" name="Position" id="position">
                        <option value="Manager">Manager</option>
                        <option value="Manager">CTO</option>
                        <option value="Manager" selected>Senior Web Developer</option>
                    </select>

                    <div class="filter">
                        <div class="form-group">
                            <label for="filter">Sort by:</label>
                            <select name="Filter" id="filter">
                                <option value="date">Date</option>
                                <option value="gender">Gender</option>
                            </select>
                        </div>

                        <i class="bx bx-menu"></i>
                    </div>
                </div>

                <!-----------EMPLOYEES CONTAINER---------------->
                <?php if (isset($_SESSION['add-employee-success'])) : ?>
                    <div class="alert__message success">
                        <p>
                            <?= $_SESSION['add-employee-success'];
                            unset($_SESSION['add-employee-success'])
                            ?>
                        </p>
                    </div>

                <?php endif ?>
                <div class="employees-container">
                    <?php if (mysqli_num_rows($register_results) > 0) : ?>
                        <table width='100%'>
                            <thead>
                                <td>Id</td>
                                <td>Firstname</td>
                                <td>Lastname</td>
                                <td>Status</td>
                                <td><?= date("M d, Y ", strtotime($registered_employees['date_time'])) ?></td>
                            </thead>
                            <?php while ($registered_employees = mysqli_fetch_assoc($register_results)) : ?>
                                <tbody>
                                    <td><?= $registered_employees['employee_id']  ?></td>
                                    <td><?= $registered_employees['firstname'] ?></td>
                                    <td><?= $registered_employees['lastname'] ?></td>
                                    <td><?php if ($registered_employees['is_online'] == 1) : ?>
                                            <span class="green-dot">
                                            <?php elseif ($registered_employees['is_online'] == 0) : ?>
                                            </span> <span class="red-dot"></span>
                                        <?php endif ?>

                                    </td>
                                    <td><?= date("H:i", strtotime($registered_employees['date_time'])) ?></td>
                                </tbody>
                            <?php endwhile ?>
                        </table>
                        <a href="clear-register.php" class="btn btn-primary clear-register">End day</a>
                    <?php else : ?>
                        <div class="alert__message error">
                            <p>No employee registered</p>
                        </div>
                    <?php endif ?>

                </div>
            </div>
        </div>
    </div>
    </body>
<?php endif  ?>

</html>