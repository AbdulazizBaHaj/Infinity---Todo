<?php
ob_start();
session_start();
$_SESSION['username'];
$_SESSION['id'];
if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Document</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Todo</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Dashboard <span class="sr-only">(current)</span></a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li> -->
                <?php
                require 'config.php';
                $user_id = $_SESSION['id'];
                $query = $link->query("SELECT * FROM `checklist_groups` WHERE user_id=$user_id  ORDER BY `id` ASC");
                // $query1 = $link->query("SELECT * FROM `checklists` WHERE checklist_group_id=$user_id  ORDER BY `id` ASC");
                $count = 1;
                while ($row = $query->fetch_array()) {
                    // require 'config.php';

                ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php echo $row['name']; ?>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="showGroup.php?id=<?php echo $row['id'] ?>&nameGroup=<?php echo $row['name'] ?>">Edit Checklist Group</a>
                            <div class="dropdown-divider"></div>
                            <?php
                            $group_id = $row['id'];
                            $query1 = $link->query("SELECT * FROM `checklists` WHERE checklist_group_id=$group_id  ORDER BY `id` ASC");
                            $count1 = 1;
                            while ($row1 = $query1->fetch_array()) {
                            ?>
                                <a class="dropdown-item" href="showChecklist.php?id=<?php echo $row1['id'] ?>&nameChecklist=<?php echo $row1['name'] ?>"><?php echo $row1['name'] ?></a>
                            <?php } ?>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="delete_group.php?id=<?php echo $row['id'] ?>"><button type="button" class="btn btn-danger">Delete Checklist Group</button></a>
                        </div>
                    </li>
                <?php }
                ?>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <span class="input-group-text" id="basic-addon1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="25" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                    </svg>
                </span>
                <?php if (isset($_SESSION['username'])) : ?>
                    <input type="text" class="form-control" placeholder="<?php echo $_SESSION['username']; ?>" aria-label="Input group example" aria-describedby="basic-addon1" readonly>
                    <a href="index.php?logout='1'"><button class="btn btn-outline-danger my-2 my-sm-0" type="submit">Logout</button></a>
                <?php endif ?>
            </form>
        </div>
    </nav>

    <form action="edit_Checklist.php" method="post">
        <div class="container mt-5">
            <div class="row">
                <div class="col-sm text-right">
                    <label name="" class="col-sm col-form-label" style="font-size: 1.1rem;">Update Checklist Name:</label>
                </div>
                <div class="col-6">
                    <input class="form-control" type="text" placeholder="Update Name for Checklist" name="name">
                    <input class="form-control" type="text" name="checklist_id" value="<?php echo $_GET['id'] ?>" hidden>
                </div>
                <div class="col-sm">
                    <button type="submit" class="btn btn-success" name="checklist_submit">Update Checklist Name</button>
                </div>
            </div>
        </div>
    </form>
    <div class="container mt-5">
        <h2>Tasks for <?php echo $_GET['nameChecklist'] ?>'s Checklist!</h2>

        <form action="insertTask.php" method="post">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-sm text-right">
                        <label name="" class="col-sm col-form-label" style="font-size: 1rem;">Task Name:</label>
                    </div>
                    <div class="col-6">
                        <input class="form-control" type="text" placeholder="Task Name" name="nameTask">
                        <input class="form-control" type="text" placeholder="Task Name" hidden value="<?php echo $_GET['id']; ?>" name="checklist_id">
                        <input class="form-control" type="text" placeholder="Task Name" hidden value="<?php echo $_GET['nameChecklist']; ?>" name="checklist_name">
                        <input class="form-control" type="text" placeholder="Task Name" hidden value="<?php echo $_SESSION['id']; ?>" name="user_id">
                    </div>
                    <div class="col-sm">
                        <!-- <button type="button" class="btn btn-success" name="">Create New Task</button> -->
                    </div>
                </div>
                <div class="row  mt-3">
                    <div class="col-sm text-right">
                        <label name="" class="col-sm col-form-label" style="font-size: 1rem;">Task Description:</label>
                    </div>
                    <div class="col-6">
                        <textarea class="form-control" type="text" placeholder="Task Description" name="descTask" rows="5"></textarea>
                    </div>
                    <div class="col-sm">
                        <!-- <button type="button" class="btn btn-success" name="">Create New Task</button> -->
                    </div>
                </div>
                <div class="row  mt-3">
                    <div class="col-sm text-right">
                        <label name="" class="col-sm col-form-label" style="font-size: 1rem;">Task Due Date:</label>
                    </div>
                    <div class="col-6">
                        <input class="form-control" type="date" name="dateTask">
                    </div>
                    <div class="col-sm">
                        <button type="submit" class="btn btn-success" name="submit_task">Create New Task</button>
                    </div>
                </div>
            </div>

        </form>

        <table class="table table-striped mt-5">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Task Name</th>
                    <th scope="col">Task Description</th>
                    <th scope="col">Task Due Date</th>
                    <th scope="col">Task Status</th>
                    <th scope="col">Done</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // require 'config.php';
                $checklist_id = $_GET['id'];
                $query = $link->query("SELECT * FROM `tasks` WHERE checklist_id=$checklist_id  ORDER BY `id` ASC");
                $count = 1;
                while ($row = $query->fetch_array()) {
                ?>
                    <tr>
                        <th scope="row"><?php echo $count; ?></th>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['desc']; ?></td>
                        <td><?php echo $row['due_date']; ?></td>
                        <td><?php echo $row['status']; ?></td>
                        <form action="taskDone.php" method="post">
                            <input type="text" hidden value="<?php echo $row['id'] ?>" name="task_id">
                            <input type="text" hidden value="<?php echo $_GET['nameChecklist'] ?>" name="nameChecklist">
                            <input type="text" hidden value="<?php echo $row['checklist_id'] ?>" name="checklist_id">
                            <td><a href="showChecklist.php?id=<?php echo $_GET['id'] ?>&nameChecklist=<?php echo $_GET['nameChecklist'] ?>&task_id=<?php echo $row['id']; ?>"><button class="btn btn-outline-success" type="submit">Done</button></a></td>
                        </form>
                        <form action="delete_task.php" method="post">
                            <input type="text" hidden value="<?php echo $row['id'] ?>" name="task_id">
                            <input type="text" hidden value="<?php echo $_GET['nameChecklist'] ?>" name="nameChecklist">
                            <input type="text" hidden value="<?php echo $row['checklist_id'] ?>" name="checklist_id">
                            <td><a href="delete_task.php?id=<?php echo $_GET['id'] ?>&nameChecklist=<?php echo $_GET['nameChecklist'] ?>&task_id=<?php echo $row['id'] ?>"><button class="btn btn-outline-danger" type="submit">Delete</button></a></td>
                        </form>
                    </tr>
                <?php
                    $count = $count + 1;
                } ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>