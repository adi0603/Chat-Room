<?php 
	session_start();
	require 'config.php';
	$room_code=rand(111111,999999);
	$login_id=rand(100000,999999);
	$result = mysqli_query($con,"INSERT into login_data (room_code,login_id) values ('$room_code','$login_id')");
	$_SESSION['login_id']=$login_id;
	$_SESSION['room_code']=$room_code;
	$con->close();
	header('Location: sender.php');

 ?>