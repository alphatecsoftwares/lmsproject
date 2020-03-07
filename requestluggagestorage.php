<?php
require_once 'dbHandler.php';
session_start();
?>
<form id="requestluggagestorage" method="POST">
  <div class="text-center mt-3">
    <strong class="text-info ">Please Provide the Following Details</strong>
  </div>
   <div class="text-center mt-3">
     <span id="msg"></span>
  </div>
  <div class="row justify-content-center mt-3">
    <div class="col-md-9">
      <div class="form-group d-flex">
        <label for="luggagetype" class="mx-2">LuggageType</label>
        <select name="luggagetype" id="luggageid" class="form-control" required>
          <option value="">Luggage Type</option>
        <?php
        $con=getDBConnection();
        $sql='SELECT * FROM lms.luggagecategories';
        $result=$con->query($sql);
               if(mysqli_num_rows($result)>0){//luggage categories exists ?
               while($row=mysqli_fetch_array($result)){//iterate thru' 'em and display the categories
                   echo '<option value='.$row['category_id'].'>'.$row['category_name'].'</option>';
               }
              }
        ?>
        </select>
      </div>
    </div>
  </div>

    <div class="row justify-content-center">
    <div class="col-md-9">
      <div class="form-group d-flex">
        <label for="name" class="mx-2">Name</label>
        <input type="text" name="name" id="name" class="form-control" placeholder="Name" required />
      </div>
    </div>
  </div>

  <div class="row justify-content-center">
    <div class="col-md-9">
      <div class="form-group d-flex">
        <label for="datefrom" class="mx-2">Keep From</label>
        <input type="date" name="From" id="datefrom" class="form-control" required/>
        <label for="datefrom" class="mx-2">To</label>
        <input type="date" name="dateto" id="dateto" class="form-control" required/>
      </div>
    </div>
  </div>

  <div class="row justify-content-center">
    <div class="col-md-9 ">
      <div class="form-group d-flex">
        <label for="location" class="mx-2">Location</label>
        <select name="location" id="location" class="form-control" required>
        <option value="">Select Location</option>
         <?php
        $con=getDBConnection();
        $sql='SELECT * FROM lms.locations';
        $result=$con->query($sql);
               if(mysqli_num_rows($result)>0){//luggage categories exists ?
               while($row=mysqli_fetch_array($result)){//iterate thru' 'em and display the categories
                   echo '<option value='.$row['location_id'].'>'.$row['location_name'].'</option>';
               }
              }
        ?>
        </select>
      </div>
    </div>
  </div>

    <div class="text-center text-info">
    <strong>Billing Details</strong>
  </div>
  <div class="row justify-content-center mt-3">
        <label for="datefrom" class="mx-2">Total Cost</label>
    <div class="col-md-9">
      <div class="form-group">
        <label id="cost" class="form-control"></label>
      </div>
    </div>
  </div>

  <div class="row justify-content-center">
    <div class="col-md-9 ">
      <div class="form-group d-flex">
        <button type="reset" class="btn btn-outline-warning mx-4">
          Reset All Fields
        </button>
        <button type="submit" class="btn btn-outline-success">
          Submit Request
        </button>
      </div>
    </div>
  </div>
</form>
