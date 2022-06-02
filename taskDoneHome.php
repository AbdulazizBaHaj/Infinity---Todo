<?php
	require_once 'config.php';
	
	if($_GET['task_id'] != ""){
		$task_id = $_GET['task_id'];
		
		$link->query("UPDATE `tasks` SET `status` = 'Done' WHERE `id` = $task_id");
		header("location: index.php");
	}
