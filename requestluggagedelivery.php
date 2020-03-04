<form id="requestluggagedelivery" method="POST" autocomplete="off">
  <div class="text-center mt-3">
    <strong>Please Provide Details For The Luggage</strong>
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
      <div class="form-group ">
        <label for="luggagetype" class="mx-2">LuggageType</label>
        <select
          name="luggagetype"
          id="luggagetype"
          class="form-control"
          required
        >
          <option value="">Luggage Type</option>
          <option value="farmproducts">Farm Products</option>
          <option value="electronics">Electronics</option>
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
          required
        />
      </div>
    </div>
  </div>
  <div class="row justify-content-center">
    <div class="col-md-9">
      <div class="form-group d-flex">
        <label for="datefrom" class="mx-2">Departure</label>
        <input
          type="date"
          name="From"
          id="datefrom"
          class="form-control"
          required
        />
        <label for="datefrom" class="mx-2">Expected Arrival</label>
        <input type="date" name="dateto" id="dateto" class="form-control" />
      </div>
    </div>
  </div>

  <div class="row justify-content-center">
    <div class="col-md-9 ">
      <div class="form-group d-flex">
        <label for="location" class="mx-2">Destination</label>
        <select name="location" id="location" class="form-control" required>
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
        <label class="mx-2" for="fname">First Name</label>
        <input
          type="text"
          name="fname"
          id="fname"
          placeholder="First Name"
          class="form-control"
          required
        />
        <label class="mx-2" for="lname">Last Name</label>
        <input
          type="text"
          name="lname"
          id="lname"
          placeholder="Last Name"
          class="form-control"
          required
        />
      </div>
    </div>
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
          required
        />
        <label class="mx-2" for="email">Email</label>
        <input
          type="email"
          name="email"
          id="email"
          placeholder="email@email.com"
          class="form-control"
        />
      </div>
    </div>
  </div>

  <div class="row  justify-content-center">
    <div class="text-center my-3"><strong>Billing Details</strong></div>
  </div>

  <div class="row justify-content-center">
    <div class="col-md-9 ">
      <div class="form-group d-flex">
        <label for="location" class="mx-2">Debited Account</label>
        <select name="location" id="location" class="form-control" required>
          <option value="lmsaccount">Select Account</option>
          <option value="chuka">LMSAccount</option>
        </select>
      </div>
    </div>
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
