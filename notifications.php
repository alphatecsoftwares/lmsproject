<?php
require_once 'dbHandler.php';
session_start();
?>
<div class="font-weight-light text-center my-4">
  Notifications
</div>
<div class="col-md-10 mx-auto d-flex ">
  <div class="font-weight-light mx-2 no-wrap ">
    <?php
    $con=getDBConnection();
    $sql="SELECT message_id, from_id, to_id, message, date_created, status FROM messages WHERE to_id=? ORDER BY date_created ASC";
    $stmt=$con->prepare($sql);
     $stmt->bind_param('s', $_SESSION['user_id']);
     $stmt->execute();
     $result = $stmt->get_result();
     if(mysqli_num_rows($result)>0){
       while($row=mysqli_fetch_array($result)){
         echo '<div class="d-flex">'.'<div class="mx-2 no-wrap">'.$row['message'].'</div>'.
         '<span id="msg-span">'.'<button class="ml-3 n-button"'.'id='.$row['message_id']. '>'.'Read more'.
         '</button>'.'</span>'.'</div>';
       }
     }

    ?>
    <!-- Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab natus quod Lorem
    ipsum dolor sit amet consectetur, adipisicing elit. Nisi, laudantium?
  </div>
  <div class="mx-2 no-wrap">
    Time Here
  </div>
  <div class="mx-2  ">
    <button class="n-button no-wrap"><i>Read More</i></button>
  </div> -->
</div>
