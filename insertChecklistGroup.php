<?php
	require_once 'config.php';
	require 'index.php';
	if(ISSET($_POST['submit_group'])){
		if($_POST['name'] != ""){
			$task = $_POST['name'];
			$user_id = $_SESSION["id"];
			$link->query("INSERT INTO `checklist_groups` (name, user_id) VALUES('$task', '$user_id')");
			header('location:index.php');
		}
	}
?>