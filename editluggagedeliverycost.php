<?php
require_once 'dbHandler.php';
session_start();
?>
<form id="editluggagedeliverycost" method="POST">
  <div class="text-center mt-3">
    <strong class="text-info ">Edit Cost Below</strong>
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

<div class="row justify-content-center mt-3">
        <div class="form-group">
            <input type="text"  id="new-cost" placeholder="New Cost">
        </div>
    </div>

<div class="row justify-content-center mt-3">
        <div class="form-group">
            <input type="text"  id="min-cost" placeholder="Minimun Cost">
        </div>
</div>
  <div class="row justify-content-center">
    <div class="col-md-9 ">
      <div class="form-group d-flex">
        <button type="submit" class="btn btn-outline-success">
          Submit 
        </button>
      </div>
    </div>
  </div>
</form>
