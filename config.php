<?php

	$con = mysqli_connect("localhost","root","PASSWORD","DATABASE_NAME");
	if (mysqli_connect_errno()){
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		die();
		}
	mysqli_set_charset($con, "utf8");
	date_default_timezone_set('Asia/Kolkata');	
	$error="";	
?>
