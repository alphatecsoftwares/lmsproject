<?php
session_start();
?>
<form autocomplete="off" id="editprofile" enctype="multipart/form-data">
  <div class="text-center my-3">
    <span id="msg"></span>
  </div>
  <div class="text-center my-3">
    Edit Profile
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
     <label class="form-control">
       Phone: 
       <?php
       echo $_SESSION['user_id'];
       ?>
     </label>
      </div>
    </div>
  </div>

  <div class="row justify-content-center ">
    <div class="col-md-9 ">
      <div class="form-group d-flex">
        <input
          type="password"
          id="password"
          placeholder="Password"
          class="form-control mr-2"
          required
        />
        <input
          type="password"
          id="cpassword"
          placeholder="Confirm Password"
          class="form-control mr-2"
          required
        />
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
