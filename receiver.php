<?php
  session_start();
  if($_SESSION['room_code'] == "")
  {
    header('Location: login.php');
  }

  require 'config.php';
  $room_code=$_SESSION['room_code'];
  $login_id=$_SESSION['login_id'];
  $result3 = mysqli_query($con,"select username from login_data where login_id='$login_id'");
  $fetch3 = mysqli_fetch_array($result3);
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="image/icon.png">
	<title>Chat Room | <?php echo $room_code; ?></title>
	<link rel="stylesheet" type="text/css" href="css/chat1.css">
	<script src="https://kit.fontawesome.com/ab99e84824.js" crossorigin="anonymous"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">

$(document).ready(function(e) {
  var refresher = setInterval("update_content();", 1000); 
})

$(document).ready(function(e) {
  var ref = setInterval("isOnline();", 5000); 
})

function update_content(){  
  $.ajax({  
    url : "fetch_data.php",  
    type : "POST",  
    success:function(data){  
        $("#message-container").html(data);  
     }  
});  
} 

function sent(){
  var msg=document.getElementById('message').value;
  document.getElementById('message').value="";
  $.ajax
   ({
   type: "POST",
   url: "sent_message.php",
   data: "msg="+msg,
      
   });
}

function validateCode(){
  var user=document.getElementById('username').value;
  var first_char= user.charAt(0);
    if( /[^a-z0-9]/.test(user) ) {
       return false;
    }
    if (/[^a-z]/.test(first_char) ) {
      return false;
    }
    if(user.length<4){
      return false;
    }
    return true;     
 }

function upload_username(){
  var user=document.getElementById('username').value;
  if(user!="" && validateCode(user)){
    document.getElementById('error').innerHTML="Username updated successfully!";
    document.getElementById('error').style.color = 'Green';
    $.ajax
   ({
   type: "POST",
   url: "update_user.php",
   data: "user="+user,
      
   });
  }
  else{
    document.getElementById('error').innerHTML="Invalid Username!";
    document.getElementById('error').style.color = 'Red';
  }
  document.getElementById('username').value=user;
  
}

$(document).keypress(
  function(event){
    if (event.which == '13') {
      event.preventDefault();
    }
});

        function isOnline() {
  
            if (navigator.onLine) {
                //online
            } else {
                alert("You are offline please connect to internet!");
            }
        }
</script>
<style type="text/css">
  
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
@media (max-width: 600px) {
    .popup {
      margin: 70px auto;
      padding: 20px;
      background: #fff;
      border-radius: 15px;
      width: 80%;
      position: relative;
      transition: all 5s ease-in-out;
    }
}
</style>
</head>
<body>

  
<section class="msger">
  <header class="msger-header">
    <div class="msger-header-title">
      <i class="fas fa-comment-alt" style="color: white;"></i> Chat Room | <?php echo $room_code; ?>
    </div>
    <div class="msger-header-options">
      <div id="demo">
        <div class="wrapper">
            <div class="content">
                <ul>
                    <a onclick="con();"><li><span style="color: red;">Logout&nbsp;<i class="fas fa-sign-out-alt"></i></span></li></a>
                    <a href="#popup1"><li><span style="color: black;"><i class="fas fa-edit"></i> Edit Details</span></li></a>
                    <!-- <a href="#"><li><span style="color: black;">Users&nbsp;<i class="fas fa-users"></i></span></li></a> -->
                </ul>
            </div>
            <div class="parent"><span style="color: #05728f">ID : <?php echo $login_id; ?>&nbsp;</span><span><i class="fas fa-cog fa-lg" style="color: black;" title="End Chat"></i></span></div>
        </div>
    </div> 
    </div>
  </header>

  <main class="msger-chat" id="message-container">

  </main>

  <form class="msger-inputarea">
    <input type="text" class="msger-input" id="message" placeholder="Enter your message...">
    <button type="button" class="msger-send-btn" onclick="sent();">Send</button>
  </form>
</section>
<script type="text/javascript">
function con() {
 

        swal({
            title: "Are you sure?",
            text: "Do you really want to Leave?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Yes, Leave!',
            cancelButtonText: "No, Cancel!",
            closeOnConfirm: false,
            closeOnCancel: true
         },
         function(isConfirm){

           if (isConfirm){
                // swal("Shortlisted!", "Candidates are successfully shortlisted!", "success");

                //update the data-flag to 1 (as true), to submit
                window.open("endchat2.php","_self");
            } else {
                // swal("Cancelled", "Your imaginary file is safe :)", "error"); 
            }
         });
}
</script>
<div id="popup1" class="overlay">
    <div class="popup">
        <center><h3>Update Username</h3></center>
        <a class="close" href="#"><i class="far fa-window-close"></i></a>
        <div class="content">
            <br>
 
                <p style="color: red;">Note*:<br> Username must be of 4 characters.<br>Must be Alphanumeric only</p><br>
                <center>
                <input type="text" name="username" id="username" placeholder="Enter Username" value="<?php echo $fetch3['username']; ?>" style="width: 100%;padding: 12px 20px;margin: 8px 0; border-radius: 10px;"><br>
                <p id="error"></p><br>
                <button name="usersubmit" onclick="upload_username();" style="width: 40%;padding: 12px 20px;color: white;background-color: #05728f; border-radius: 10px;">Update</button>
              </center>
        </div>
    </div>
</div>
<?php $con->close(); ?>
</body>
</html>