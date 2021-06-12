<?php
  session_start();
  if($_SESSION['room_code'] == "")
  {
    header('Location: login.php');
  }
  require 'config.php';
  $room_code=$_SESSION['room_code'];
  $login_id=$_SESSION['login_id'];



  $result = mysqli_query($con,"select message,login_id from chat where room_code='$room_code' ORDER BY timee ASC ");
  if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_array($result)) {
      if($row['login_id']!=$login_id){
        ?>
          <div class="msg left-msg">
            <div class="msg-img" style="background-image: url(image/sender.png)"></div>

            <div class="msg-bubble">
              <div class="msg-info">
                <div class="msg-info-name">Anonymous</div>
              </div>

              <div class="msg-text">
                <?php echo $row['message']; ?>
              </div>
            </div>
          </div>
        <?php
      }
      elseif($row['login_id']==$login_id){
        ?>
          <div class="msg right-msg">
            <div class="msg-img" style="background-image: url(image/receiver.png)"></div>
            <div class="msg-bubble">
              <div class="msg-info">
                <div class="msg-info-name">Anonymous</div>
              </div>
              <div class="msg-text">
                <?php echo $row['message']; ?>
              </div>
            </div>
          </div>
        <?php
      }
    }
  }
$con->close();
?>
