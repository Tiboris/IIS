<?php
	include('config.php');
	if (!isset($_SESSION)) {
		session_start();
	}

	$user_check = $_SESSION['login_user'];
	$ses_sql = mysqli_query($db,"SELECT login FROM zamestnanci WHERE login = '$user_check' ");
	$row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
	$login_session = $row['login'];

	if(!isset($_SESSION['login_user'])){
		header("location: ?page=login");
	}
?>
