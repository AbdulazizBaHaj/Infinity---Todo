<?php
require_once 'config.php';

if (isset($_POST['submit_task'])) {
    if ($_POST['nameTask'] != "") {
        $task_name = $_POST['nameTask'];
        $task_desc = $_POST['descTask'];
        $task_date = $_POST['dateTask'];
        $task_status = 'Not Done';
        $checklist_id = $_POST["checklist_id"];
        $user_id = $_POST["user_id"];
        $checklist_name = $_POST["checklist_name"];

        // $link->query("INSERT INTO `tasks` (name, checklist_id, user_id, status, desc, due_date) VALUES('$task_name', ' $checklist_id', '$user_id', '$task_status', '$task_desc' , ' $task_date')");






        $link->query("INSERT INTO `tasks` (`checklist_id`, `user_id`, `name`, `desc`, `status`, `due_date`, `created_at`, `updated_at`, `deleted_at`) VALUES ('$checklist_id', '$user_id', '$task_name', '$task_desc', 'Not Done', '$task_date', NULL, NULL, NULL)");






        header("location:showChecklist.php?nameChecklist={$checklist_name}&id={$checklist_id}");
    }
}
