<?php
  session_start();
  require 'config.php';
  $login_id=$_SESSION['login_id'];
  $result = mysqli_query($con,"DELETE from login_data where login_id='$login_id'");
  $result = mysqli_query($con,"DELETE from chat where login_id='$login_id'");
  session_destroy();
  $con->close();
  header('Location: login.php');
?>