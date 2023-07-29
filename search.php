<?php
include 'partials/header.php';

if (isset($_GET['search']) && isset($_GET['submit'])) {
    $search = filter_var($_GET['search'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $employees_query = "SELECT * FROM employees WHERE firstname LIKE '%$search%' 
    OR lastname LIKE '%$search%' OR job LIKE '%$search%'  ";
    $employees = mysqli_query($connection, $employees_query);
    $employees_number = mysqli_num_rows($employees);

    if (isset($_SESSION['user-id'])) {
        $id = $_SESSION['user-id'];
        $employees_query = "SELECT * FROM managers WHERE NOT id = $id AND ( firstname LIKE '%$search%' 
        OR lastname LIKE '%$search%' OR job LIKE '%$search%') ";
        $employees = mysqli_query($connection, $employees_query);
        $employees_number = mysqli_num_rows($employees);
    }
} else {
    header('location: ' . ROOT_URL . 'dashboard.php');
    die();
}

?>

<?php if (isset($_SESSION['user-id'])) : ?>
    <div class="container">
        <div class="side-nav">
            <ul>
                <li>
                    <a class="active" href=""><i class="bx bx-user"></i> <span>Personnel</span>
                    </a>
                </li>
                <li>
                    <a href=""><i class="bx bx-compass"></i> <span> Who's Away </span>
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
                <h2>Employees Found: <span><?= $employees_number ?></span></h2>
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
                                <i class="bx bx-paperclip"></i> <span>4</span>
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
                    <form action="<?= ROOT_URL ?>search.php" method="GET">
                        <input type="text" name="search" placeholder="Search by name" />
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
                <div class="employees-container">
                    <?php while ($employee = mysqli_fetch_assoc($employees)) : ?>
                        <article class="employee-box">
                            <div class="employee-img">
                                <img src="<?= 'images/' . $employee['avatar'] ?>" alt="" />
                            </div>
                            <h4><?= $employee['firstname'] ?> <?= $employee['lastname'] ?></h4>
                            <small><?= $employee['job'] ?></small>
                            <p><?= $employee['contact'] ?></p>
                            <a href="mailto:email@gmail.com"><?= $employee['email'] ?></a>
                            <?php if ($employee['status'] == 1) : ?>
                                <span class="remote">Remote</span>
                            <?php elseif ($employee['status'] == 2) : ?>
                                <span class="onsite">Onsite</span>
                            <?php endif ?>
                        </article>
                    <?php endwhile ?>


                </div>
            </div>
        </div>
    </div>
    </body>

    </html>
<?php endif ?>