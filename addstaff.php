<form autocomplete="off" id="editprofile" enctype="multipart/form-data">
  <div class="text-center my-3">
   Create New Staff
  </div>
  <div class="row justify-content-center ">
    <div class="col-md-9 ">
      <div class="form-group d-flex">
        <input
          type="text"
          name="fname"
          id="fname"
          placeholder="First Name"
          class="form-control mr-2"
          required
        />
        <input
          type="text"
          name="lname"
          id="lname"
          placeholder="Last Name"
          class="form-control mr-2"
          required
        />
      </div>
    </div>
  </div>
  <div class="row justify-content-center ">
    <div class="col-md-9 ">
      <div class="form-group d-flex">
        <input
          type="email"
          name="email"
          id="email"
          placeholder="Email"
          class="form-control mr-2"
          required
        />
        <input
          type="tel"
          name="tel"
          id="tel"
          placeholder="07xxxxxxxxx"
          class="form-control mr-2"
          required
        />
      </div>
    </div>
  </div>

  <div class="row justify-content-center">
    <div class="col-md-9 ">
      <div class="form-group d-flex">
       
        <select
          name="location"
          id="location"
          class="form-control mr-2"
          required
        >
          <option value="">Branch</option>
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
        <button type="reset" class="btn btn-outline-warning mx-4">
          Reset All Fields
        </button>
        <button
          type="submit"
          id="changeprofile"
          class="btn btn-outline-success"
        >
          Submit
        </button>
      </div>
    </div>
  </div>
</form>
