<?php
  session_start();
  if($_SESSION['room_code'] == "")
  {
    header('Location: login.php');
  }
  require 'config.php';
  $room_code=$_SESSION['room_code'];
  $login_id=$_SESSION['login_id'];
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">

$(document).ready(function(e) {
  var refresher = setInterval("update_content();", 1000); 
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
$(document).keypress(
  function(event){
    if (event.which == '13') {
      event.preventDefault();
    }
});
</script>
</head>
<body>
<section class="msger">
  <header class="msger-header">
    <div class="msger-header-title">
      <i class="fas fa-comment-alt" style="color: #05728f;"></i> Chat Room | <?php echo $room_code; ?>
    </div>
    <div class="msger-header-options">
      <span><a onclick="con();"><i class="fas fa-sign-out-alt fa-lg" style="color: red;" title="End Chat"></i></a></span>
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
    var answer = confirm("Do you really want to Leave?");
    if (answer){

        window.open("endchat2.php","_self");
    }
}
</script>
<?php $con->close(); ?>
</body>
</html>