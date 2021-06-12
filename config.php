<?php

	$con = mysqli_connect("sql212.epizy.com","epiz_28864838","sVPSsOBULoRM","epiz_28864838_chat_room");
	if (mysqli_connect_errno()){
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		die();
		}
	mysqli_set_charset($con, "utf8");
	date_default_timezone_set('Asia/Kolkata');	
	$error="";	
?>