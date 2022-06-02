<?php
	require_once 'config.php';
	
	if($_GET['task_id']){
		$task_id = $_GET['task_id'];
		
		$link->query("DELETE FROM `tasks` WHERE `id` = $task_id");
		header("location: index.php");
	}