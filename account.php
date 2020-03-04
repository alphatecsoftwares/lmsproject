<div class="row  justify-content-center">
  <div class="text-center my-3"><strong>Account Information</strong></div>
</div>

<div class="row justify-content-center ">
  <div class="col-md-9 ">
    <div class="form-group d-flex">
      <label class="mx-2" for="tel">Phone Number</label>
      <?php
      require_once 'dbHandler.php';
      $userid="0777777777";
      $con=getDBConnection();
      $sql="SELECT * FROM customers WHERE phone_number='$userid'";
      $result=$con->query($sql);
      if($result){
      while($row=mysqli_fetch_array($result)){
        echo '<input type="text" value='.$row['phone_number'].' class="form-control"'.' disabled/>';
      }
    }
      ?>
 
    </div>
  </div>
</div>
<div class="row justify-content-center ">
  <div class="col-md-9 ">
    <div class="form-group d-flex">
      <label class="mx-2" for="tel">Account Balance</label>
       <?php
      require_once 'dbHandler.php';
      $userid="0777777777";
      $con=getDBConnection();
      $sql="SELECT * FROM customers WHERE phone_number=+'$userid'";
      $result=$con->query($sql);
      if($result){
        while($row=mysqli_fetch_array($result)){
        echo '<input type="text" value=Ksh.'.$row['amount'].' class="form-control"'.' disabled/>';
        }
    }
      ?>
 
    </div>
  </div>
</div>
