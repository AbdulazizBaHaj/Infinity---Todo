<?php
	require_once 'config.php';
	
	if($_POST['checklist_id'] != ""){
		$checklist_id = $_POST['checklist_id'];
		$task = $_POST['name'];
		
		$link->query("UPDATE `checklists` SET `name` = '$task' WHERE `id` = $checklist_id");
		header("location: showChecklist.php?id={$checklist_id}&nameChecklist={$task}");
	}
?>