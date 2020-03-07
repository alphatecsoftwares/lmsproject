<?php
require_once "dbHandler.php";
session_start();
?>
<div>
  <i class="font-weight-light">
    Select the Luggage to see transit details
  </i>
</div>
<div class="row justify-content-center my-3">
  <div class="form-group d-flex col-md-8">
    <select name="luggagetype" id="luggagestatus" class="form-control" required>
      <option value="">Select Luggage</option>
      <?php
        $con=getDBConnection();
        $user_id=$_SESSION['user_id'];
        $sql="SELECT * FROM lms.luggagestorage WHERE phone_number='$user_id'";
        $result=$con->query($sql);
               if(mysqli_num_rows($result)>0){
               while($row=mysqli_fetch_array($result)){
                   echo '<option value='.$row['luggage_id'].'>'.$row['luggage_name'].'</option>';
               }
              }
        ?>
    </select>
  </div>
</div>
<div class="row justify-content-center">
  <div class="col-md-8">
    No details Available
  </div>
</div>
