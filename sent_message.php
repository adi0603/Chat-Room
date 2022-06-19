<?php
  session_start();
  if($_SESSION['room_code'] == "")
  {
    header('Location: login.php');
  }
  function safeEncrypt(string $message): string
  {
    $ciphering = "AES-128-CTR";
    $iv_length = openssl_cipher_iv_length($ciphering);
    $options = 0;
    $encryption_iv = '1234567891011121';
    $encryption_key = "itshardtocrack";
    $encryption = openssl_encrypt($message, $ciphering, $encryption_key, $options, $encryption_iv); 
    return $encryption;
  }
  require 'config.php';
  $room_code=$_SESSION['room_code'];
  $login_id=$_SESSION['login_id'];

  $msg=$_POST['msg'];
  $msg=safeEncrypt($msg);
  $result = mysqli_query($con,"INSERT into chat (room_code,login_id,message) values ('$room_code','$login_id','$msg')");
  $con->close();
?>

