<?php
  session_start();
  if($_SESSION['room_code'] == "")
  {
    header('Location: login.php');
  }
  require 'config.php';
  $room_code=$_SESSION['room_code'];
  $login_id=$_SESSION['login_id'];
  $status=0;
  function safeDecrypt(string $encryption): string
  {   
    $decryption_iv = '1234567891011121';
    $ciphering = "AES-128-CTR";  
    $decryption_key = "itshardtocrack";
    $options = 0;  
    $decryption=openssl_decrypt ($encryption, $ciphering, $decryption_key, $options, $decryption_iv);
    return $decryption;
  }
  $result7 = mysqli_query($con,"select id from login_data where room_code='$room_code'");
  if (mysqli_num_rows($result7) == 0) {
    $status=1;
  }

  $result = mysqli_query($con,"select message,login_id from chat where room_code='$room_code' ORDER BY timee ASC ");
  if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_array($result)) {
      if($row['login_id']!=$login_id){
        $l_id=$row["login_id"];
        $result3 = mysqli_query($con,"select color,username from login_data where login_id='$l_id'");
        $fetch3 = mysqli_fetch_array($result3);
        ?>
          <div class="msg left-msg">
            <div class="msg-img" style="background-image: url(image/sender.png)"></div>

            <div class="msg-bubble">
              <div class="msg-info">
                <div class="msg-info-name" >
                  <span style="color: <?php echo $fetch3['color']; ?>;" title="<?php echo '@'.$row['login_id']; ?>">@
                    <?php 
                        echo $fetch3['username']; 
                    ?>                      
                  </span>
                </div>
              </div>

              <div class="msg-text">
                <?php echo safeDecrypt($row['message']); ?>
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
              <div class="msg-text">
                <?php echo safeDecrypt($row['message']); ?>
              </div>
            </div>
          </div>
        <?php
      }
    }
  }
  if($status==1){
      ?>
        <script type="text/javascript">
          swal({
            title: "Room Destroyed",
            text: "Room Owner has destroyed the room!",
            type: "error",
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Leave!',
            closeOnConfirm: false,
            closeOnCancel: true
         },
         function(isConfirm){

           if (isConfirm){
                // swal("Shortlisted!", "Candidates are successfully shortlisted!", "success");

                //update the data-flag to 1 (as true), to submit
                window.open("login.php","_self");
            } else {
                // swal("Cancelled", "Your imaginary file is safe :)", "error"); 
            }
         });
        </script>
      <?php
    }
$con->close();
?>

