<?php
require_once 'config.php';

if (isset($_POST['submit_list'])) {
    if ($_POST['nameChecklist'] != "") {
        $list_name = $_POST['nameChecklist'];
        $group_id = $_POST["id"];
        $group_name = $_POST["name"];

        $link->query("INSERT INTO `checklists` (name, checklist_group_id) VALUES('$list_name', '$group_id')");
        header("location:showGroup.php?nameGroup={$group_name}&id={$group_id}");
    }
}
