<?php
  session_start();
  require 'config.php';
  $room_code=$_SESSION['room_code'];
  $result = mysqli_query($con,"DELETE from login_data where room_code='$room_code'");
  $result = mysqli_query($con,"DELETE from chat where room_code='$room_code'");
  session_destroy();
  $con->close();
  header('Location: login.php');
?>