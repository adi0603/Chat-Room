<?php
  session_start();
  if($_SESSION['room_code'] == "")
  {
    header('Location: login.php');
  }
  require 'config.php';
  $room_code=$_SESSION['room_code'];
  $login_id=$_SESSION['login_id'];
  $user=$_POST['user'];
  $result = mysqli_query($con,"Update login_data set username='$user' where login_id='$login_id'");
  $con->close();
?>