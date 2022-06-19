<?php

	$con = mysqli_connect("localhost","qsejskfz_chatroom","nG1Gopg1","qsejskfz_chatroom");
	if (mysqli_connect_errno()){
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		die();
		}
	mysqli_set_charset($con, "utf8");
	date_default_timezone_set('Asia/Kolkata');	
	$error="";	
?>