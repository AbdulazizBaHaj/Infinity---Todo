<?php
	require_once 'config.php';
	
	if($_POST['group_id'] != ""){
		$task_id = $_POST['group_id'];
		$task = $_POST['name'];
		
		$link->query("UPDATE `checklist_groups` SET `name` = '$task' WHERE `id` = $task_id");
		header("location: showGroup.php?id={$task_id}&nameGroup={$task}");
	}
?>