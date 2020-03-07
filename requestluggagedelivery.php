<form id="requestluggagedelivery" method="POST" autocomplete="off">
  <div class="text-center mt-3">
    <strong>Please Provide Details For The Luggage</strong>
  </div>
    <div class="text-center mt-3">
    <span id="msg"></span>
  </div>
  <div class="font-weight-light">
    <i>
      Please Note that your profile details will be used as the sender
      information
    </i>
  </div>
  <span id="msg"></span>
  <div class="row justify-content-center mt-3">
    <div class="col-md-9">
      <div class="form-group d-flex">
        <label for="luggagetype" class="mx-2">LuggageType</label>
        <select
          name="luggagetype"
          id="luggagetype"
          class="form-control"
          required
        >
          <option value="">Luggage Type</option>
        <?php
      require_once 'dbHandler.php';
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
  <div class="row justify-content-center ">
    <div class="col-md-9 ">
      <div class="form-group d-flex">
        <label class="mx-2" for="luggage-name">Luggage Name</label>
        <input
          type="text"
          name="luggage-name"
          id="luggage-name"
          placeholder="Luggage Name"
          class="form-control"
          pattern="[A-Za-z]{2,20}"
          required
        />
      </div>
    </div>
  </div>
    <div class="row justify-content-center">
    <div class="col-md-9 ">
      <div class="form-group d-flex">
        <label for="location" class="mx-2">Origin</label>
        <select name="location" id="origin" class="form-control" required>
          <option value="">Select Origin</option>
      <?php
      require_once 'dbHandler.php';
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

  <div class="row justify-content-center">
    <div class="col-md-9 ">
      <div class="form-group d-flex">
        <label for="location" class="mx-2">Destination</label>
        <select name="location" id="destination" class="form-control" required>
          <option value="">Select Destination</option>
      <?php
      require_once 'dbHandler.php';
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
  <div class="row  justify-content-center">
    <div class="text-center my-3"><strong>Recipient Details</strong></div>
  </div>
  <div class="row justify-content-center ">
    <div class="col-md-9 ">
      <div class="form-group d-flex">
        <label class="mx-2" for="tel">Phone Number</label>
        <input
          type="tel"
          name="tel"
          id="tel"
          placeholder="07xxxxxxxx"
          class="form-control"
          pattern="[0-9]{10}"
          required
        />
      </div>
    </div>
  </div>

  <div class="row  justify-content-center">
    <div class="text-center my-3"><strong>Billing Details</strong></div>
  </div>

  <div class="row justify-content-center ">
    <div class="col-md-9 ">
      <div class="form-group d-flex">
        <label class="mx-2" for="cost">Total Cost</label>
        <label
          id="cost"
          class="w-25 mx-2 form-control border border-secondary"
          for="tel"
          >Ksh. 0</label
        >
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
