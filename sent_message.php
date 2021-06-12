<?php
  session_start();
  if($_SESSION['room_code'] == "")
  {
    header('Location: login.php');
  }
  require 'config.php';
  $room_code=$_SESSION['room_code'];
  $login_id=$_SESSION['login_id'];

  $msg=$_POST['msg'];
  $result = mysqli_query($con,"INSERT into chat (room_code,login_id,message) values ('$room_code','$login_id','$msg')");
  $con->close();
?>