<?php 
	session_start();
	require 'config.php';
	$color=array("#FE2712","#FC600A","#FB9902","#FCCC1A","#FF00FF","#B2D732","#66B032","#347C98","#0247FE","#4424D6","#8601AF","#C21460");
    $user_color=rand(0,12);
	$room_code=rand(111111,999999);
	$login_id=rand(100000,999999);
	$result = mysqli_query($con,"INSERT into login_data (room_code,login_id,color,username) values ('$room_code','$login_id','$color[$user_color]','$login_id')");
	$_SESSION['login_id']=$login_id;
	$_SESSION['room_code']=$room_code;
	$con->close();
	header('Location: sender.php');

 ?>