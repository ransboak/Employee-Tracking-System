<?php
include './partials/header.php';

$employees_query = "SELECT * FROM employees";
$employees = mysqli_query($connection, $employees_query);
$employees_number = mysqli_num_rows($employees);

if (isset($_SESSION['user-id'])) {
    $id = $_SESSION['user-id'];
    $manager_query = "SELECT * FROM managers WHERE NOT id=$id";
    $manager_results = mysqli_query($connection, $manager_query);
    $managers_number = mysqli_num_rows($manager_results);
}

$onsite_query = "SELECT * FROM employees WHERE status=2";
$onsite_employees = mysqli_query($connection, $onsite_query);
$onsite_number = mysqli_num_rows($onsite_employees);

?>


<?php if (isset($_SESSION['user-id'])) : ?>
    <div class="container">
        <div class="side-nav">
            <ul>
                <li>
                    <a class="active" href="dashboard.php"><i class="bx bx-user"></i> <span>Personnel</span>
                    </a>
                </li>
                <li>
                    <a href="employee-register.php"><i class="bx bx-compass"></i> <span>Register </span>
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
                    <h2>Employees <span><?= $employees_number ?></span></h2>
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
                <?php elseif (isset($_SESSION['add-employee'])) : ?>
                    <div class="alert__message error">
                        <p>
                            <?= $_SESSION['add-employee'];
                            unset($_SESSION['add-employee'])
                            ?>
                        </p>
                    </div>
                <?php elseif (isset($_SESSION['add-manager-success'])) : ?>
                    <div class="alert__message success">
                        <p>
                            <?= $_SESSION['add-manager-success'];
                            unset($_SESSION['add-manager-success'])
                            ?>
                        </p>
                    </div>
                <?php elseif (isset($_SESSION['delete-employee'])) : ?>
                    <div class="alert__message error">
                        <p>
                            <?= $_SESSION['delete-employee'];
                            unset($_SESSION['delete-employee'])
                            ?>
                        </p>
                    </div>
                <?php elseif (isset($_SESSION['delete-employee-success'])) : ?>
                    <div class="alert__message success">
                        <p>
                            <?= $_SESSION['delete-employee-success'];
                            unset($_SESSION['delete-employee-success'])
                            ?>
                        </p>
                    </div>
                <?php elseif (isset($_SESSION['delete-manager'])) : ?>
                    <div class="alert__message error">
                        <p>
                            <?= $_SESSION['delete-manager'];
                            unset($_SESSION['delete-manager'])
                            ?>
                        </p>
                    </div>
                <?php elseif (isset($_SESSION['delete-manager-success'])) : ?>
                    <div class="alert__message success">
                        <p>
                            <?= $_SESSION['delete-manager-success'];
                            unset($_SESSION['delete-manager-success'])
                            ?>
                        </p>
                    </div>
                <?php elseif (isset($_SESSION['edit-employee'])) : ?>
                    <div class="alert__message error">
                        <p>
                            <?= $_SESSION['edit-employee'];
                            unset($_SESSION['edit-employee'])
                            ?>
                        </p>
                    </div>
                <?php elseif (isset($_SESSION['edit-employee-success'])) : ?>
                    <div class="alert__message success">
                        <p>
                            <?= $_SESSION['edit-employee-success'];
                            unset($_SESSION['edit-employee-success'])
                            ?>
                        </p>
                    </div>
                <?php elseif (isset($_SESSION['edit-manager'])) : ?>
                    <div class="alert__message error">
                        <p>
                            <?= $_SESSION['edit-manager'];
                            unset($_SESSION['edit-manager'])
                            ?>
                        </p>
                    </div>
                <?php elseif (isset($_SESSION['edit-manager-success'])) : ?>
                    <div class="alert__message success">
                        <p>
                            <?= $_SESSION['edit-manager-success'];
                            unset($_SESSION['edit-manager-success'])
                            ?>
                        </p>
                    </div>
                <?php endif ?>
                <div class="employees-container">
                    <?php if (isset($_SESSION['user_is_owner'])) : ?>
                        <?php while ($manager = mysqli_fetch_assoc($manager_results)) : ?>
                            <article class="employee-box">
                                <div class="employee-img">
                                    <img src="<?= 'images/' . $manager['avatar'] ?>" alt="" />
                                </div>
                                <h4><?= $manager['firstname'] ?> <?= $manager['lastname'] ?></h4>
                                <small><?= $manager['job'] ?></small>
                                <p><?= $manager['contact'] ?></p>
                                <div>
                                    <a href="mailto:<?= $manager['email'] ?>"><i class='bx bx-envelope'></i></a>
                                </div>
                                <div class="control-icons">
                                    <a class="edit-icon" href="<?= ROOT_URL ?>edit-manager.php?id=<?= $manager['id'] ?>"><i class='bx bxs-edit'></i></a>
                                    <a class="delete-icon" href="<?= ROOT_URL ?>delete-manager.php?id=<?= $manager['id'] ?>"><i class='bx bx-trash'></i></a>
                                </div>
                            </article>
                        <?php endwhile ?>
                    <?php endif ?>



                    <?php if (isset($_SESSION['user_is_manager'])) : ?>
                        <?php while ($employee = mysqli_fetch_assoc($employees)) : ?>
                            <article class="employee-box">
                                <div class="employee-img">
                                    <img src="<?= 'images/' . $employee['avatar'] ?>" alt="" />
                                </div>
                                <h4><?= $employee['firstname'] ?> <?= $employee['lastname'] ?></h4>
                                <small><?= $employee['job'] ?></small>
                                <p><?= $employee['contact'] ?></p>
                                <div class="email">
                                    <a href="mailto:<?= $manager['email'] ?>"><i class='bx bx-envelope'></i></a>
                                </div>
                                <div class="control-icons">
                                    <a class="edit-icon" href="<?= ROOT_URL ?>edit-employee.php?id=<?= $employee['id'] ?>"><i class='bx bxs-edit'></i></a>
                                    <a class="delete-icon" href="<?= ROOT_URL ?>delete-employee.php?id=<?= $employee['id'] ?>"><i class='bx bx-trash'></i></i></a>
                                </div>
                                <?php if ($employee['status'] == 1) : ?>
                                    <span class="remote">Remote</span>
                                <?php elseif ($employee['status'] == 2) : ?>
                                    <span class="onsite">Onsite</span>
                                <?php endif ?>
                            </article>
                        <?php endwhile ?>
                    <?php endif ?>



                </div>
            </div>
        </div>
    </div>
    </body>
<?php endif  ?>

</html>