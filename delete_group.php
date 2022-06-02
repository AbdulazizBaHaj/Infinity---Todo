<?php
	require_once 'config.php';
	
	if($_GET['id']){
		$id = $_GET['id'];
		
		$link->query("DELETE FROM `checklist_groups` WHERE `id` = $id");
		header("location: index.php");
	}	
?>