<?php
session_start();
$status=1;
require 'config.php';
if (isset($_POST['submit'])) {
    $color=array("#FE2712","#FC600A","#FB9902","#FCCC1A","#FF00FF","#B2D732","#66B032","#347C98","#0247FE","#4424D6","#8601AF","#C21460");
    $user_color=rand(0,12);
    $room_code=$_POST['room_code'];
    $login_id=rand(100000,999999);
    $result = mysqli_query($con,"SELECT id FROM login_data WHERE room_code='$room_code'");
    if ($result->num_rows > 0) {
        $result = mysqli_query($con,"INSERT into login_data (room_code,login_id,color,username) values ('$room_code','$login_id','$color[$user_color]','$login_id')");
        $_SESSION['login_id']=$login_id;
        $_SESSION['room_code']=$room_code;
        header('Location: receiver.php');
    }
    else
    {
        $status=0;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="image/icon.png">
    <title>Login</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/login.css">
    <script src="https://kit.fontawesome.com/ab99e84824.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script src="js/test.js"></script>
    <link rel="stylesheet" type="text/css" href="css/test.css">
    <style type="text/css">
        .registration-form form {
    background-color: #fff;
    max-width: 600px;
    margin: auto;
    padding: 50px 70px;
    border-top-left-radius: 30px;
    border-top-right-radius: 30px;
    border-bottom-left-radius: 30px;
    border-bottom-right-radius: 30px;
    box-shadow: 0px 2px 10px rgb(0 0 0 / 8%);
}


.overlay {
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  background: rgba(0, 0, 0, 0.7);
  transition: opacity 500ms;
  visibility: hidden;
  opacity: 0;
}
.overlay:target {
  visibility: visible;
  opacity: 1;
}

.popup {
  margin: 70px auto;
  padding: 20px;
  background: #fff;
  border-radius: 15px;
  width: 30%;
  position: relative;
  transition: all 5s ease-in-out;
}

.popup h2 {
  margin-top: 0;
  color: #333;
  font-family: Tahoma, Arial, sans-serif;
}
.popup .close {
  position: absolute;
  top: 20px;
  right: 30px;
  transition: all 200ms;
  font-size: 30px;
  font-weight: bold;
  text-decoration: none;
  color: #333;
}
.popup .close:hover {
  color: red;
}
.popup .content {
  max-height: 30%;
  overflow: auto;
}
@media (max-width: 576px) {
    .popup {
      margin: 70px auto;
      padding: 20px;
      background: #fff;
      border-radius: 15px;
      width: 70%;
      position: relative;
      transition: all 5s ease-in-out;
    }
}
    </style>
</head>
<body>
    <?php 
$print=""
?>
    <?php
    if ($status==0) {
        ?>
        <script type="text/javascript">
          toastr["error"]("Invalid Room Code!", "Error!");
        </script>
        <?php 
    }
    ?>
    <div class="registration-form" >
        <form method="POST">
            <div class="form-icon">
                <span><i class="far fa-comment-dots"></i></span>
            </div>
            <div class="form-group">
                <label>&nbsp;Room Code</label>
                <input type="Number" class="form-control item" min="111111" max="999999" name="room_code" id="username" onkeypress='return event.charCode >= 48 && event.charCode <= 57' placeholder="Enter Room Code" required>
            </div>
            <div class="form-group">
                <button type="submit" name="submit" class="btn btn-block create-account">Join Room</button>
            </div>
            <center><b>--------------- <span style="color: #05728f;"> OR </span> ---------------</b></center>
            <div class="form-group">
                <button type="button" class="btn btn-block create-account" onclick="location.href='create_room.php';">Create Room</button>
            </div>
            <center>
              <h6><a href="#popup1" style="color: #05728f; text-decoration: none;">About Chat Room <i class="far fa-list-alt fa-lg"></i></a></h6>
              <h6>Designed & Developed By:<br><a target="_blank" href="https://adi0603.github.io/" style="color: #05728f; text-decoration: none;"> <span style="color: #05728f">Aditya Pandey</a></span></h6>
              
              <b><span style='color: black;'>Version - v2.2</span></b>
                </center>
        </form>        
    </div>


<div id="popup1" class="overlay">
    <div class="popup">
        <h2>Chat Room Features</h2>
        <a class="close" href="#"><i class="far fa-window-close"></i></a>
        <div class="content">
            <span style='color: green;'><i class='fas fa-check fa-lg'></i></span>&nbsp;<span style='color: #05728f;'>Easy to use.</span><br>
            <span style='color: green;'><i class='fas fa-check fa-lg'></i></span>&nbsp;<span style='color: #05728f;'>Interactive user friendly interface.</span><br>
            <span style='color: green;'><i class='fas fa-check fa-lg'></i></span>&nbsp;<span style='color: #05728f;'>End-To-End Encryption.</span><br>
            <span style='color: green;'><i class='fas fa-check fa-lg'></i></span>&nbsp;<span style='color: #05728f;'>Chat Without uploading any personal information.</span><br>
            <span style='color: green;'><i class='fas fa-check fa-lg'></i></span>&nbsp;<span style='color: #05728f;'>Chat will automatically deleted after leaving the room.</span><br>
            <span style='color: green;'><i class='fas fa-check fa-lg'></i></span>&nbsp;<span style='color: #05728f;'>Room will be deleted after Chat Owner leaves.</span><br>
            <span style='color: green;'><i class='fas fa-check fa-lg'></i></span>&nbsp;<span style='color: #05728f;'>Version - v2.2</span><br>
            <center><h3><i class="fas fa-child"></i>&nbsp;Thank You&nbsp;<i class="fas fa-child"></i></h3></center>
        </div>
    </div>
</div>


    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script src="assets/js/script.js"></script>
    <?php $con->close(); ?>
</body>
</html>
